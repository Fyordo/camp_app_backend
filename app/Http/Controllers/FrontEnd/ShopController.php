<?php

namespace App\Http\Controllers\FrontEnd;

use App\Classes\ShopClass;
use App\Classes\UserClass;
use App\Http\Controllers\Controller;
use App\Models\ShopModel;
use App\Models\User;

class ShopController extends Controller
{
    public function index(){
        $shopsDB = ShopModel::all();
        $shops = [];

        foreach ($shopsDB as $shop){
            $shops[] = new ShopClass($shop->toArray());
        }

        return view('shop.index', [
            'shops' => $shops
        ]);
    }

    public function one(int $id){
        $sellers = [];
        foreach (User::all() as $userDB){
            $user = new UserClass($userDB->toArray());
            $seller = $user->staff();

            if ($seller && $seller->role == "Кассир"){
                $sellers[] = $user;
            }
        }
        return view('shop.one', [
            'shop' => new ShopClass(ShopModel::where('id', '=', $id)->first()->toArray()),
            'sellers' => $sellers
        ]);
    }

    public function edit(int $id, array $data){
        ShopModel::where('shops.id', '=', $id)->update([
            'title' => $data['title'],
            'category' => $data['category'],
            'seller_id' => $data['seller_id'] ?? "89613193331"
        ]);
        return redirect('/shop/all');
    }

    public function delete(){

    }
}
