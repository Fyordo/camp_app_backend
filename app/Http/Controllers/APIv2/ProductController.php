<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\ProductModel;
use Error;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProductResource::collection(ProductModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\JsonResponse|ProductResource
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        $item = ProductModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return new ProductResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ProductResource
     */
    public function show($id)
    {
        $item = ProductModel::where('id', '=', $id)->first();
        if ($item){
            return new ProductResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ProductResource
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $item = ProductModel::where('id', '=', $id)->first();

            $item->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            return new ProductResource($item);
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
            $item = ProductModel::where('id', '=', $id)->first();

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
