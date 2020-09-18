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
        $this->client = new Client([
            'auth' => [$apiKey.':', ''],
        ]);
        $this->apiKey  = $apiKey;
        $this->zoneId  = $zoneId;
        $this->baseUrl = $baseUrl;
    }

    public function clearCache(?array $files = []): bool
    {
        if (empty($files)) {
            return $this->clearCacheFull();
        }

        $zoneId   = $this->zoneId;
        $response = $this->client->delete("https://api.keycdn.com/zones/purgeurl/$zoneId.json", [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'urls' => array_map(function (string $file) use ($baseUrl): string {
                    return $baseUrl.$file;
                }, $files),
            ]),
        ]);

        dump($response);
    }

    public function clearCacheFull(): bool
    {
        $zoneId   = $this->zoneId;
        $response = $this->client->get("https://api.keycdn.com/zones/purge/$zoneId.json");
        dump($response);
    }
}