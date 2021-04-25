<?php declare(strict_types=1);

namespace App\Domain\Entity\Employee;

use DomainException;

class Phone
{
    private string $countryCode;
    private string $cityCode;
    private string $number;

    public function __construct(string $countryCode, string $cityCode, string $number)
    {
        if (empty($countryCode)) {
            throw new DomainException('Country code not passed.');
        }
        if (empty($cityCode)) {
            throw new DomainException('City code not passed.');
        }
        if (empty($number)) {
            throw new DomainException('Phone number not passed.');
        }

        $this->countryCode = $countryCode;
        $this->cityCode = $cityCode;
        $this->number = $number;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCityCode(): string
    {
        return $this->cityCode;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function toArray(): array
    {
        return [
            'countryCode' => $this->countryCode,
            'cityCode' => $this->cityCode,
            'number' => $this->number
        ];
    }
}