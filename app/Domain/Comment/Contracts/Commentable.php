<?php

namespace App\Domain\Comment\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Commentable
{
    public function comments(): MorphMany;
}
