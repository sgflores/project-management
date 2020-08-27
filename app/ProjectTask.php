<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    protected $table = 'project_tasks';

    protected $fillable = ['project_id', 'name', 'priority'];

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::create($value)->toFormattedDateString();
    }

}
