<?php

namespace Superrb\KunstmaanCdnBundle\Service;

use Superrb\KunstmaanCdnBundle\Provider\CloudflareProvider;
use Symfony\Component\DependencyInjection\Container;

class ClearCdnCacheService
{
    /**
     * @var string[]
     */
    const PROVIDERS = [
        'cloudflare' => CloudflareProvider::class,
    ];

    /**
     * @var ProviderInterface
     */
    protected $provider;

    public function __construct(Container $container, string $provider)
    {
        $this->provider = $container->get(self::PROVIDERS[$provider]);
    }

    public function clearCache(?array $files = [])
    {
        return $this->provider->clearCache($files);
    }
}
