<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

trait EloquentHelpers {

    public function insertRelationship(Request $request, Model $model)
    {
        $_attachables = $model->_attachables ?? [];
        
        foreach($_attachables as $attKey => $attach) {

            $inputRelationship = $attach['relationship'];
            $foreign_id = $attach['foreign_id'];

            // delete old data
            $model->{$inputRelationship}()->delete();

            if ($request->{$inputRelationship} && is_array($request->{$inputRelationship})) {

                $inputRequest = [];

                foreach($request->{$inputRelationship} as $inputKey => $inputVal ) {

                    $inputVal[$foreign_id] = $model->id;
                    
                    $inputVal['created_at'] = \Carbon\Carbon::now();
                    $inputVal['updated_at'] = \Carbon\Carbon::now();

                    $inputValidation = (App::make($attach['validation']));

                    $newRequest = new Request;
                    $newRequest->replace($inputVal);
                    $newRequest->validate($inputValidation->rules(), $inputValidation->messages());

                    $inputRequest [] = $inputVal;

                }

                // insert new data
                $model->{$inputRelationship}()->insert($inputRequest);

            }

        }
    }

}