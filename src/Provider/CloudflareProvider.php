<?php

namespace Superrb\KunstmaanCdnBundle\Provider;

use Gpenverne\CloudflareBundle\Services\CloudflareService;
use Superrb\KunstmaanCdnBundle\Provider\Interfaces\ProviderInterface;

class CloudflareProvider implements ProviderInterface
{
    /**
     * @var CloudflareService
     */
    protected $cloudflare;

    /**
     * @var string
     */
    protected $zoneId;

    public function __construct(CloudflareService $cloudflare, string $zoneId)
    {
        $this->cloudflare = $cloudflare;
        $this->zoneId     = $zoneId;
    }

    public function clearCache(?array $files = []): bool
    {
        if (empty($files)) {
            return $this->clearCacheFull();
        }

        return (bool) $this->cloudflare->zones->cachePurge($this->zoneId, $files);
    }

    public function clearCacheFull(): bool
    {
        return (bool) $this->cloudflare->zones->cachePurgeEverything($this->zoneId);
    }
}
