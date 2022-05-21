<?php

namespace App\Http\Controllers\API;

use App\Classes\ChildClass;
use App\Classes\UserClass;
use App\Models\ChildModel;
use App\Models\User;

class ChildController extends BaseController
{
    public function get(int $id)
    {
        if (!$this->rightId()) {
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = ChildModel::where('children.user_id', '=', $id)->first();
        if ($model) {
            return response()->json(
                new ChildClass($model->toArray())
            );
        } else {
            return response()->json(
                ['status' => "Item not found"], 404
            );
        }
    }

    public function all()
    {
        if (!$this->rightId()) {
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }

        $arr = ChildModel::all();
        $children = [];
        foreach ($arr as $child) {
            $children[] = new ChildClass($child->toArray());
        }
        return response()->json($children);
    }

    public function list(){
        $parent_id = request()->parent_id;
        $children = ChildModel::where('parent_id', '=', $parent_id)->get();

        $result = [];
        foreach ($children as $child){
            $result[] = new UserClass(User::where('users.id', '=', $child->user_id)->first()->toArray());
        }

        return response()->json($result);
    }

    public function updateCoordinates()
    {
        $longitude = \request()->longitude;
        $latitude = \request()->latitude;

        $child = ChildModel::where('user_id', '=', \request()->header('id'))->first();
        $child->update([
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);

        $nearby = [];

        foreach (ChildModel::all() as $child){
            if ($child->user_id != \request()->header('id')){
                $dist = $this->getDistance($child->longitude, $child->latitude, $longitude, $latitude);
                if ($dist < 10){
                    $nearby[] = new ChildClass($child->toArray());
                }
            }
        }

        return response()->json([
            'children' => $nearby,
            'status' => count($nearby) == 0 ? 'Нет никого рядом' : 'Рядом обнаружены дети'
        ]);
    }

    private function getDistance($a1, $b1, $a2, $b2)
    {
        $EARTH_RADIUS = 6372795;

        // перевести координаты в радианы
        $lat1 = $a1 * M_PI / 180;
        $lat2 = $a2 * M_PI / 180;
        $long1 = $b1 * M_PI / 180;
        $long2 = $b2 * M_PI / 180;

        // косинусы и синусы широт и разницы долгот
        $cl1 = cos($lat1);
        $cl2 = cos($lat2);
        $sl1 = sin($lat1);
        $sl2 = sin($lat2);
        $delta = $long2 - $long1;
        $cdelta = cos($delta);
        $sdelta = sin($delta);

        // вычисления длины большого круга
        $y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
        $x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;

        $ad = atan2($y, $x);
        $dist = $ad * $EARTH_RADIUS;

        return $dist;
    }
}
