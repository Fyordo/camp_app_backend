<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildRequest;
use App\Http\Resources\ChildResource;
use App\Models\ChildModel;
use App\Models\ParentModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ChildResource::collection(ChildModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ChildRequest  $request
     * @return \Illuminate\Http\JsonResponse|ChildResource
     */
    public function store(ChildRequest $request)
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

        if (User::where('id', $request->parent_id)->first() === null ||
        ParentModel::where('parents.user_id', $request->parent_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect parent_id. Parent couldn\'t be found.'
            ], 400);
        }

        $item = ChildModel::create([
            'user_id' => $request->user_id,
            'parent_id' => $request->parent_id,
            'points' => $this->points ?? 0,
            'longitude' => $this->longitude ?? 0,
            'latitude' => $this->latitude ?? 0,
        ]);

        return new ChildResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ChildResource
     */
    public function show($id)
    {
        $item = ChildModel::where('id', '=', $id)->first();
        if ($item){
            return new ChildResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ChildRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ChildResource
     */
    public function update(ChildRequest $request, $id)
    {
        try {
            $item = ChildModel::where('id', '=', $id)->first();

            if (User::where('id', $request->user_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect user_id. User couldn\'t be found.'
                ], 400);
            }

            if (User::where('id', $request->parent_id)->first() === null ||
                ParentModel::where('parents.user_id', $request->parent_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect parent_id. Parent couldn\'t be found.'
                ], 400);
            }

            $item->update([
                'user_id' => $request->user_id,
                'parent_id' => $request->parent_id,
                'points' => $this->points ?? 0,
                'longitude' => $this->longitude ?? 0,
                'latitude' => $this->latitude ?? 0,
            ]);

            return new ChildResource($item);
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
            $item = ChildModel::where('children.id', '=', $id)->first();

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
