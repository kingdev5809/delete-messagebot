<?php

ob_start();
set_time_limit(0);

define('API_KEY', '5760656617:AAGOLDudA00Xsm1pmMj7tl4PXGNUUWEx4gs');
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}



$update = json_decode(file_get_contents('php://input'));
var_dump($update);

//User
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$firs_name = $message->from->first_name;
$username = $message->from->username;
$user_name = $message->chat->username;
$type = $message->chat->type;
$message_id = $message->message_id;

 
@$link_media = $message->caption_entities[0]->type;
@$link_chat = $message->entities[0]->type;

$entities = $message->entities;


if($text == "/start"){
    bot('sendmessage',[
        'chat_id' => $chat_id,
        'text'=>"Assalomu alaykum",
    ]);
 }


 elseif(isset($update->message-> new_chat_member )){
    bot('deleteMessage', [
       'chat_id' => $chat_id,
       'message_id' => $message_id
    ]);
}

elseif(isset($update->message-> left_chat_member )){
    bot('deleteMessage', [
       'chat_id' => $chat_id,
       'message_id' => $message_id
    ]);
}
elseif(isset($update->message-> leaveChat )){
bot('deleteMessage', [
       'chat_id' => $chat_id,
       'message_id' => $message_id
    ]);
}

?>
