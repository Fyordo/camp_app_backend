<?php

namespace App\Http\Controllers\API;

use App\Classes\EventClass;
use App\Models\EventModel;

class EventController extends BaseController
{
    public function get(int $id){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = EventModel::where('events.id', '=', $id)->first();
        if ($model){
            return response()->json(
                new EventClass($model->toArray())
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

        $arr = EventModel::all();

        $objects = [];
        foreach ($arr as $object){
            $objects[] = new EventClass($object->toArray());
        }
        return response()->json($objects);
    }
}
