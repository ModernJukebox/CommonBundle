<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

interface StrategyFactoryInterface
{
    public function createHeader(string $headerName): StrategyInterface;

    public function createNull(): StrategyInterface;

    public function createQuery(string $queryName): StrategyInterface;
}
