<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

use Symfony\Component\HttpFoundation\Request;

class QueryStrategy implements StrategyInterface
{
    private string $queryName;

    public function __construct(string $queryName)
    {
        $this->queryName = $queryName;
    }

    public function authenticate(Request $request, string $token): Request
    {
        $request->query->set($this->queryName, $token);

        return $request;
    }
}
