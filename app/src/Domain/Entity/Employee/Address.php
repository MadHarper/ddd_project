<?php declare(strict_types=1);

namespace App\Domain\Entity\Employee;

class Address
{
    private string $country;
    private string $city;
    private ?string $region;
    private ?string $street;
    private ?string $apartment;

    public function __construct(
        string $country,
        string $city,
        ?string $region = null,
        ?string $street = null,
        ?string $apartment = null)
    {
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->apartment = $apartment;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }


    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getApartment(): ?string
    {
        return $this->apartment;
    }
}