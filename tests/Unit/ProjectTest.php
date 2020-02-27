<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
	 use WithFaker, RefreshDatabase;
    /**
     * @test
     * A basic unit test example.
     *
     * @return void
     */
    public function it_has_a_path()
    {
        $project = factory('App\Project')->create();

        //interact with the Model, call path() method:
        $this->assertEquals('/projects/'. $project->id, $project->path());

    }

    /**
     * @test
     */
    public function it_belongs_to_an_owner()
    {
        $project = factory('App\Project')->create(); 
        //using the Project model method 'user'
        //fetch the owner of the project:
        $project = $this->assertInstanceOf('\App\User', $project->owner());
       
    }

    /**
     * @test
     */
    public function it_can_add_a_task()
    {
        $project = factory('App\Project')->create();
        //dd($project);

        //if I have a project, I want to call this method, addTask:
        //And if I send data to the body, how can I be sure it is handling it?
        //we can try to count that there is at least 1...
        $task = $project->addTask('Task Test');

        //well, ensure there is at least 1:
        $this->assertCount(1, $project->tasks);

        $this->assertTrue($project->tasks->contains($task));
    }
}
