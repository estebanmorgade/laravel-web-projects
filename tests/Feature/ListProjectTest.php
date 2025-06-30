<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class ListProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_see_all_projects(): void
    {
        //$this->withoutExceptionHandling();

        //$user = User::factory(3)->create();

        //dd($user->toArray());

        $project = Project::factory()->create();

        $project2 = Project::factory()->create();

        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);

        $response->assertViewIs('projects.index');

        $response->assertViewHas('projects');

        $response->assertSee($project->title);
        $response->assertSee($project2->title);
    }

    public function test_can_see_individual_projects(){

        $project = Project::factory()->create();

        $project2 = Project::factory()->create();

        $responde = $this->get(route('projects.show', $project));

        $responde->assertSee($project->title);
        $responde->assertDontSee($project2->title);
    }
}
