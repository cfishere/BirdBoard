<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class UserTest extends TestCase
{
	use RefreshDatabase;



    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_user_has_projects()
    {
        // given I have a user:
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
