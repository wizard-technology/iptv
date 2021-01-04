<?php

namespace App\Http\Middleware;

use App\Application;
use Closure;
use Illuminate\Http\Request;

class isAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function test(Request $request)
    // {
    // $method = 'aes-256-cbc';
    // $secret_key = utf8_encode("965039792952d7a310234e1de59aad26");
    // $decryptedString = openssl_decrypt( $request->header('X-Auth-Nonce') , $method, "2ed8s4xgzwknjl6i16z4yqpndh3xrg6j", 0, "e16ce913a20dadb8");
    // $sig = hash_hmac('SHA256', utf8_encode($decryptedString . $request->header('X-Auth-Apikey')), $secret_key);

    // return response()->json([
    //     'access' => 'OK',
    // ], 200);
    // }
    public function handle(Request $request, Closure $next)
    {
        $app = Application::find($request->header('X-Auth-App'));
        if (is_null($app)) {
            return response()->json([
                'error' => 'Forbidden',
                'message' => 'Application not Found',
            ], 403);
        }
        $method = 'aes-256-cbc';
        // $access_key = $app->app_access;
        $secret_key = $app->app_secret;
        $decryptedString = openssl_decrypt($request->header('X-Auth-Nonce'), $method, "2ed8s4xgzwknjl6i16z4yqpndh3xrg6j", 0, "e16ce913a20dadb8");
        $sig = hash_hmac('SHA256', utf8_encode($decryptedString . $request->header('X-Auth-Apikey')), $secret_key);
        if ($sig == $request->header('X-Auth-Signature')) {
            return $next($request);
        }
        return response()->json([
            'error' => 'Unauthorized',
            'message' => 'Access Denied',
        ], 401);
    }
}
