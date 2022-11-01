<?php

namespace App\Domain\Comment\Policies;

use App\Domain\Comment\Models\Comment;
use App\Models\User;
use Gate;

class CommentPolicy
{
    public function delete(User $user, Comment $comment): bool
    {
        return Gate::allows('show', [$comment->commentable, $user]);
    }
}
