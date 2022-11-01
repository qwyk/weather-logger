<?php

namespace App\Http\Controllers;

use App\Domain\Comment\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;

class CommentController
{
    use AuthorizesRequests;

    public function delete(Comment $comment): Response
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->noContent();
    }
}
