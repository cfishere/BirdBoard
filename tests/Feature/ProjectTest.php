<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    /* @test */
   public function a_user_can_create_a_project()
   {
        $this->post('/projects');
   }
}
