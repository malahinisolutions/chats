<?php
require __DIR__ . '/../vendor/autoload.php';

$filename='logfile.log';
$API_KEY = '690920531:AAF4OHPP-JK4qCWhli7EC2M3v8BhpMdsJFA';
$BOT_NAME = 'coinsample_bot';

define('PHPUNIT_TESTSUITE', 'some value');

$CREDENTIALS = array('host'=>'MYSQL5019.site4now.net', 'user'=>'9bc590_chatbot', 'password'=>'Password@abc123', 'database'=>'db_9bc590_chatbot');
 
$update = null;
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);
    $telegram->enableMySQL($CREDENTIALS);
    foreach (new SplFileObject($filename) as $current_line) {
        $json_decoded = json_decode($update, true);
        if (!is_null($json_decoded)) {
            echo $update . "\n\n";
            $update = null;
            if (empty($json_decoded)) {
                echo "Empty update: \n";
                echo $update . "\n\n";
                continue;
            }
            $telegram->processUpdate(new Longman\TelegramBot\Entities\Update($json_decoded, $BOT_NAME));
        }
        $update .= $current_line;
    }

} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    echo $e;
}
