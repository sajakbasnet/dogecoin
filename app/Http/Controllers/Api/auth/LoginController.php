<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RefreshTokenRequest;
use App\Traits\Api\LoginTrait;
use App\Transformers\TokenTransformer;
use League\Fractal\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends ApiController
{
    use LoginTrait;

    public function __construct(ServerRequestInterface $request, AuthorizationServer $server)
    {
        parent::__construct(new Manager());
        $this->serverRequest = $request;
        $this->server = $server;
    }
    public function login(LoginRequest $request)
    {
        try {

            $data = $request->all();
            $data = $this->parseFormat($data);
            $data['username'] = $data['email'];
            unset($data['email']);

            $tokenData = $this->generateToken($data);

            return $this->respondWithItem($tokenData, new TokenTransformer, 'login');
        } catch (\Exception $e) {
            return $this->errorInternalError($e->getMessage(), 401);
        }
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        try {

            $data = $request->all();
            $data = $this->parseFormat($data);
            $data['refresh_token'] = $data['refreshToken'];
            unset($data['refreshToken']);

            $tokenData = $this->generateToken($data);

            return $this->respondWithItem($tokenData, new TokenTransformer, 'login');
        } catch (\Exception $e) {
            return $this->errorInternalError($e->getMessage(), 401);
        }
    }
}
