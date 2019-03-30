<?php
use App\Auth\AuthManager;
use App\Database\Manager;
use App\Model\UserModel;
use App\Model\MessageModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once './bootstrap.php';

$loggedIn = AuthManager::checkSession();
$request = Request::createFromGlobals();

if (!$loggedIn) {
    $response = new JsonResponse(
        [
            'error' => 'Not authorized'
        ],
        403
    );

    return $response->send();
} else {
    $content = json_decode($request->getContent());
    $messageText = $content->message;

    $userId = AuthManager::getUserId();
    $user = UserModel::getUser($userId);
    $message = MessageModel::addMessage($messageText, $user);
    // $db = Manager::getInstance();

    // $message = new Message();
    // $message->setUserId($user->getId());
    // $message->setUser($user);
    // $message->setCreatedAt();
    // $message->setMessage($messageText);

    // $db->entityManager->persist($message);
    // $db->entityManager->flush();

    $response = new JsonResponse(
        $message,
        200
    );

    return $response->send();
}
