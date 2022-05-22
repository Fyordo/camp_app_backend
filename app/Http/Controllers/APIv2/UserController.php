<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\AdminModel;
use App\Models\ChildModel;
use App\Models\LeaderModel;
use App\Models\ParentModel;
use App\Models\StaffModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\JsonResponse|UserResource
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        $item = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return new UserResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|UserResource
     */
    public function show($id)
    {
        $item = User::where('users.id', '=', $id)->first();
        if ($item){
            return new UserResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|UserResource
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $item = User::where('id', '=', $id)->first();
            $item->update([
                'name' => $request->name ?? $item->name,
                'email' => $request->email ?? $item->email,
                'phone' => $request->phone ?? $item->phone,
                'password' => Hash::make($request->password) ?? $item->password,
                'cash' => $request->cash ?? $item->cash
            ]);

            return new UserResource($item);
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
            $item = User::where('id', '=', $id)->first();

            ParentModel::where('user_id', $id)->delete();
            AdminModel::where('user_id', $id)->delete();
            StaffModel::where('user_id', $id)->delete();
            LeaderModel::where('user_id', $id)->delete();
            ChildModel::where('user_id', $id)->delete();

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
