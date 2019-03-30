<?php
namespace App\Auth;

use App\Database\Manager;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthManager
{
    public static function checkCredentials($login, $password)
    {
        $login = filter_var($login, FILTER_SANITIZE_STRING);

        try {
            $db = Manager::getInstance();
            $dql = "SELECT u FROM User u WHERE u.login = ?1";

            $user = $db->entityManager
                    ->createQuery($dql)
                    ->setParameter(1, $login)
                    ->getSingleResult();

            if (password_verify($password, $user->getPassword())) {
                return $user;
            }

            return null;
        } catch (NoResultException $e) {
            return null;
        }
    }

    public static function checkSession()
    {
        $session = new Session();
        if (is_null($session->get('login'))) {
            return false;
        }

        return true;
    }

    public static function writeSession($id, $login)
    {
        $session = new Session();
        $session->set('id', $id);
        $session->set('login', $login);
    }

    public static function getUserId()
    {
        $session = new Session();

        return $session->get('id', null);
    }

    public static function clearSession()
    {
        $session = new Session();
        $session->clear();
    }
}
