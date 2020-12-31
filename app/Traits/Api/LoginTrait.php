<?php
namespace App\Traits\Api;

use Nyholm\Psr7\Response as Psr7Response;

trait LoginTrait
{
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