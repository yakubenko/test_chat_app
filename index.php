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

if (!$loggedIn) {
    $response = new RedirectResponse(URL_PREFIX . '/login.php');
    $response->send();
} else {
    $response = new Response($renderer->render('index.html', [
        'prefix' => URL_PREFIX,
    ]));
    $response->send();
}
