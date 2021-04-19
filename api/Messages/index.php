<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/Message.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/MessageManager.php';

use App\Classes\DB;
use App\Entity\Message;
use App\Manager\MessageManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new MessageManager();
$username = 1;

$request = DB::getInstance()->prepare("SELECT * FROM clavardage.user");
$request->execute();
$messageData = $request->fetchAll();

if ($messageData){
    foreach($messageData as $data) {
        if ($data["username"] === $_COOKIE["username"]){
            $username = $data['id'];
        }
    }
}

switch($requestType) {

    case 'GET':
        echo getMessages($manager);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        if(isset($data->message)){
            $result = $manager->postMessage($data->message, $username);
        }
        if(isset($data->user)){
            $result = $manager->createUsername($data->user);
        }
        if(isset($data->userChange)){
            $result = $manager->changeUsername($data->userChange);
        }
        break;
}

/**
 * Return the message list.
 * @param MessageManager $manager
 * @return false|string
 */
function getMessages(MessageManager $manager): string {
    $response = [];

    $data = $manager->getMessages();
    foreach($data as $message) {
        /* @var Message $message */
        $response[] = [
            'message' => $message->getMessage(),
            'user' => $message->getUsername(),
            'datePost' => $message->getDatePost(),
        ];
    }

    return json_encode($response);
}

exit;