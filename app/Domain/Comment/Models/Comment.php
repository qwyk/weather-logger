<?php

namespace App\Domain\Comment\Models;

use App\Domain\Common\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends UuidModel
{
    use HasFactory;

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
