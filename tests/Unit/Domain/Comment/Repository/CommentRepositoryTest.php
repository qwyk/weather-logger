<?php

namespace Tests\Unit\Domain\Comment\Repository;

use App\Domain\Comment\Contracts\Commentable;
use App\Domain\Comment\Contracts\CommentRepositoryContract;
use App\Domain\Comment\Models\Comment;
use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Commentable $commentable;

    /** @test */
    public function itInstantiatesFromTheContract(): void
    {
        $concrete = app(CommentRepositoryContract::class);
        $this->assertInstanceOf(CommentRepositoryContract::class, $concrete);
        $this->assertInstanceOf(CommentRepository::class, $concrete);
    }

    /** @test */
    public function itGetsTheIndexOfACommentable(): void
    {
        $count = 100;
        Comment::factory()->for($this->commentable, 'commentable')->count($count)->create();

        /** @var CommentRepositoryContract $repository */
        $repository = app(CommentRepositoryContract::class);
        $result     = $repository->index($this->commentable);
        $this->assertEquals($count, $result->total());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->commentable = WeatherRequest::factory()->for(User::factory())->create();
    }


}
