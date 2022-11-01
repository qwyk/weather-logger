<?php

namespace App\Domain\Comment;

use App\Domain\Comment\Contracts\CommentRepositoryContract;
use App\Domain\Comment\Models\Comment;
use App\Domain\Comment\Policies\CommentPolicy;
use App\Domain\Comment\Repository\CommentRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class CommentServiceProvider extends AuthServiceProvider
{
    public $policies = [
        Comment::class => CommentPolicy::class
    ];

    public function register()
    {
        parent::register();
        $this->app->bind(CommentRepositoryContract::class, CommentRepository::class);
    }
}
