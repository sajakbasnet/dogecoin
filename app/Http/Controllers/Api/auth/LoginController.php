<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::guard('frontendUsers')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->getAccessandRefreshtoken($request);
        }
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
                'grant_type' => $request->grantType,
                'client_id' => $request->clientId,
                'client_secret' => $request->clientSecret,
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, 200);
    }
}
