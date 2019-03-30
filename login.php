<?php
use App\Auth\AuthManager;
use App\Template\Renderer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once './bootstrap.php';

$loggedIn = AuthManager::checkSession();
$request = Request::createFromGlobals();
$renderer = Renderer::getInstance();
$loginError = null;

if ($request->isMethod('POST')) {
    $login = $request->request->getAlnum('login', null);
    $password = $request->request->get('password', null);

    $user = AuthManager::checkCredentials($login, $password);

    if (!is_null($user)) {
        AuthManager::writeSession($user->getId(), $user->getLogin());

        $response = new RedirectResponse(URL_PREFIX . '/index.php');

        return $response->send();
    } else {
        $loginError = 'Wrong Login or password';
    }
}

$response = new Response($renderer->render('login.html', [
    'prefix' => URL_PREFIX,
    'error' => $loginError
]));

return $response->send();
