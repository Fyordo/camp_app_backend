<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

/**
 * @OA\Info(
 *     title="Camp App Hackathon API",
 *     version="1.0",
 *     contact = @OA\Contact(url = "https://camp-app-hackathon.herokuapp.com/")
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API документация"
 * )
 *
 * @OA\PathItem(
 * path="/api"
 * )
 */

abstract class BaseController extends Controller
{
    public function get(int $id){
        return response()->json(['status' => 'error'], 500);
    }

    public function all(){
        return response()->json(['status' => 'error'], 500);
    }

    protected function rightId(){
        // Проверка на id
        if (
            request()->header('id') === null ||
            !User::where('id', request()->header('id'))->exists()
        ){
            return false;
        }
        return true;
    }

    protected function getIdFromHeader(){
        return \request()->header('id', null);
    }
}
