<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class customAccessTokenController extends AccessTokenController
{
    public function issueUserToken(LoginRequest $request, ServerRequestInterface $serverRequest)
    {
        $response = $this->issueToken($serverRequest);
        return $response;
    }
}
