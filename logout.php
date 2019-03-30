<?php
use App\Auth\AuthManager;
use App\Template\Renderer;
use Symfony\Component\HttpFoundation\RedirectResponse;

require_once './bootstrap.php';

$renderer = Renderer::getInstance();
AuthManager::clearSession();
$response = new RedirectResponse(URL_PREFIX . '/login.php');

return $response->send();
