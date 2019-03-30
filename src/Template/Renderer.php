<?php
namespace App\Template;

class Renderer
{
    private static $instance = null;
    public $entityManager = null;
    private $twig;

    private function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_PATH);
        $this->twig = new \Twig\Environment($loader, [
            'cache' => TEMPLATES_CACHE_PATH,
            'auto_reload' => true
        ]);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Renderer();
        }

        return self::$instance;
    }

    public function render($template, $data)
    {
        return $this->twig->render($template, $data);
    }
}
