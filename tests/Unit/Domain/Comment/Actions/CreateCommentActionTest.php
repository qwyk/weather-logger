<?php

namespace Tests\Unit\Domain\Comment\Actions;

use App\Domain\Comment\Actions\CreateCommentAction;
use App\Domain\Comment\Contracts\Commentable;
use App\Domain\Comment\DataTransferObjects\CreateCommentData;
use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommentActionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Commentable $commentable;

    /** @test */
    public function itCreatesANewCommentLinkedToTheCommentable(): void
    {
        /** @var CreateCommentAction $action */
        $action  = app(CreateCommentAction::class);
        $data    = new CreateCommentData(content: $this->faker->text(400));
        $comment = $action->execute($this->commentable, $data);

        $this->assertEquals($data->content, $comment->content);
        $this->assertTrue($comment->commentable->is($this->commentable));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->commentable = WeatherRequest::factory()->for(User::factory())->create();
    }


}
