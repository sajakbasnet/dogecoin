<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\LoginRequest;
use App\Transformers\LoginTransformer;
use League\Fractal\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response as Psr7Response;

class LoginController extends ApiController
{
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
            $data['username'] = $data['email'];
            unset($data['email']);
            $response = $this->server->respondToAccessTokenRequest($this->serverRequest->withParsedBody($data), new Psr7Response);
            if ($response->getStatusCode() == '200') {
                $data = json_decode((string)$response->getBody(), true);
                return $this->respondWithItem($data, new LoginTransformer, 'login');
            }else{
                return $response;
            }
        } catch (\Exception $e) {
            $this->errorInternalError();
        }
    }
}
