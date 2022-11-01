<?php

namespace App\Domain\Comment\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommentRepositoryContract
{
    public function index(Commentable $commentable): LengthAwarePaginator;
}
