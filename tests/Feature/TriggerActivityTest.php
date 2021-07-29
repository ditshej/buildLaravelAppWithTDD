<?php

namespace Tests\Feature;

use App\Models\Project;
use Facades\Tests\Setup\ProjectTestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project(): void
    {
        $project = Project::factory()->create();

        self::assertCount(1, $project->activity);
        self::assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    public function updating_a_project(): void
    {
        $project = Project::factory()->create();

        $project->update(['title' => 'Changed']);

        self::assertCount(2, $project->activity);
        self::assertEquals('updated', $project->activity->last()->description);
    }

    /** @test */
    public function creating_a_new_task(): void
    {
        $project = Project::factory()->create();

        $project->addTask('Some task');

        self::assertCount(2, $project->activity);
        self::assertEquals('created_task', $project->activity->last()->description);
    }


    /** @test */
    public function completing_a_task(): void
    {
        $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true,
            ]);

        self::assertCount(3, $project->activity);
        self::assertEquals('completed_task', $project->activity->last()->description);
    }

    /** @test */
    public function incompleting_a_task(): void
    {
        $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true,
            ]);

        self::assertCount(3, $project->activity);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false,
        ]);

        $project->refresh();

        self::assertCount(4, $project->activity);
        self::assertEquals('uncompleted_task', $project->activity->last()->description);
    }

    /** @test */
    public function deleting_a_task(): void
    {
        $project = ProjectTestFactory::withTasks(1)->create();

        $project->tasks[0]->delete();

        self::assertCount(3, $project->activity);
    }


}
