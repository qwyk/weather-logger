<?php

namespace App\Domain\Comment\Repository;

use App\Domain\Comment\Actions\CreateCommentAction;
use App\Domain\Comment\Contracts\Commentable;
use App\Domain\Comment\Contracts\CommentRepositoryContract;
use App\Domain\Comment\DataTransferObjects\CreateCommentData;
use App\Domain\Comment\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryContract
{
    public function index(Commentable $commentable): LengthAwarePaginator
    {
        return $commentable->comments()->paginate();
    }

    public function create(Commentable $commentable, CreateCommentData $data): Comment
    {
        return app(CreateCommentAction::class)->execute($commentable, $data);
    }
}
