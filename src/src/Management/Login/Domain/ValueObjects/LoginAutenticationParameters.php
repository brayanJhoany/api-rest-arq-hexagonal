<?php

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\MixedValueObject;

final class LoginAutenticationParameters extends MixedValueObject
{

    public function handler()
    {
        return [
            'ait' => time(),
            'exp' => $this->getTime(),
            'aud' => $this->getAud(),
            'data' => $this->value()
        ];
    }
    public function jwtKey(): string
    {
        return env('JWT_KEY');
    }
    public function jwtEncryot(): string
    {
        return env('JWT_ENCRYPT');
    }

    private function getTime(): float | int
    {
        $time = time();
        return $time + (60 * 60);
    }
    private function getAud(): ?string
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            $aud = $_SERVER['REMOTE_ADDR'];
        }
        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();
        return sha1($aud ?? null);
    }
}