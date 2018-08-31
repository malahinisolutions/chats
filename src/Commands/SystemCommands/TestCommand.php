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

        $chat_id = $message->getChat()->getId();   // Get the current Chat ID -251833595
		
        $command_str = trim($message->getText(true));
		
        $data1 = [                                  // Set up the new message data
            'chat_id' => '-251833595',                 // Set Chat ID to send the message to
            'text'    => $command_str,//'This is just a Test group message...', // Set message to send
        ];
 
         Request::sendMessage($data1);        // Send message!
		$data = [                                  // Set up the new message data
            'chat_id' => '-236744087',                 // Set Chat ID to send the message to
            'text'    => $command_str,//'This is just a Test group message...', // Set message to send
        ];
 
         Request::sendMessage($data);    
    }
}

