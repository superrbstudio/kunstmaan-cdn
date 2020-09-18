<?php

namespace Superrb\KunstmaanCdnBundle\Provider;

use GuzzleHttp\Client;
use Superrb\KunstmaanCdnBundle\Provider\Interfaces\ProviderInterface;

class KeyCdnProvider implements ProviderInterface
{
    /**
     * @var string
     */
    protected $apiKey;
    /**
     * @var string
     */
    protected $zoneId;

    /**
     * @var string
     */
    protected $baseUrl;

    public function __construct(string $apiKey, string $zoneId, string $baseUrl)
    {
        $this->client  = new Client();
        $this->apiKey  = $apiKey;
        $this->zoneId  = $zoneId;
        $this->baseUrl = $baseUrl;
    }

    public function getName(): string
    {
        return 'KeyCDN';
    }

    protected function getAuth(): array
    {
        return [$this->apiKey, ''];
    }

    public function clearCache(?array $files = []): bool
    {
        if (empty($files)) {
            return $this->clearCacheFull();
        }

        $zoneId   = $this->zoneId;
        $baseUrl  = $this->baseUrl;
        $response = $this->client->delete("https://api.keycdn.com/zones/purgeurl/$zoneId.json", [
            'auth' => $this->getAuth(),
            'json' => [
                'urls' => array_map(function (string $file) use ($baseUrl): string {
                    return $baseUrl.$file;
                }, $files),
            ],
        ]);

        dump(json_decode((string) $response->getBody()));
    }

    public function clearCacheFull(): bool
    {
        $zoneId   = $this->zoneId;
        $response = $this->client->get("https://api.keycdn.com/zones/purge/$zoneId.json", [
            'auth' => $this->getAuth(),
        ]);
        dump(json_decode((string) $response->getBody()));
    }
}
