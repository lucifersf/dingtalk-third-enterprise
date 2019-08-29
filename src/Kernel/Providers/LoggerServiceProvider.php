<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\Providers;

use Monolog\Logger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LoggerServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param \Pimple\Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        isset($pimple['logger']) || $pimple['logger'] = function ($app) {
            return new Logger('LuciferDingTalkThirdPartyEnterprise');
        };
    }
}
