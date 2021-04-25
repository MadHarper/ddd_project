<?php declare(strict_types=1);

namespace App\Domain\Entity\Employee;

class PhonesCollection
{
    /** @var Phone[] */
    private array $phones = [];

    public function add(Phone $phone): void
    {
        $this->phones[] = $phone;
    }

    public function isEmpty(): bool
    {
        return empty($this->phones);
    }

    public function toArray(): array
    {
        return $this->phones;
    }

    public function serialize(): array
    {
        $result = [];
        foreach ($this->phones as $phone) {
            $result[] = $phone->toArray();
        }

        return $result;
    }
}