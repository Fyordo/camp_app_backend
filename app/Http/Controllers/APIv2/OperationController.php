<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationRequest;
use App\Http\Resources\OperationResource;
use App\Models\OperationModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OperationResource::collection(OperationModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OperationRequest  $request
     * @return \Illuminate\Http\JsonResponse|OperationResource
     */
    public function store(OperationRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        if (User::where('id', $request->seller_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect seller_id. Seller couldn\'t be found.'
            ], 400);
        }

        if (User::where('id', $request->buyer_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect buyer_id. Buyer couldn\'t be found.'
            ], 400);
        }

        $item = OperationModel::create([
            'seller_id' => $request->seller_id,
            'buyer_id' => $request->buyer_id,
            'sum' => $request->sum,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);

        return new OperationResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|OperationResource
     */
    public function show($id)
    {
        $item = OperationModel::where('id', '=', $id)->first();
        if ($item){
            return new OperationResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OperationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|OperationResource
     */
    public function update(OperationRequest $request, $id)
    {
        try {
            $item = OperationModel::where('id', '=', $id)->first();

            if (User::where('id', $request->seller_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect seller_id. Seller couldn\'t be found.'
                ], 400);
            }

            if (User::where('id', $request->buyer_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect buyer_id. Buyer couldn\'t be found.'
                ], 400);
            }

            $item->update([
                'seller_id' => $request->seller_id,
                'buyer_id' => $request->buyer_id,
                'sum' => $request->sum,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at,
            ]);

            return new OperationResource($item);
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
            $item = OperationModel::where('id', '=', $id)->first();

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
