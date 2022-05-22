<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentRequest;
use App\Http\Resources\ParentResource;
use App\Models\ParentModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ParentResource::collection(ParentModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ParentRequest  $request
     * @return \Illuminate\Http\JsonResponse|ParentResource
     */
    public function store(ParentRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        if (User::where('id', $request->user_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect user_id. User couldn\'t be found.'
            ], 400);
        }

        $item = ParentModel::create([
            'user_id' => $request->user_id,
        ]);

        return new ParentResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ParentResource
     */
    public function show($id)
    {
        $item = ParentModel::where('id', '=', $id)->first();
        if ($item){
            return new ParentResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ParentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ParentResource
     */
    public function update(ParentRequest $request, $id)
    {
        try {
            $item = ParentModel::where('id', '=', $id)->first();

            if (User::where('id', $request->user_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect user_id. User couldn\'t be found.'
                ], 400);
            }

            $item->update([
                'user_id' => $request->user_id,
            ]);

            return new ParentResource($item);
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
            $item = ParentModel::where('id', '=', $id)->first();

            User::where('id', $item->user_id)->first()->delete();

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
