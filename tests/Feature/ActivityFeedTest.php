<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project_generates_activity(): void
    {
        $project = Project::factory()->create();

        self::assertCount(1, $project->activity);
        self::assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    public function updating_a_project_generates_activity(): void
    {
        $project = Project::factory()->create();

        $project->update(['title' => 'Changed']);

        self::assertCount(2, $project->activity);
        self::assertEquals('updated', $project->activity->last()->description);
    }

}
