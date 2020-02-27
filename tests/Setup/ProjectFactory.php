<?php

namespace Tests\Setup;

use App\Task;
use App\Project;
use App\User;


Class ProjectFactory
{
	protected $tasksCount = 0;

	protected $user;
	

	public function withTasks( $tasksCount = 1 )
	{
		$this->tasksCount = $tasksCount;
		return $this;
	}

	public function ownedBy($user)
	{
		$this->user = $user;
		return $this;
	}

	public function create()
	{
		$project = factory(Project::class)->create([			
			'owner_id' => $this->user ?? factory(User::class)
		]);

		factory( Task::class, $this->tasksCount )->create([
			'project_id' => $project->id
		]);

		return $project;
	}

}