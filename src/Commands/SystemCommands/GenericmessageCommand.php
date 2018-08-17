<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Commands\SystemCommand;

/**
 * Generic message command
 */
class GenericmessageCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * @var bool
     */
    protected $need_mysql = true;

    /**
     * Execution if MySQL is required but not available
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     */
    public function executeNoDb()
    {
        //Do nothing
        return Request::emptyResponse();
    }

    /**
     * Execute command
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        //If a conversation is busy, execute the conversation command after handling the message
        $conversation = new Conversation(
            $this->getMessage()->getFrom()->getId(),
            $this->getMessage()->getChat()->getId()
        );

        //Fetch conversation command if it exists and execute it
        if ($conversation->exists() && ($command = $conversation->getCommand())) {
            return $this->telegram->executeCommand($command);
        }
        $message = $this->getMessage();            // Get Message object

        $chat_id = $message->getChat()->getId();   // Get the current Chat ID

        $text = trim($message->getText(true));
        if(strtolower(trim($text))=='hi' || strtolower(trim($text))=='hey' ||strtolower(trim($text))=='howdy')
        {
          $data = [                                  // Set up the new message data
              'chat_id' => $chat_id,                 // Set Chat ID to send the message to
              'text'    => 'Hi there!' . PHP_EOL . 'Welcome to cointest. How may i help you today?', // Set message to send
          ];
        }elseif(strtolower(trim($text))=='hello')
        {
          $data = [                                  // Set up the new message data
              'chat_id' => $chat_id,                 // Set Chat ID to send the message to
              'text'    => 'Hello there!' . PHP_EOL . 'Welcome to cointest. How may i help you today?', // Set message to send
          ];
        }elseif(strtolower(trim($text))=='i want to buy coin' || strtolower(trim($text))=='buy coin' || strtolower(trim($text))=='buy coins' || strtolower(trim($text))=='i want to buy coins' || strtolower(trim($text))=='coin buy' || strtolower(trim($text))=='coins buy' || strtolower(trim($text))=='how to buy coin'
        || strtolower(trim($text))=='how to buy coin?' || strtolower(trim($text))=='how to buy coins'|| strtolower(trim($text))=='how to buy coins?'|| strtolower(trim($text))=='where to buy coin'|| strtolower(trim($text))=='where to buy coin?'|| strtolower(trim($text))=='where to buy coins'|| strtolower(trim($text))=='where to buy coins?')
        {
          $data = [                                  // Set up the new message data
              'chat_id' => $chat_id,                 // Set Chat ID to send the message to
              'text'    => "Please visit our website www.example.com and visit 'Buy' page and follow steps to purchase coins.", // Set message to send
          ];
        }elseif(strtolower(trim($text))=='thank you' || strtolower(trim($text))=='thanks' || strtolower(trim($text))=='thank you very much'|| strtolower(trim($text))=='thank you so much')
        {
          $data = [                                  // Set up the new message data
              'chat_id' => $chat_id,                 // Set Chat ID to send the message to
              'text'    => "It was a pleasure helping you today. Please visit www.example.com for more information. Have a nice day.", // Set message to send
          ];
        }elseif(strtolower(trim($text))=='how are you' || strtolower(trim($text))=='how are you?')
        {
          $data = [                                  // Set up the new message data
              'chat_id' => $chat_id,                 // Set Chat ID to send the message to
              'text'    => "I am fine, Thank you.How may i help you today?", // Set message to send
          ];
        }elseif(strtolower(trim($text))=='download wallet' || strtolower(trim($text))=='wallet download'|| strtolower(trim($text))=='how to download wallet')
        {
          $data = [                                  // Set up the new message data
              'chat_id' => $chat_id,                 // Set Chat ID to send the message to
              'text'    => 'To download the wallet, please visit www.example.com and follow instructions.', // Set message to send
          ];
        }else{
          $data = [                                  // Set up the new message data
              'chat_id' => $chat_id,                 // Set Chat ID to send the message to
              'text'    => 'Thank you for contacting cointest support.'.PHP_EOL.'Please email us your query on support@example.com and we will get back to you.'.PHP_EOL.'Thank you.', // Set message to send
          ];
        }



        return Request::sendMessage($data);
        //return Request::emptyResponse();
    }
}
