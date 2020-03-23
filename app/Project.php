<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Traits\RecordsActivity;

    protected $guarded = [];

    //should not be protect or private
    // public $old = [];
    
    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    /**
     * Define Pivot Tbl Relationship betw users + projects
     * default name is 'project_user', but expressly name it project_members
     * @return Illuminate\Support\Collection
     */
    public function members()
    {
        //how to determine if you need to use a pivot table in
        //a db relationship? If yes to both, the you need a pivot:
        //Is it true a project can have many members?
        //AND is it true a user can have many projects?
        
        return $this->belongsToMany(User::class, 'project_members');
    }
}