<?php
namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    // provide access to faker methods/attributes.
    // search faker documentation to learn about options.
    // provide RefreshDatabase Trait to mimic a database
    // via memory, so we don't pollute our project database.
    // setup phpunit.xml to use sqlite and DB_DATABASE to 
    // :memory:
    use WithFaker, RefreshDatabase;

/**
 * @test
 */   
   public function guests_cannot_manage_projects()
   {
      $project = factory( 'App\Project' )->create();
      $this->get('/projects')->assertRedirect('login');  
      $this->get('/projects/create')->assertRedirect('login');      
      $this->get($project->path())->assertRedirect('login');
      $this->get($project->path().'/edit')->assertRedirect('login');
      $this->post('/projects', $project->toArray())->assertRedirect('login');
    }
 

/**
 * @test
 */
   public function a_user_can_create_a_project()
   {
        //disable exception handling by laravel 
        //bc we want to see the exception
        $this->withoutExceptionHandling();

        $this->signIn();

        //simply test that a good form submission 
        //asserts a 200 response.
        $this->get('projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General Notes Here.'
        ];

        $response = $this->post( '/projects', $attributes );

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        
        $this->get($project->path())
          ->assertSee($attributes['title'])
          ->assertSee($attributes['description'])
          ->assertSee($attributes['notes']);

   }


  /**
   * @test
   */
  public function a_user_can_update_a_project()
  {
       $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
              ->patch( $project->path(),           
                  $attributes =  [
                      'notes' => 'Changed note',
                      'title' => 'Changed',
                      'description' => 'Changed'
                  ]
              )->assertRedirect($project->path());
        $this->get($project->path().'/edit')->assertOk();

        $this->assertDatabaseHas( 'projects', $attributes );

  }

  /**
   * @test
   */
  public function a_project_owner_can_update_its_general_notes()
  {
      //$this->withoutExceptionHandling();
      $project = ProjectFactory::create();

      $this->actingAs($project->owner)->patch( 
        $project->path(), $attributes = [  'notes' => 'Changed note'  ]
      );

      //$this->get($project->path().'/edit')->assertRedirect('login');
      $this->assertDatabaseHas('projects', $attributes);
    }

  
   
   public function a_project_requires_a_title()
   {

        $this->signIn();
        $attributes = factory('App\Project')->raw(['title'=>'']);

        //assertSessionHasErrors is Laravel Helper on top of phpUnit.
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
   }

   /**
 * @test
 */
   
   public function an_authenticated_user_cannot_view_the_projects_of_others()
   {
      
      $this->signIn();
      // $this->withoutExceptionHandling();
      $project = ProjectFactory::create();
      $this->get($project->path())->assertStatus(403);

   }

  /**
 * @test
 */
   
   public function an_authenticated_user_cannot_update_the_projects_of_others()
   {
      //$this->withoutExceptionHandling();
      $this->signIn();
      // $this->withoutExceptionHandling();
      $project = ProjectFactory::create();

      $this->patch( $project->path())->assertStatus(403);

   }

/**
 * @test
 */   
   public function a_project_requires_a_description()
   {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['description' => '']);
        //assertSessionHasErrors is Laravel Helper on top of phpUnit.
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
   }

   /**
    * @test
    */
   public function a_user_can_view_their_project()
   { 
      //$this->withoutExceptionHandling();
        //sign in a user:
        $this->signIn();
        //disable exception handling by laravel 
        //bc we want to see the test error exact message:
        $project = ProjectFactory::create();
       

        //when we try to view that project:
        $this->actingAs($project->owner)
          ->get($project->path())
          ->assertSee($project->title)
          ->assertSee($project->description);
   }
}
