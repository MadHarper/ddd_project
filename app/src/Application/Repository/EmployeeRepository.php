<?php declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Entity\Employee\Address;
use App\Domain\Entity\Employee\FullName;
use App\Domain\Entity\Employee\Phone;
use App\Domain\Entity\Employee\PhonesCollection;
use PDO;
use DateTimeImmutable;
use App\Domain\AggregateRoot\DomainEventPublisher;
use App\Domain\Entity\Employee\Employee;
use App\Domain\Entity\Employee\EmployeeId;
use App\Domain\Entity\Employee\Status;
use App\Domain\Repository\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    private $db;
    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function add(Employee $employee): void
    {
        $stm = $this->db->prepare(
            'INSERT INTO employee (last_name, first_name, middle_name, country, city, region, street, apartment, status_name, status_date, created_at, updated_at, phones) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)'
        );

        $stm->execute([
            $employee->getFullName()->getLastName(),
            $employee->getFullName()->getFirstName(),
            $employee->getFullName()->getMiddleName(),
            $employee->getAddress()->getCountry(),
            $employee->getAddress()->getCity(),
            $employee->getAddress()->getRegion(),
            $employee->getAddress()->getStreet(),
            $employee->getAddress()->getApartment(),
            $employee->getStatus()->getStatusName(),
            $employee->getStatus()->getDate() ? $employee->getStatus()->getDate()->format(self::DATE_FORMAT) : null,
            $employee->getCreatedAt()->format(self::DATE_FORMAT),
            $employee->getUpdatedAt()->format(self::DATE_FORMAT),
            json_encode($employee->getPhones()->serialize(), JSON_THROW_ON_ERROR)
        ]);

        DomainEventPublisher::instance()->publishAll($employee->releaseEvents());
    }

    public function findById(EmployeeId $id): ?Employee
    {
        $stm = $this->db->prepare('SELECT * FROM employee WHERE id = ? LIMIT 1');
        $stm->execute([$id->getId()]);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $result = $result[0];
        $employeeId = new EmployeeId($result['id']);
        $name = new FullName($result['first_name'], $result['last_name'], $result['middle_name']);
        $address = new Address($result['country'], $result['city'], $result['region'], $result['street'], $result['apartment']);

        $status = new Status(
            $result['status_name'],
            $this->createDate($result['status_date'])
        );

        return new Employee(
            $employeeId,
            $name,
            $address,
            $this->createPhonesCollection($result['phones']),
            $status,
            $this->createDate($result['created_at']),
            $this->createDate($result['updated_at'])
        );
    }

    public function changeStatus(EmployeeId $id, Status $status): void
    {
        // TODO: Implement changeStatus() method.
    }

    public function update(Employee $employee): void
    {
        $stm = $this->db->prepare(
            'UPDATE employee 
                    SET last_name = ?, 
                        first_name = ?, 
                        middle_name = ?, 
                        country = ?, 
                        city = ?, 
                        region = ?, 
                        street = ?, 
                        apartment = ?, 
                        status_name = ?, 
                        status_date = ?, 
                        created_at = ?, 
                        updated_at = ?, 
                        phones = ?
                    WHERE id = ?');

        $stm->execute([
            $employee->getFullName()->getLastName(),
            $employee->getFullName()->getFirstName(),
            $employee->getFullName()->getMiddleName(),
            $employee->getAddress()->getCountry(),
            $employee->getAddress()->getCity(),
            $employee->getAddress()->getRegion(),
            $employee->getAddress()->getStreet(),
            $employee->getAddress()->getApartment(),
            $employee->getStatus()->getStatusName(),
            $employee->getStatus()->getDate()->format(self::DATE_FORMAT),
            $employee->getCreatedAt()->format(self::DATE_FORMAT),
            $employee->getUpdatedAt()->format(self::DATE_FORMAT),
            json_encode($employee->getPhones()->serialize(), JSON_THROW_ON_ERROR),
            $employee->getId()->getId()
        ]);

        DomainEventPublisher::instance()->publishAll($employee->releaseEvents());
    }

    private function createDate(string $date): ?DateTimeImmutable
    {
        return is_string($date)
            ? DateTimeImmutable::createFromFormat(self::DATE_FORMAT, $date)
            : null;
    }

    private function createPhonesCollection(string $json): PhonesCollection
    {
        $collection = new PhonesCollection();
        $array = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        foreach ($array as $elem) {
            $phone = new Phone(
                $elem['countryCode'],
                $elem['cityCode'],
                $elem['number']
            );

            $collection->add($phone);
        }

        return $collection;
    }
}