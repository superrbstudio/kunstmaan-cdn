<?php

namespace Superrb\KunstmaanCdnBundle\Provider\Interfaces;

interface ProviderInterface
{
    public function clearCache(?array $files = []): bool;
}
