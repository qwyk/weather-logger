<?php

namespace App\Domain\Comment\Actions;

use App\Domain\Comment\Contracts\Commentable;
use App\Domain\Comment\DataTransferObjects\CreateCommentData;
use App\Domain\Comment\Models\Comment;

class CreateCommentAction
{
    public function execute(Commentable $commentable, CreateCommentData $data): Comment
    {
        return $commentable->comments()->create($data->toArray());
    }
}
