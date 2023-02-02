<?php

namespace Tests\Feature;

use App\Helpers\Sha256;
use Tests\TestCase;

class Sha256Test extends TestCase
{
    public function test_it_should_hash_a_text()
    {
        $expected = 'dff6887d258e8e08565b25439d9ed9c5aa5a1e1ef92fae1daee95d6265be2a94'; // Hi you!  --> sha256
        $sh256 = new Sha256();
        $txt = 'Hi you!';

        $res = $sh256->hash($txt);

        $this->assertEquals($expected, $res);
    }
}
