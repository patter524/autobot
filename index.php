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
// Get replyToken
$replyToken = $event['replyToken'];
$ask = $event['message']['text'];
switch(strtolower($ask)) {
case 'm':
$respMessage = 'What sup man. Go away!';
break;
case 'f':
$respMessage = 'Love you lady.';
break;
default:
$respMessage = 'What is your sex? M1 or F1';
break;
}
$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
$textMessageBuilder = new TextMessageBuilder($respMessage);
$response = $bot->replyMessage($replyToken, $textMessageBuilder);
}
}
echo "OK";
