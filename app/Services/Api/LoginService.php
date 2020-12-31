<?php
namespace App\Services\Api;
use Nyholm\Psr7\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

class LoginService
{
    public function __construct(ServerRequestInterface $request, AuthorizationServer $server){
        $this->serverRequest = $request;
        $this->server = $server;
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
}