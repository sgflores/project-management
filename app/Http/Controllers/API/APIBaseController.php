<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\EloquentHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

abstract class APIBaseController extends Controller
{
    use EloquentHelpers;

    public $formRequest;
    public $model;

    public function __construct(FormRequest $formRequest, Model $model)
    {
        $this->formRequest = $formRequest;
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eagerLoaded = $this->model->_eagerLoaded ?? [];
        $results = $this->model->with($eagerLoaded)->get();
        return response($results, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->formRequest->rules(), $this->formRequest->messages());

        return DB::transaction(function($query) use($request) {
            
            $this->model = $this->model->create($request->all());

            $this->insertRelationship($request, $this->model); // traits 
            
            return response($this->model, 201);

        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eagerLoaded = $this->model->_eagerLoaded ?? [];
        $this->model = $this->model::findOrFail($id);
        $this->model = $this->model->load($eagerLoaded);
        return response($this->model, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->model = $this->model::findOrFail($id);

        $request->validate($this->formRequest->rules(), $this->formRequest->messages());

        return DB::transaction(function($query) use($request) {
            
            $this->model->update($request->all());

            return $this->insertRelationship($request, $this->model); // traits 

            return response($this->model, 200);

        });

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);

        return DB::transaction(function($query) use($model) {

            $_attachables = $model->_attachables ?? [];
        
            foreach($_attachables as $attKey => $attach) {

                $relatioship = $attach['relationship'];
                $model->{$relatioship}()->delete();

            }
            
            $model->delete();
            
            return response("Successfully Deleted!", 200);

        });

    }
}