<?php

namespace Superrb\KunstmaanCdnBundle\Service;

use Psr\Container\ContainerInterface;
use Superrb\KunstmaanCdnBundle\Provider\CloudflareProvider;
use Superrb\KunstmaanCdnBundle\Provider\KeyCdnProvider;

class ClearCdnCacheService
{
    /**
     * @var string[]
     */
    const PROVIDERS = [
        'cloudflare' => CloudflareProvider::class,
        'keycdn'     => KeyCdnProvider::class,
    ];

    /**
     * @var ProviderInterface
     */
    protected $provider;

    public function __construct(ContainerInterface $container, string $provider)
    {
        $this->provider = $container->get(self::PROVIDERS[$provider]);
    }

    public function getProviderName()
    {
        return $this->provider->getName();
    }

    public function clearCache(?array $files = [])
    {
        return $this->provider->clearCache($files);
    }
}
