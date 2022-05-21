<?php

namespace App\Http\Controllers\API;

use App\Classes\ProductClass;
use App\Classes\UserClass;
use App\Models\OperationModel;
use App\Models\ProductModel;
use App\Models\User;

class ProductController extends BaseController
{
    public function get(int $id){
        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }
        $model = ProductModel::where('products.id', '=', $id)->first();
        if ($model){
            return response()->json(
                new ProductClass($model->toArray())
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
        $arr = ProductModel::all();
        $products = [];
        foreach ($arr as $product){
            $products[] = new ProductClass($product->toArray());
        }
        return response()->json($products);
    }


    public function buy(){
        $sum = request()->sum;
        $seller_id = request()->seller_id;
        $buyer_id = request()->header('id');

        if (!$this->rightId()){
            return response()->json(
                ['status' => "Unauthorized"], 401
            );
        }

        $buyer = UserClass::getById($buyer_id);

        if ($buyer->cash < $sum){
            return response()->json([
                'status' => 'Недостаточно денег!'
            ], 403);
        }
        else{
            User::where('id', '=', $buyer->id)->first()->update([
                'cash' => $buyer->cash - $sum
            ]);

            $operation = new OperationModel([
                'seller_id' => $seller_id,
                'buyer_id' => $buyer_id,
                'sum' => -1 * $sum,
            ]);
            $operation->save();

            return response()->json([
                'status' => 'Оплата прошла успешно!'
            ]);
        }
    }
}
