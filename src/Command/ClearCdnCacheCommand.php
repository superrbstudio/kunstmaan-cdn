<?php

namespace Superrb\KunstmaanCdnBundle\Command;

use Superrb\KunstmaanCdnBundle\Service\ClearCdnCacheService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCdnCacheCommand extends Command
{
    /**
     * @var ClearCdnCacheService
     */
    protected $service;

    public function __construct(ClearCdnCacheService $service)
    {
        $this->service = $service;

        parent::__construct('cdn:cache:clear');
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->service->clearCache();
    }
}
