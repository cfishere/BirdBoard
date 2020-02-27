<?php
namespace Tests\Unit;

use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
Use Illuminate\Foundation\Testing\WithFaker;


class TaskTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	

	/**
     * @test void
     */
    public function it_belongs_to_a_project()
    {
    	//$this->WithoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();
        $task = $project->tasks->first();
        $this->assertInstanceOf(Project::class, $task->project);
    }

    /**
     * @test void
     */
    public function it_has_a_path()
    {
        $task = factory('App\Task')->create();

        $this->assertEquals('/projects/'. $task->project->id . 
    		'/tasks/' . $task->id, $task->path());
    }
}
