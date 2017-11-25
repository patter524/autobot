<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
// Token
$channel_token ='npw3T/uhYY7LP4WWi/ZGcecDTuvBB4uvU1nno/xUKyv5goSwafRNSzFX7DWTMAzxerjSZ+gIoigCY3TIpAfmXydCORXGct3Jm/EUQq+sOtYfQy+qqlwXx65DFfAUCHuhUjCq+Q4H6fJvdrdeTI89nQdB04t89/1O/w1cDnyilFU=';
$channel_secret = '09601a72fa04f02b55b4587b9f7347c4';

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

// Loop through each event
foreach ($events['events'] as $event) {

    // Line API send a lot of event type, we interested in message only.
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

    // Get replyToken
    $replyToken = $event['replyToken'];

    try {
        // Check to see user already answer
    $host = 'ec2-23-23-249-169.compute-1.amazonaws.com';
    $dbname = 'd355nho8tfr4eo';
    $user = 'fmltqorfsipopg';
    $pass = '39f71bc0396e4a5515a9e6215f1fe57ae6c118b1a58695b2e744cf9d91ba5dd1';
    $connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $sql = sprintf("SELECT * FROM poll WHERE user_id='%s' ", $event['source']['userId']);
    $result = $connection->query($sql);
    error_log($sql);
    if($result == false || $result->rowCount() <=0) {
    switch($event['message']['text']) {
    case '1':
    // Insert
    $params = array(
    'userID' => $event['source']['userId'],
    'answer' => '1',
    );
    $statement = $connection->prepare('INSERT INTO poll ( user_id, answer )
    VALUES ( :userID, :answer )');
    $statement->execute($params);
    // Query
    $sql = sprintf("SELECT * FROM poll WHERE answer='1' AND user_id='%s' ",
    $event['source']['userId']);
    $result = $connection->query($sql);
    $amount = 1;
    if($result){
    $amount = $result->rowCount();
    }
    $respMessage = 'จ ำนวนคนตอบว่ำเพื่อน = '.$amount;
    break;
    case '2':
    // Insert
    $params = array(
    'userID' => $event['source']['userId'],
    'answer' => '2',
    );
    $statement = $connection->prepare('INSERT INTO poll ( user_id, answer )
    VALUES ( :userID, :answer )');
    $statement->execute($params);
    // Query
$sql = sprintf("SELECT * FROM poll WHERE answer='2' AND user_id='%s' ",
$event['source']['userId']);
$result = $connection->query($sql);
$amount = 1;
if($result){
$amount = $result->rowCount();
}
$respMessage = 'จ ำนวนคนตอบว่ำแฟน = '.$amount;
break;
case '3':
// Insert
$params = array(
'userID' => $event['source']['userId'],
'answer' => '3',
);
$statement = $connection->prepare('INSERT INTO poll ( user_id, answer )
VALUES ( :userID, :answer )');
$statement->execute($params);
// Query
$sql = sprintf("SELECT * FROM poll WHERE answer='3' AND user_id='%s' ",
$event['source']['userId']);
$result = $connection->query($sql);
$amount = 1;
if($result){
$amount = $result->rowCount();
}
$respMessage = 'จ ำนวนคนตอบว่ำพ่อแม่ = '.$amount;
break;
case '4':
// Insert
$params = array(
'userID' => $event['source']['userId'],
'answer' => '4',
);
$statement = $connection->prepare('INSERT INTO poll ( user_id, answer )
VALUES ( :userID, :answer )');
$statement->execute($params);
// Query
$sql = sprintf("SELECT * FROM poll WHERE answer='4' AND user_id='%s' ",
$event['source']['userId']);
$result = $connection->query($sql);
$amount = 1;
if($result){
$amount = $result->rowCount();
}
$respMessage = 'จ ำนวนคนตอบว่ำบุคคลอื่นๆ = '.$amount;
break;
default:
$respMessage = "
บุคคลที่โทรหำบ่อยที่สุด คือ? \n\r
กด 1 เพื่อน \n\r
กด 2 แฟน \n\r
กด 3 พ่อแม่ \n\r
กด 4 บุคคลอื่นๆ \n\r
";
break;
}
} else {
$respMessage = 'คุณได้ตอบโพลล์นี้แล้ว';
}
$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
$textMessageBuilder = new TextMessageBuilder($respMessage);
$response = $bot->replyMessage($replyToken, $textMessageBuilder);
} catch(Exception $e) {
error_log($e->getMessage());
}
}
}
}   
echo "OK";
