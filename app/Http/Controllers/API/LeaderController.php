<?php

namespace App\Http\Controllers\API;

use App\Classes\LeaderClass;
use App\Models\LeaderModel;

class LeaderController extends BaseController
{
    public function get(int $id){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = LeaderModel::where('leaders.user_id', '=', $id)->first();
        if ($model){
            return response()->json(
                new LeaderClass($model->toArray())
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
        $arr = LeaderModel::all();
        $children = [];
        foreach ($arr as $child){
            $children[] = new LeaderClass($child->toArray());
        }
        return response()->json($children);
    }
}
