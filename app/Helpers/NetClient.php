<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class NetClient implements \Core\Net\NetClient
{
    private Request $request;
    
    public function __construct(Request $req)
    {
        $this->request = $req;
    }
    
    public function getIp(): string {
        return $this->request->ip();
    }
    
    public function getUserAgent(): string {
        return $this->request->header('User-Agent');
    }
}
