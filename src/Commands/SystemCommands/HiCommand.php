<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class HiCommand extends SystemCommand
{
    protected $name = 'hi';                      // Your command's name
    protected $description = 'Hi there!'; // Your command description
    protected $usage = '/hi';                    // Usage of your command
    protected $version = '1.0.0';                  // Version of your command

    public function execute()
    {
        $message = $this->getMessage();            // Get Message object

        $chat_id = $message->getChat()->getId();   // Get the current Chat ID

        $data = [                                  // Set up the new message data
            'chat_id' => $chat_id,                 // Set Chat ID to send the message to
            'text'    => 'Hi there!' . PHP_EOL . 'Welcome to cointest. How may i help you today?', // Set message to send
        ];

        return Request::sendMessage($data);        // Send message!
    }
}
