<?php declare(strict_types=1);

namespace App\Application\DB;

use PDO;

class Database
{
    protected static $instance = null;

    private function __construct(){}
    public function __clone() {}

    public static function instance(): PDO
    {
        if (!self::$instance) {
            // Todo: вынести в настройки
            $dsn = "pgsql:host=db;port=5432;dbname=ddd_project;";

            self::$instance = new PDO(
                $dsn,
                'ddd_project',
                'ddd_project',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }

        return self::$instance;
    }
}