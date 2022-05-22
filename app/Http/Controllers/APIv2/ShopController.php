<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Http\Resources\ShopResource;
use App\Models\ShopModel;
use App\Models\StaffModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ShopResource::collection(ShopModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ShopRequest  $request
     * @return \Illuminate\Http\JsonResponse|ShopResource
     */
    public function store(ShopRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        if (StaffModel::where('user_id', $request->seller_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect seller_id. Seller couldn\'t be found.'
            ], 400);
        }

        $item = ShopModel::create([
            'seller_id' => $request->seller_id,
            'title' => $request->title,
            'category' => $request->category,
        ]);

        return new ShopResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ShopResource
     */
    public function show($id)
    {
        $item = ShopModel::where('id', '=', $id)->first();
        if ($item){
            return new ShopResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ShopRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ShopResource
     */
    public function update(ShopRequest $request, $id)
    {
        try {
            $item = ShopModel::where('id', '=', $id)->first();

            if (StaffModel::where('user_id', $request->seller_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect seller_id. Seller couldn\'t be found.'
                ], 400);
            }

            $item->update([
                'seller_id' => $request->seller_id,
                'title' => $request->title,
                'category' => $request->category,
            ]);

            return new ShopResource($item);
        }
        catch (Error $ex){
            return response()->json([
                'state' =>'Error: Incorrect id'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $item = ShopModel::where('id', '=', $id)->first();

            User::where('id', $item->seller_id)->first()->delete();
            StaffModel::where('user_id', $item->seller_id)->first()->delete();

            $item->delete();

            return response()->json(null, 204);
        }
        catch (Error $ex){
            return response()->json([
                'state' =>'Error: Incorrect id'
            ], 400);
        }
    }
}
