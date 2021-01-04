<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationApp;
use App\Http\Resources\ChannelApp;
use App\Application;
use App\Channel;
use App\ChannelApp as ModelsChannelApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationManage extends Controller
{
    public function channels(Request $request)
    {
        return ApplicationApp::collection(DB::table('channels')
            ->join('channel_apps', 'channels.id', '=', 'channel_apps.ac_channel')
            ->select('channels.ch_title', 'channels.ch_subtitle', 'channels.ch_star', 'channels.ch_link', 'channels.ch_image', 'channels.ch_state', 'channels.id', 'channel_apps.ac_channel')
            ->where('channels.ch_state', 1)
            ->get());
    }
    public function decrypt(Request $request)
    {
        $method = 'aes-256-cbc';
        $access_key = "1234567890123456";
        $secret_key = "EiVPCbmSdNovtQDoM8RyfWE8BHoGwBa8";
        $nonce =  openssl_decrypt(utf8_decode($request->header('X-Auth-Nonce')), $method, "2ed8s4xgzwknjl6i16z4yqpndh3xrg6j", 0, "e16ce913a20dadb8");
        $sig = hash_hmac('SHA256', $nonce, $secret_key);
        if ($sig == $request->api) {
            return response()->json([
                'DONE'
            ], 200);
        }
    }
    public function encrypt(Request $request)
    {
        $method = 'aes-256-cbc';
        $nonce = time();
        $access_key = "1234567890123456";
        $secret_key = "EiVPCbmSdNovtQDoM8RyfWE8BHoGwBa8";
        $nonce_time =  utf8_encode(openssl_encrypt($nonce, $method, "2ed8s4xgzwknjl6i16z4yqpndh3xrg6j", 0, "e16ce913a20dadb8"));
        $sig = hash_hmac('SHA256', $nonce, $secret_key);

        return response()->json([
            'nonce' => $nonce_time,
            'sig' => $sig,
        ], 200);
    }
}
