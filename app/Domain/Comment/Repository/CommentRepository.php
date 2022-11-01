<?php

namespace App\Domain\Comment\Repository;

use App\Domain\Comment\Contracts\Commentable;
use App\Domain\Comment\Contracts\CommentRepositoryContract;

class CommentRepository implements CommentRepositoryContract
{

    public function index(Commentable $commentable): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $commentable->comments()->paginate();
    }
}
