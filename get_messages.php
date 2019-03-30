<?php
use App\Auth\AuthManager;
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
    $lastId = $request->query->get('last_id', null);
    $messages = MessageModel::getLatestMessages($lastId);

    $response = new JsonResponse(
        $messages,
        200
    );

    return $response->send();
}
