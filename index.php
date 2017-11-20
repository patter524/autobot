<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token ='npw3T/uhYY7LP4WWi/ZGcecDTuvBB4uvU1nno/xUKyv5goSwafRNSzFX7DWTMAzxerjSZ+gIoigCY3TIpAfmXydCORXGct3Jm/EUQq+sOtYfQy+qqlwXx65DFfAUCHuhUjCq+Q4H6fJvdrdeTI89nQdB04t89/1O/w1cDnyilFU=';
$channel_secret = '0582990b4bd39d8af90a52e9f597af36';
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
// Loop through each event
foreach ($events['events'] as $event) {
// Line API send a lot of event type, we interested in message only.
if ($event['type'] == 'message') {
 switch($event['message']['type']) {
case 'text':
 // Get replyToken
 $replyToken = $event['replyToken'];
 // Reply message
 $respMessage = 'Hello, your message is '. $event['message']['text'];
 $httpClient = new CurlHTTPClient($channel_token);
 $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
 $textMessageBuilder = new TextMessageBuilder($respMessage);
 $response = $bot->replyMessage($replyToken, $textMessageBuilder);
break;
}
}
}
}
echo "OK";
?>
