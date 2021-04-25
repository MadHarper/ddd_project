<?php declare(strict_types=1);

namespace App\Application\UseCase\Employee\Create;

use App\Domain\Entity\Employee\Address;
use App\Domain\Entity\Employee\Employee;
use App\Domain\Entity\Employee\EmployeeId;
use App\Domain\Entity\Employee\FullName;
use App\Domain\Entity\Employee\Phone;
use App\Domain\Entity\Employee\PhonesCollection;
use App\Domain\Repository\EmployeeRepositoryInterface;
use InvalidArgumentException;

class Handler
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function handle(Command $command): void
    {
        $phonesCollection = $this->createPhones($command->phones);

        $employee = new Employee(
            new EmployeeId(),
            new FullName($command->firstName, $command->lastName, $command->middleName),
            new Address($command->country, $command->city, $command->region, $command->street, $command->apartment),
            $phonesCollection
        );

        $this->employeeRepository->add($employee);
    }

    private function createPhones(array $phones): PhonesCollection
    {
        if (!$phones) {
            throw new InvalidArgumentException('Phones is empty.');
        }

        $collection = new PhonesCollection();

        foreach ($phones as $elem) {
            $collection->add($this->createPhone($elem));
        }

        return $collection;
    }

    private function createPhone(array $phone): Phone
    {
        if (!array_key_exists('countryCode', $phone)
            || !array_key_exists('cityCode', $phone)
            || !array_key_exists('number', $phone)
        ) {
            throw new InvalidArgumentException('Incorrect phone.');
        }

        return new Phone(
            trim($phone['countryCode']),
            trim($phone['cityCode']),
            trim($phone['number'])
        );
    }
}