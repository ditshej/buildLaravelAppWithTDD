<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Facades\Tests\Setup\ProjectTestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects(): void
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks(): void
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_tasks(): void
    {
        $this->signIn();

        $project = ProjectTestFactory::withTasks(1)->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    /** @test */
    public function a_project_can_have_tasks(): void
    {
        $project = ProjectTestFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated(): void
    {
        $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'changed',
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
        ]);
    }


    /** @test */
    public function a_task_can_be_completed(): void
    {
        $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incomplete(): void
    {
        $this->withoutExceptionHandling();
        $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false
        ]);
    }

    /** @test */
    public function a_task_requires_a_body(): void
    {
        $project = ProjectTestFactory::create();

        $attributes = Task::factory()->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
