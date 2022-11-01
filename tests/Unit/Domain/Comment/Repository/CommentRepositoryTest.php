<?php

namespace Tests\Unit\Domain\Comment\Repository;

use App\Domain\Comment\Actions\CreateCommentAction;
use App\Domain\Comment\Contracts\Commentable;
use App\Domain\Comment\Contracts\CommentRepositoryContract;
use App\Domain\Comment\DataTransferObjects\CreateCommentData;
use App\Domain\Comment\Models\Comment;
use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
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

    /** @test */
    public function itCreatesANewComment(): void
    {
        $fakeComment = Comment::factory()->for($this->commentable, 'commentable')->create()->refresh();

        $this->mock(CreateCommentAction::class, function(MockInterface $mock) use ($fakeComment) {
            $mock->expects('execute')->once()->andReturn($fakeComment);
        });

        /** @var CommentRepositoryContract $repository */
        $repository = app(CommentRepositoryContract::class);
        $result = $repository->create($this->commentable, new CreateCommentData(content: 'fake'));
        $this->assertTrue($fakeComment->is($result));
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->commentable = WeatherRequest::factory()->for(User::factory())->create();
    }


}
