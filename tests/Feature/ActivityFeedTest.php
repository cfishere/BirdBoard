<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function creating_a_project_generates_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
    }

}
