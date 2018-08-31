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
		$con=mysqli_connect("MYSQL5019.site4now.net","9bc590_chatbot","Password@abc123","db_9bc590_chatbot");
$sql="SELECT id FROM `chat` WHERE `type`='group'";
$result = $con->query($sql);
$rows = array();
while($row = $result->fetch_assoc()) {
	$rows[] = $row;
	}
foreach($rows as $chatId) {
	 
	 $data = [                                   
            'chat_id' => $chatId['id'],                 // Set Chat ID to send the message to
            'text'    => $command_str,//'This is just a Test group message...', // Set message to send
        ];
 
         Request::sendMessage($data);        // Send message!
}
mysqli_free_result($result);
mysqli_close($con);
        
		 
    }
}

