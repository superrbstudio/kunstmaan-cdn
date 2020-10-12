# Kunstmaan CDN

Allows integration with a variety of Content Delivery Networks

Currently Supported

- Cache Purging
  - Cloudflare https://www.cloudflare.com
  - KeyCDN https://www.keycdn.com
  
## Installation

### Step 1: Install the bundle

```
composer require superrb/kunstmaan-cdn
```

Add the following to `config/bundles.php`
```
Superrb\KunstmaanAddonsBundle\SuperrbKunstmaanCdnBundle::class => ['all' => true],
```

### Step 2: Add environment variables

Add the following to your `.env`

```dotenv
###> superrb/kunstmaan-cdn ###
CLOUDFLARE_API_TOKEN=
CLOUDFLARE_ZONE_ID=
KEYCDN_API_KEY=
KEYCDN_ZONE_ID=
CDN_PROVIDER=
###< superrb/kunstmaan-cdn ###
```

You can then configure your preferred CDN in your `.env.local`, For example to configure Cloudflare:

```dotenv
###> superrb/kunstmaan-cdn ###
CLOUDFLARE_API_TOKEN=<API_TOKEN>
CLOUDFLARE_ZONE_ID=<ZONE_ID>
CDN_PROVIDER=cloudflare
###< superrb/kunstmaan-cdn ###
```

## Usage

You can purge the cache for your website:

```
$ bin/console cdn:cache:clear
```

## Issues and Troubleshooting
All issues: tech@superrb.com