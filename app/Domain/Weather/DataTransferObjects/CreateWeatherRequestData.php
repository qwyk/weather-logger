<?php

namespace App\Domain\Weather\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CreateWeatherRequestData extends DataTransferObject
{
    public string $location;
}
