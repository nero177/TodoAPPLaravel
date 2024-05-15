<?php

namespace App\DTO;

class TokenDTO
{
    public static function getTokenResponse($token){
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ];
    }
}
