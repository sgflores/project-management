<?php

namespace App\Http\Controllers\API;

use App\Project;
use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\API\APIBaseController;

class ProjectController extends APIBaseController
{
    public function __construct()
    {
        parent::__construct(new ProjectRequest, new Project);
    }

}
