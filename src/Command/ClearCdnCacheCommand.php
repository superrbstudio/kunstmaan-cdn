<?php

namespace Superrb\KunstmaanCdnBundle\Command;

use Psr\Log\LoggerInterface;
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

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(ClearCdnCacheService $service, LoggerInterface $logger)
    {
        $this->service = $service;
        $this->logger  = $logger;

        parent::__construct('cdn:cache:clear');
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $msg    = 'Clear '.$this->service->getProviderName().' cache: ';
        $status = 'FAIL';
        try {
            if ($this->service->clearCache()) {
                $status = 'OK';
            }
        } catch (\Throwable $th) {
            $this->logger->critical($th->getMessage());
        }

        $output->writeln($msg.$status);
    }
}
