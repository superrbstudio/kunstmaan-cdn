<?php

namespace Superrb\KunstmaanCdnBundle\Provider\Interfaces;

interface ProviderInterface
{
    public function getName(): string;

    public function clearCache(?array $files = []): bool;
}
