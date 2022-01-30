<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

class StrategyFactory implements StrategyFactoryInterface
{
    public function createHeader(string $headerName): StrategyInterface
    {
        return new HeaderStrategy($headerName);
    }

    public function createNull(): StrategyInterface
    {
        return new NullStrategy();
    }

    public function createQuery(string $queryName): StrategyInterface
    {
        return new QueryStrategy($queryName);
    }
}
