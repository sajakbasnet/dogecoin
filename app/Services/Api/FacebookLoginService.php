<?php
namespace App\Services\Api;

use GuzzleHttp\Client;

class FacebookLoginService
{
    public function facebookUserData($accessToken){
       dd($accessToken); 
    }

    protected function parseUserData($data){
        $googleUserData = [
            'email' => $data['email'] ?? null,
            'given_name' => $data['given_name'] ?? null,
            'family_name' => $data['family_name'] ?? null,
            'name' => $data['name'] ?? null,
            'picture' => $data['picture'] ?? null,
            'user_id' => $data['sub'] ?? null
        ];
        return $googleUserData;
    }
}