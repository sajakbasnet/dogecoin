<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RefreshTokenRequest;
use App\Services\Api\LoginService;
use App\Transformers\TokenTransformer;
use League\Fractal\Manager;


class LoginController extends ApiController
{
    public function __construct(LoginService $service)
    {
        parent::__construct(new Manager());
        $this->service = $service;
    }
    public function login(LoginRequest $request)
    {
        try {

            $data = $request->all();
            $data = $this->service->parseFormat($data);
            $data['username'] = $data['email'];
            unset($data['email']);

            $tokenData = $this->service->generateToken($data);

            return $this->respondWithItem($tokenData, new TokenTransformer, 'login');
        } catch (\Exception $e) {
            return $this->errorInternalError($e->getMessage(), 401);
        }
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        try {

            $data = $request->all();
            $data = $this->service->parseFormat($data);
            $data['refresh_token'] = $data['refreshToken'];
            unset($data['refreshToken']);

            $tokenData = $this->service->generateToken($data);

            return $this->respondWithItem($tokenData, new TokenTransformer, 'login');
        } catch (\Exception $e) {
            return $this->errorInternalError($e->getMessage(), 401);
        }
    }
}
