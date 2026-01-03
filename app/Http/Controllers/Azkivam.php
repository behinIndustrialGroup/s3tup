<?php

namespace App\Http\Controllers;

use App\Models\AzkivamPayment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class Azkivam
{
    public function __construct(
        protected ?string $apiKey = null,
        protected ?string $baseUrl = null,
        protected ?string $requestEndpoint = null,
        protected ?string $verifyEndpoint = null,
        protected ?string $defaultCallbackUrl = null,
    ) {
        $this->apiKey = $apiKey ?? config('azkivam.api_key');
        $this->baseUrl = rtrim($baseUrl ?? (string) config('azkivam.base_url'), '/');
        $this->requestEndpoint = $requestEndpoint ?? config('azkivam.endpoints.request');
        $this->verifyEndpoint = $verifyEndpoint ?? config('azkivam.endpoints.verify');
        $this->defaultCallbackUrl = $defaultCallbackUrl ?? config('azkivam.callback_url');
    }




    public static function authenticateToAzkivam()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.azkiloan.com/auth/authenticate', [
            'username' => 's3tup-test',
            'password' => '9c4nX#UL',
        ]);

        if ($response->successful()) {
            return [
                'error' => false,
                'status' => $response->status(),
                'accessToken' => $response['result']['accessToken'],
                'refreshToken' => $response['result']['refreshToken'],
            ];
        }

        // در صورت خطا
        return [
            'error' => true,
            'status' => $response->status(),
            'body' => $response->body(),
        ];
        
    }


    public static function createAzkivamTicketWithToken(string $accessToken, array $payload)
    {
        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ])
                ->post('https://api.azkiloan.com/payment/purchase', $payload);

            $response->throw();

            return $response->json();
        } catch (\Throwable $e) {
            report($e);

            return [
                'error'   => true,
                'message' => $e->getMessage(),
            ];
        }
    }



    /**
     * ایجاد پرداخت جدید و ذخیره شناسه یکتا در پایگاه داده
     */
    public function requestPayment(
        int $amount,
        string $orderId,
        ?string $callbackUrl = null,
        array $meta = []
    ): AzkivamPayment {
        $body = [
            'amount' => $amount,
            'order_id' => $orderId,
            'callback_url' => $callbackUrl ?? $this->defaultCallbackUrl,
        ] + $meta;

        $response = $this->httpClient()->post($this->requestEndpoint, $body)->throw()->json();

        $paymentId = $this->extractPaymentId($response);
        $gatewayUrl = $this->extractGatewayUrl($response);

        return AzkivamPayment::updateOrCreate(
            ['order_id' => $orderId],
            [
                'payment_id' => $paymentId,
                'amount' => $amount,
                'status' => AzkivamPayment::STATUS_PENDING,
                'gateway_url' => $gatewayUrl,
                'callback_url' => $callbackUrl ?? $this->defaultCallbackUrl,
                'meta' => $meta ?: null,
                'provider_payload' => $response,
                'verified_at' => null,
            ],
        );
    }

    /**
     * بررسی پرداخت با استفاده از شناسه یکتا
     */
    public function verifyPayment(string $paymentId, array $payload = []): AzkivamPayment
    {
        $payment = AzkivamPayment::where('payment_id', $paymentId)->firstOrFail();

        $body = [
            'payment_id' => $paymentId,
            'order_id' => $payment->order_id,
        ] + $payload;

        $response = $this->httpClient()->post($this->verifyEndpoint, $body)->throw()->json();

        $status = $this->resolveStatus($response);
        $trackingCode = $this->extractTrackingCode($response);

        $payment->forceFill([
            'status' => $status,
            'tracking_code' => $trackingCode,
            'provider_payload' => $this->mergePayload($payment->provider_payload, ['verify' => $response]),
            'verified_at' => $status === AzkivamPayment::STATUS_PAID ? now() : null,
        ])->save();

        return $payment;
    }

    protected function httpClient()
    {
        return Http::baseUrl($this->baseUrl)
            ->acceptJson()
            ->withToken($this->apiKey);
    }

    protected function extractPaymentId(array $response): string
    {
        $candidates = [
            'data.payment_id',
            'data.paymentId',
            'data.id',
            'payment_id',
            'paymentId',
            'id',
        ];

        foreach ($candidates as $key) {
            $value = data_get($response, $key);
            if (! empty($value)) {
                return (string) $value;
            }
        }

        throw new RuntimeException('شناسه پرداخت در پاسخ درگاه پیدا نشد.');
    }

    protected function extractGatewayUrl(array $response): ?string
    {
        $candidates = [
            'data.url',
            'data.gateway',
            'data.payment_url',
            'data.paymentUrl',
            'paymentUrl',
            'payment_url',
            'gateway_url',
            'gatewayUrl',
        ];

        foreach ($candidates as $key) {
            $value = data_get($response, $key);
            if (! empty($value)) {
                return (string) $value;
            }
        }

        return null;
    }

    protected function extractTrackingCode(array $response): ?string
    {
        $candidates = [
            'data.tracking_code',
            'data.trackingCode',
            'data.reference',
            'tracking_code',
            'trackingCode',
            'reference',
        ];

        foreach ($candidates as $key) {
            $value = data_get($response, $key);
            if (! empty($value)) {
                return (string) $value;
            }
        }

        return null;
    }

    protected function resolveStatus(array $response): string
    {
        $status = Str::lower((string) data_get($response, 'data.status', data_get($response, 'status', '')));

        if (in_array($status, ['success', 'succeeded', 'paid', 'ok'], true)) {
            return AzkivamPayment::STATUS_PAID;
        }

        if (in_array($status, ['pending', 'processing', 'waiting'], true)) {
            return AzkivamPayment::STATUS_WAITING_FOR_CALLBACK;
        }

        return AzkivamPayment::STATUS_FAILED;
    }

    protected function mergePayload(?array $original, array $new): array
    {
        return array_filter(array_merge($original ?? [], $new), fn($value) => $value !== null);
    }
}
