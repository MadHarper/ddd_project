<?php declare(strict_types=1);

namespace App\Application\Query;

use PDO;

class AllEmployeesQuery
{
    private $db;
    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function query(): array
    {
        $stm = $this->db->query('SELECT id, first_name, last_name, middle_name FROM employee');
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}