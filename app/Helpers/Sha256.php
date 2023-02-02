<?php

namespace App\Helpers;

class Sha256 implements \Core\Crypto\Crypto
{
    public function hash(string $txt): string {
        return hash('sha256', $txt);
    }
}
