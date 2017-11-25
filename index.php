<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
// Token
$channel_token ='npw3T/uhYY7LP4WWi/ZGcecDTuvBB4uvU1nno/xUKyv5goSwafRNSzFX7DWTMAzxerjSZ+gIoigCY3TIpAfmXydCORXGct3Jm/EUQq+sOtYfQy+qqlwXx65DFfAUCHuhUjCq+Q4H6fJvdrdeTI89nQdB04t89/1O/w1cDnyilFU=';
$channel_secret = '09601a72fa04f02b55b4587b9f7347c4';
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
// Loop through each event
foreach ($events['events'] as $event) {
    // Line API send a lot of event type, we interested in message only.
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
    // Get replyToken
    $replyToken = $event['replyToken'];
    // Split message then keep it in database.
    $appointments = explode(',', $event['message']['text']);
    if(count($appointments) == 2) {
    $host = 'ec2-23-23-249-169.compute-1.amazonaws.com';
    $dbname = 'd355nho8tfr4eo';
    $user = 'fmltqorfsipopg';
    $pass = '39f71bc0396e4a5515a9e6215f1fe57ae6c118b1a58695b2e744cf9d91ba5dd1';
    $connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $params = array(
    'time' => $appointments[0],
    'content' => $appointments[1],
    );
    $statement = $connection->prepare("INSERT INTO appointments (time, content) VALUES (:time,
    :content)");
    $result = $statement->execute($params);
    $respMessage = 'Your appointment has saved.';
    }else{
    $respMessage = 'You can send appointment like this "12.00,House keeping." ';
    }
    $httpClient = new CurlHTTPClient($channel_token);
    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
    $textMessageBuilder = new TextMessageBuilder($respMessage);
    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
    }
    }
    }
    echo "OK";
    