<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

use Symfony\Component\HttpFoundation\Request;

class HeaderStrategy implements StrategyInterface
{
    private string $headerName;

    public function __construct(string $headerName)
    {
        $this->headerName = $headerName;
    }

    public function authenticate(Request $request, string $token): Request
    {
        $request->headers->set($this->headerName, $token);

        return $request;
    }
}
