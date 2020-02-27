<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function a_project_can_have_tasks()
    {
        //$this->withExceptionHandling();
        $project = ProjectFactory::create();

        // hit the post endpoint, and it should try to add that task to the $project
        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test Task']);


        //Therefore, assert that we should SEE the new task in the view:
        $this->get($project->path())->assertSee('Test Task');
    }

    /**
     * @test
     */
    public function a_task_can_be_updated()
    {
        //$this->withExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();

        //try to update it from the outside (end point), in:       
        $this->actingAs($project->owner)
            ->patch( $project->tasks[0]->path(), 
                [ 
                'body' => 'Changed',
                'completed' => true 
            ]);

            //dd($project);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Changed',
            'completed' => true 
        ]);        
    }

    /**
     * @test
     */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        //$this->withoutExceptionHandling();

        //be an authenticated user.
        $this->signIn(); 
        //create a project that is not associated with a certain user.
        $project = ProjectFactory::withTasks(1)->create();

        // if I try to add a task to that, we should expect an 'unauthorized' 403
        // redirect response.
              
        $this->post($project->path() . '/tasks', ['body' => 'Test Task'])
            ->assertStatus(403); //forbidden.
        // to be entirely sure, there also should be no record added to the DB.
        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
        
    }

    /**
     * @test
     */
    public function only_the_project_owner_may_update_its_tasks()
    {
        //$this->withoutExceptionHandling();

       //be a random authenticated user.
        $this->signIn(); 

        //create a project that is not associated with a certain user.
        $project = ProjectFactory::withTasks(1)->create();

        
        // if I try to add a task to that, we should expect an 'unauthorized' 403
        // redirect response.
              
        $this->patch( $project->tasks[0]->path(), ['body' => 'Task Updated.'])
            ->assertStatus(403); //forbidden.
        // to be entirely sure, there also should be no record added to the DB.
        $this->assertDatabaseMissing('tasks', ['body' => 'Taske Updated']);
        
    }

    /**
     * @test
     * Assert fails to post if task has no body:
     */
    
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');


    }
}
