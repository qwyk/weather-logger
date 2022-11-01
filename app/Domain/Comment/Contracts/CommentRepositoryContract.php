<?php

namespace App\Domain\Comment\Contracts;

use App\Domain\Comment\DataTransferObjects\CreateCommentData;
use App\Domain\Comment\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommentRepositoryContract
{
    public function index(Commentable $commentable): LengthAwarePaginator;

    public function create(Commentable $commentable, CreateCommentData $data): Comment;
}
