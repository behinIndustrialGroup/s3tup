<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SoapClient;
use Illuminate\Support\Facades\Http;

class zarinPal
{
    public static function getAuthority($amount, $description, $mobile, $callbackUrl){
        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->post(config('zarinpal.authority_url'), [
                    'merchant_id'  => config('zarinpal.merchantId'),
                    'amount'       => $amount,
                    'callback_url' => $callbackUrl,
                    'description'  => $description,
                    'mobile'     => $mobile,
                ]);
    
            $response->throw();
            if($response['data']['code'] == '100'){
                return [
                    'authority' => $response['data']['authority'],
                    'status' => 200,
                ];
            }else{
                return [
                    'authority' => null,
                    'status' => 400,
                    'zarinpal_error_code' => $response['data']['code'],
                ];
            }
    
        } catch (\Throwable $e) {
            report($e);
    
            return [
                'authority' => null,
                'status' => 500,
                'message' => $e->getMessage(),
            ];
        }
        $client = new SoapClient(config('zarinpal.payment_verification_url'), ['encoding' => 'UTF-8']);
        $result = $client->PaymentRequest([
            'MerchantID'     => $MerchantID,
            'Amount'         => $amount,
            'Description'    => $description,
            'Mobile'         => $mobile,
            'CallbackURL'    => $callbackUrl,
        ]);

        if ($result->Status == 100)
            return $result->Authority;
        return $result;
    }


    public static function verify($authority, $amount)
    {
        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->post(config('zarinpal.payment_verification_url'), [
                    'merchant_id' => config('zarinpal.merchantId'),
                    'amount'      => $amount,
                    'authority'   => $authority,
                ]);
    
            $response->throw();
            if($response['data']['code'] == '100'){
                return [
                    'result' => $response['data']['message'],
                    'status' => 200,
                ];
            }else{
                return [
                    'result' => $response['data']['message'],
                    'status' => 400,
                    'zarinpal_error_code' => $response['data']['code'],
                ];
            }
    
        } catch (\Throwable $e) {
            report($e);
    
            return [
                'result' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}
