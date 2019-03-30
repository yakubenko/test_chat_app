<?php
namespace App\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Manager
{
    private static $instance = null;
    public $entityManager = null;

    private function __construct()
    {
        $config = Setup::createAnnotationMetadataConfiguration([ENTITY_PATH], true);

        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => DB_PATH
        ];

        $this->entityManager = EntityManager::create($conn, $config);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Manager();
        }

        return self::$instance;
    }
}
