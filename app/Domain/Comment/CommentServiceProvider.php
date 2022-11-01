<?php

namespace App\Domain\Comment;

use App\Domain\Comment\Contracts\CommentRepositoryContract;
use App\Domain\Comment\Repository\CommentRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class CommentServiceProvider extends AuthServiceProvider
{
    public $policies = [
    ];

    public function register()
    {
        parent::register();
        $this->app->bind(CommentRepositoryContract::class, CommentRepository::class);
    }
}
