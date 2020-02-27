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
      
        request()->validate(['body' => 'required']);
        
        // 'compeleted' represents a checkbox value, which if NOT checked,
        // will not be included in the request data = error thrown;
        // avoid errors with request's has() method.
        $task->update([

            'body' => request()->input( 'body' ),

            'completed' => request()->has( 'completed' )

        ]);

        return redirect( $project->path() );
    }
}
