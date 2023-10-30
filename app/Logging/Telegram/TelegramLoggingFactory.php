<?php

namespace App\Logging\Telegram;

use Monolog\Logger;

class TelegramLoggingFactory
{
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('telegram');

        $logger->pushHandler(new TelegramLoggingHandler($config));

        return $logger;
    }

}
