<?php

namespace App;

use App\Http\Requests\ProjectTaskRequest;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name'];

    public $_eagerLoaded = [
        'tasks',
    ];

    public $_attachables = [
        [
            'relationship' => 'tasks', 
            'validation' => ProjectTaskRequest::class,
            'foreign_id' => 'project_id',
        ],
    ];

    public function tasks()
    {
        return $this->hasMany('App\ProjectTask')
            ->orderBy('priority', 'asc')
            ->orderBy('id', 'asc');
    }

}
