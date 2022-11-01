<?php

namespace App\Domain\Comment\Models;

use App\Domain\Common\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends UuidModel
{
    use HasFactory;

    protected $guarded = false;

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
