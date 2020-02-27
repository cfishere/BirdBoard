<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];

	// touches references any relationships to this table
	// whenever you update the TASK model.
	// Update the 'updated_at' on projects whenever a task is updated or added.
	protected $touches = ['project'];
    
    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    public function path()
    {
    	return '/projects/'. $this->project->id . '/tasks/'. $this->id;
    }
}
