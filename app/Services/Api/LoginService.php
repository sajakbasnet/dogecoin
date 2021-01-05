<?php

namespace App\Services\Api;

use App\Exceptions\Api\ApiGenericException;
use Nyholm\Psr7\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

class LoginService
{
    public function __construct(
        ServerRequestInterface $request,
        AuthorizationServer $server,
        GoogleLoginService $google,
        FacebookLoginService $facebook,
        SocialService $service
    ) {
        $this->serverRequest = $request;
        $this->server = $server;
        $this->google = $google;
        $this->facebook = $facebook;
        $this->service = $service;
    }

    public function parseFormat($data)
    {
        $data['client_id'] = $data['clientId'];
        $data['client_secret'] = $data['clientSecret'];
        $data['grant_type'] = $data['grantType'];

        unset($data['clientId'], $data['clientSecret'], $data['grantType']);
        return $data;
    }
    public function generateToken($data)
    {
        $response = $this->server->respondToAccessTokenRequest($this->serverRequest->withParsedBody($data), new Psr7Response);
        return json_decode((string)$response->getBody(), true);
    }

    public function loginWithGoogle($request)
    {
        try {
            $googleUserData = $this->google->googleUserData($request->accessToken);
            $user = $this->service->setOrGetUser($googleUserData);
            $parsedData = $this->parseFormat($request->only('clientId', 'clientSecret', 'grantType'));
            $parsedData['provider'] = $user->provider;
            $parsedData['provider_user_id'] = $user->provider_user_id;
            return $this->generateToken($parsedData);
        } catch (\Exception $e) {
            throw new ApiGenericException('Invalid access token provided.');
        }
    }

    public function loginWithFacebook($request)
    {
        try {
            $facebookUserData = $this->facebook->facebookUserData($request->accessToken);
            dd($facebookUserData);
        } catch (\Exception $e) {
            throw new ApiGenericException($e->getMessage());
        }
    }
}
