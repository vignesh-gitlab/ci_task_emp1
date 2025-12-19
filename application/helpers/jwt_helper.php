<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/php-jwt/src/JWT.php';

use Firebase\JWT\JWT;

function generate_jwt($data)
{
    $key = 'SECRET_KEY_123';

    $payload = [
        'iat'  => time(),
        'exp'  => time() + 3600,
        'data' => $data
    ];

    return JWT::encode($payload, $key);
}

function validate_jwt($token)
{
    try {
        $key = 'SECRET_KEY_123';
        return JWT::decode($token, $key, ['HS256']);
    } catch (Exception $e) {
        return false;
    }
}