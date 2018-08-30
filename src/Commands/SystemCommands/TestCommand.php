<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class TestCommand extends SystemCommand
{
    protected $name = 'test';                      // Your command's name
    protected $description = 'A command for test'; // Your command description
    protected $usage = 'test';                    // Usage of your command
    protected $version = '1.0.0';                  // Version of your command

    public function execute()
    {
        $message = $this->getMessage();            // Get Message object

        $chat_id = $message->getChat()->getId();   // Get the current Chat ID
		/*
        $command_str = trim($message->getText(true));
        $data = [                                  // Set up the new message data
            'chat_id' => '-236744087',                 // Set Chat ID to send the message to
            'text'    => $command_str,//'This is just a Test group message...', // Set message to send
        ];*/
$data = [                                  // Set up the new message data
            'chat_id' => $chat_id,                 // Set Chat ID to send the message to
            'text'    => $chat_id,//'This is just a Test group message...', // Set message to send
        ];
        return Request::sendMessage($data);        // Send message!
    }
}

