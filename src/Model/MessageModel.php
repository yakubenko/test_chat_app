<?php
namespace App\Model;

use App\Database\Manager;
use Message;

class MessageModel
{
    public static function getLatestMessages($lastId = null)
    {
        $db = Manager::getInstance();

        $lastId = (!is_null($lastId)) ? filter_var((int)$lastId, FILTER_SANITIZE_NUMBER_INT) : 0;

        $sql = "SELECT m, u FROM Message m LEFT JOIN m.user u WHERE m.id > ?1 ORDER BY m.id DESC";

        $messages = $db->entityManager->createQuery($sql)
            ->setParameter(1, $lastId)
            ->setMaxResults(15)
            ->getResult();

        return $messages;
    }

    public static function addMessage($messageText, $user)
    {
        $db = Manager::getInstance();

        $message = new Message();
        $message->setUserId($user->getId());
        $message->setUser($user);
        $message->setCreatedAt();
        $message->setMessage($messageText);

        $db->entityManager->persist($message);
        $db->entityManager->flush();

        return $message;
    }
}
