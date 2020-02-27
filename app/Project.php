<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function path()
    {
    	return "/projects/{$this->id}";
    }

    //the relationship to the User, 'owner_id' in projects table.
    public function owner()
    {
    	return $this->belongsTo('App\User', 'owner_id');
    }

    //the relationship to the tasks, 'project_id' in tasks table
    public function tasks()
    {
    	return $this->hasMany('App\Task');
    }

    public function addTask($body)
    {
    	return $this->tasks()->create(compact('body'));
    }

    public function activity()
    {
        return $this->hasMany('App\Activity');
    }

    
}
