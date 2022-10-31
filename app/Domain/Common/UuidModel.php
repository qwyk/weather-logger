<?php

namespace App\Domain\Common;

use Illuminate\Database\Eloquent\Model;

abstract class UuidModel extends Model
{
    use CreatesWithUuid;

    public $keyType = 'string';

    public $incrementing = false;
}
