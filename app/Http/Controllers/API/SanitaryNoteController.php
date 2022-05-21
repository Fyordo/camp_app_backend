<?php

namespace App\Http\Controllers\API;

use App\Classes\SanitaryNoteClass;
use App\Models\SanitaryNoteModel;

class SanitaryNoteController extends BaseController
{
    public function get(int $id){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = SanitaryNoteModel::where('sanitary_notes.id', '=', $id)->first();
        if ($model){
            return response()->json(
                new SanitaryNoteClass($model->toArray())
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
        $arr = SanitaryNoteModel::all();
        $children = [];
        foreach ($arr as $child){
            $children[] = new SanitaryNoteClass($child->toArray());
        }
        return response()->json($children);
    }

    public function add(){
        $medic_user_id = $this->getIdFromHeader();
        $child_user_id = request()->input('child_user_id');
        $description = \request()->input('description');

        $note = new SanitaryNoteModel([
            'medic_user_id' => $medic_user_id,
            'child_user_id' => $child_user_id,
            'description' => $description,
        ]);

        $note->save();

        return response()->json(['status' => 'Запись успешно сохранена!']);
    }
}
