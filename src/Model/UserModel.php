<?php
namespace App\Model;

use App\Database\Manager;

class UserModel
{
    public static function getUser($id)
    {
        $db = Manager::getInstance();

        $sql = "SELECT u FROM User u WHERE u.id = ?1";
        $user = $db->entityManager->createQuery($sql)
                ->setParameter(1, $id)
                ->getSingleResult();

        return $user;
    }
}
