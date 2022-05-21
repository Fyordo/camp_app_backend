<?php

namespace App\Http\Controllers\API;

use App\Classes\StaffClass;
use App\Models\StaffModel;

class StaffController extends BaseController
{
    public function get(int $id){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = StaffModel::where('staff.user_id', '=', $id)->first();
        if ($model){
            return response()->json(
                new StaffClass($model->toArray())
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
        $arr = StaffModel::all();
        $children = [];
        foreach ($arr as $child){
            $children[] = new StaffClass($child->toArray());
        }
        return response()->json($children);
    }
}
