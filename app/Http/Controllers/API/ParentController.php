<?php

namespace App\Http\Controllers\API;

use App\Classes\ParentClass;
use App\Models\ParentModel;

class ParentController extends BaseController
{
    public function get(int $id){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = ParentModel::where('parents.user_id', '=', $id)->first();
        if ($model){
            return response()->json(
                new ParentClass($model->toArray())
            );
        }
        else{
            return response()->json(
                ['status' => "Item not found"], 404
            );
        }
    }

    public function all(){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $arr = ParentModel::all();
        $children = [];
        foreach ($arr as $child){
            $children[] = new ParentClass($child->toArray());
        }
        return response()->json($children);
    }
}
