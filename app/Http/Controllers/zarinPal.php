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
                return $response['data']['authority'];
            }else{
                return $response;
            }
    
        } catch (\Throwable $e) {
            report($e);
    
            // return [
            //     'error'   => true,
            //     'message' => $e->getMessage(),
            // ];
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

    public static function pay($request)
    {
        $MerchantID = config('zarinpal.merchantId');
        $client = new SoapClient(config('zarinpal.payment_verification_url'), ['encoding' => 'UTF-8']);
        $result = $client->PaymentRequest([
            'MerchantID'     => $MerchantID,
            'Amount'         => $request['amount'],
            'Description'    => $request['description'],
            'Mobile'         => $request['mobile'],
            'CallbackURL'    => $request['callbackUrl'],
        ]);

        if ($result->Status == 100) {
            return redirect(config('zarinpal.pay_url').$result->Authority);
        } else {
            return null;
        }

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
                return $response['data']['message'];
            }else{
                return $response;
            }
    
        } catch (\Throwable $e) {
            report($e);
    
            return [
                'error'   => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
