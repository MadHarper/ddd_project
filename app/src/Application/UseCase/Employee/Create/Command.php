<?php declare(strict_types=1);

namespace App\Application\UseCase\Employee\Create;

class Command
{
    public string $firstName;
    public string $lastName;
    public ?string $middleName;
    public string $country;
    public string $city;
    public ?string $region;
    public ?string $street;
    public ?string $apartment;
    public array $phones = [];
}