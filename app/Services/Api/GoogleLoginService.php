<?php
namespace App\Services\Api;

use App\Exceptions\Api\EmailIdNotFound;
use GuzzleHttp\Client;

class GoogleLoginService
{
    public function googleUserData($accessToken){
        $http = new Client();
        $url = "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=" . $accessToken;
        $response = $http->get(
            $url
        );
        $data = json_decode((string) $response->getBody(), true);
        $parsedData = $this->parseUserData($data);
        if (empty($parsedData['email'])) {
            throw new EmailIdNotFound();
        }
        return $parsedData;
    }

    protected function parseUserData($data){
        $googleUserData = [
            'email' => $data['email'] ?? null,
            'given_name' => $data['given_name'] ?? null,
            'family_name' => $data['family_name'] ?? null,
            'name' => $data['name'] ?? null,
            'picture' => $data['picture'] ?? null,
            'user_id' => $data['sub'] ?? null,
            'provider' => 'google'
        ];
        return $googleUserData;
    }
}