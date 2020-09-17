<?php

namespace Superrb\KunstmaanCdnBundle;

use Superrb\KunstmaanCdnBundle\DependencyInjection\SuperrbKunstmaanCdnExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SuperrbKunstmaanCdnBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->registerExtension(new SuperrbKunstmaanCdnExtension());
    }
}
