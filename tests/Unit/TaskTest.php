<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_project() : void
    {
        $task = Task::factory()->create();

        self::assertInstanceOf(Project::class, $task->project);
    }

    /** @test */
    public function it_has_a_path() : void
    {
        $task = Task::factory()->create();

        self::assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());
    }

    /** @test */
    public function it_can_be_completed() : void
    {
        $task = Task::factory()->create();

        self::assertFalse($task->completed);

        $task->complete();

        self::assertTrue($task->fresh()->completed);
    }


    /** @test */
    public function it_can_be_marked_as_incomplete() : void
    {
        $task = Task::factory()->create(['completed' => true]);

        self::assertTrue($task->completed);

        $task->incomplete();

        self::assertFalse($task->fresh()->completed);
    }

}
