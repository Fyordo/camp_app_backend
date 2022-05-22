<?php

namespace App\Http\Controllers\API;

use App\Classes\OperationClass;
use App\Classes\UserClass;
use App\Models\ChildModel;
use App\Models\OperationModel;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class OperationController extends BaseController
{
    public function get(int $id){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = OperationModel::where('operations.id', '=', $id)->first();
        if ($model){
            return response()->json(
                new OperationClass($model->toArray())
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

        $user_id = request()->user_id;
        $parent_id = request()->parent_id;

        if ($user_id){
            $arr = OperationModel::all()->where('buyer_id', '=', $user_id);
        }
        else if ($parent_id){
            $arr = OperationModel::all()->whereIn('buyer_id',  $this->getChildrenIds($parent_id));
        }
        else{
            $arr = OperationModel::all();
        }

        $objects = [];
        foreach ($arr as $object){
            $objects[] = new OperationClass($object->toArray());
        }

        $graph = [];
        $start_date = mktime(0, 0, 0, 5, 1, 2022);
        $end_date = (new DateTime())->getTimestamp();

        for ($i = $start_date; $i < $end_date; $i += 60*60*24){
            $graph[] = [
                'date' => strtotime(date('d.m.Y', $i)),
                'expense' => 0
            ];
        }

        $user = null;

        if ($user_id){
            $collection = OperationModel::where('operations.buyer_id', '=', $user_id)->get();
            $user = new UserClass(User::where('id', $user_id)->first()->toArray());
        }
        else if ($parent_id){
            $collection = OperationModel::whereIn('buyer_id',  $this->getChildrenIds($parent_id))->get();
            $user = new UserClass(User::where('id', $parent_id)->first()->toArray());
        }



        foreach ($collection as $operation){

            $time = strtotime($operation['created_at']) - (strtotime($operation['created_at']) % (60*60*24));
            //dd($operation, $time);
            $this->addExpense($graph, $operation, $time);
        }

        return response()->json([
            'operations' => $objects,
            'user' => $user,
            'expenses' => $graph
        ]);
    }

    private function addExpense(&$graph, $operation, $time){
        for ($i = 0; $i < count($graph); $i++){
            if ($graph[$i]['date'] == $time){
                $graph[$i]['expense']+= $operation->sum * -1;
            }
        }
    }

    private function getChildrenIds(int $parent_id): array
    {
        return array_column(ChildModel::where('parent_id', $parent_id)->select('user_id')->get()->toArray(), 'user_id');
    }

    public function day(Request $request){
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;

        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date2 = mktime(0, 0, 0, $month, $day+1, $year);

        $arr = OperationModel::all();

        $objects = [];
        foreach ($arr as $object){
            $class = new OperationClass($object->toArray());

            if ($class->created_at >= $date1 && $class->created_at <= $date2){
                $objects[] = $class;
            }

        }
        return response()->json($objects);
    }
}
