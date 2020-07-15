<?php

namespace App\Http\Controllers\frontend\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = array(
            'email' => $request->email,
            'password' => $request->password
        );
        return $this->getAccessandRefreshtoken($request);
    }

    public function getAccessandRefreshtoken($request)
    {
        $http = new Client();
        if (env('APP_ENV') == "local") {
            $url = "http://127.0.0.1:8000/oauth/token";
        } else {
            $url = url('/oauth/token');
        }
        $response = $http->request('POST', $url, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $request->clientId,
                'client_secret' => $request->clientSecret,
                'username' => $request->email,
                'password' => $request->password,
                'provider' => $request->provider
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, 200);
    }
}
