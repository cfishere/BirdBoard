<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class ProjectTasksController extends Controller
{
    
    public function store(Project $project, Request $request)
    {        
    	$this->authorize('update', $project);

    	request()->validate(['body' => 'required']);

    	$project->addTask(request()->input('body'));

    	return redirect($project->path());
    }

    //patch to db.tasks the body field of a task for the given project.
    public function update(Project $project, Task $task)
    {        
        $this->authorize('update', $task->project);
      
        $task->update( request()->validate(['body' => 'required']) );

        request('completed') ? $task->complete : $task->incomplete;        

        return redirect( $project->path() );
    }
}
