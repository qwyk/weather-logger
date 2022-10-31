<?php

namespace App\Domain\Common;

use Illuminate\Support\Str;

trait CreatesWithUuid
{
    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn(self $model) => $model->onCreating());
    }

    protected function onCreating(): void
    {
        if (null === $this->getAttribute($this->getKeyName())) {
            $this->setAttribute($this->getKeyName(), (string) Str::orderedUuid());
        }
    }
}
