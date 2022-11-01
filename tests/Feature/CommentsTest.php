<?php

namespace Tests\Feature;

use App\Domain\Comment\Contracts\Commentable;
use App\Domain\Comment\Models\Comment;
use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;
    private Commentable $commentable;

    /** @test */
    public function itCanDeleteAComment(): void
    {
        /** @var Comment $comment */
        $comment = Comment::factory()->for($this->commentable, 'commentable')->create();

        $this->actingAs($this->user, 'sanctum')
             ->deleteJson(sprintf("/api/comments/%s", $comment->id))
             ->assertNoContent();

        $this->assertModelMissing($comment);
    }

    /** @test */
    public function itDoesNotAllowDeletingACommentOfTheWeatherRequestOfAnotherUser(): void
    {
        /** @var Comment $comment */
        $comment = Comment::factory()->for($this->commentable, 'commentable')->create();

        $unauthorizedUser = User::factory()->create();

        $this->actingAs($unauthorizedUser, 'sanctum')
             ->deleteJson(sprintf("/api/comments/%s", $comment->id))
             ->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user        = User::factory()->create();
        $this->commentable = WeatherRequest::factory()->for($this->user)->create();
    }
}
