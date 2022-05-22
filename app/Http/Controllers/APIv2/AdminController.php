<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\AdminModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AdminResource::collection(AdminModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminRequest  $request
     * @return \Illuminate\Http\JsonResponse|AdminResource
     */
    public function store(AdminRequest $request)
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

        $item = AdminModel::create([
            'user_id' => $request->user_id,
        ]);

        return new AdminResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|AdminResource
     */
    public function show($id)
    {
        $item = AdminModel::where('id', '=', $id)->first();
        if ($item){
            return new AdminResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|AdminResource
     */
    public function update(AdminRequest $request, $id)
    {
        try {
            $item = AdminModel::where('id', '=', $id)->first();

            if (User::where('id', $request->user_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect user_id. User couldn\'t be found.'
                ], 400);
            }

            $item->update([
                'user_id' => $request->user_id,
            ]);

            return new AdminResource($item);
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
            $item = AdminModel::where('id', '=', $id)->first();

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
