<?php

namespace App\Manager;

use App\Classes\DB;
use App\Entity\Message;
use PDO;

class MessageManager {

    public function getMessages() :array{
        $messageGet = [];
        $request = DB::getInstance()->prepare("SELECT * FROM clavardage.message
                                                     INNER JOIN clavardage.user ON message.fk_username = user.id");
        $request->execute();
        $messageData = $request->fetchAll();
        if ($messageData){
            foreach($messageData as $data) {
                $messageGet[] = new Message($data['message'], $data['username'], $data['post_date']);
            }
        }
        return $messageGet;
    }

    /**
     * Add a new student into the database.
     * @param string $message
     * @param int $username
     * @return bool
     */
    public function postMessage(string $message, int $username): bool{
        $request = DB::getInstance()->prepare("
            INSERT INTO clavardage.message (fk_username, message)
              VALUES (:username, :message)
        ");
        $request->bindParam(':username', $username);
        $request->bindParam(':message', $message);
        $request->execute();
        return intval(DB::getInstance()->lastInsertId()) !== 0;
    }

    public function createUsername(string $username): bool{
        $request = DB::getInstance()->prepare("
                INSERT INTO clavardage.user (username) 
                    VALUES (:username)
        ");
        $request->bindParam(':username', $username);
        $request->execute();

        setcookie("id", DB::getInstance()->lastInsertId(), time()+3600*24*58000, "/");

        return true;
    }

    public function changeUsername(string $username): bool{
        $ancient = $_COOKIE['id'];
        $request = DB::getInstance()->prepare("
                UPDATE clavardage.user
                SET username = :username
                WHERE id = :ancient
        ");
        $request->bindParam(':username', $username);
        $request->bindParam(':ancient', $ancient);
        $request->execute();

        return true;
    }

}