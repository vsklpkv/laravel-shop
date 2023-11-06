<?php

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\LogRecord;

class TelegramLoggingHandler extends AbstractProcessingHandler
{
    protected int $chat_id;
    protected string $token;
    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);
        parent::__construct($level);
        $this->chat_id = (int) $config['chat_id'];
        $this->token = $config['token'];
    }

    protected function write(LogRecord $record): void
    {
        $data = $record->toArray();

        TelegramBotApi::sendMessage(
            $this->token,
            $this->chat_id,
            $data['message']
        );
    }
}
