<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanitaryRequest;
use App\Http\Resources\SanitaryResource;
use App\Models\ChildModel;
use App\Models\SanitaryNoteModel;
use App\Models\StaffModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class SanitaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return SanitaryResource::collection(SanitaryNoteModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SanitaryRequest  $request
     * @return \Illuminate\Http\JsonResponse|SanitaryResource
     */
    public function store(SanitaryRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        if (ChildModel::where('user_id', $request->child_user_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect child_user_id. Child couldn\'t be found.'
            ], 400);
        }

        if (StaffModel::where('user_id', $request->medic_user_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect medic_user_id. Medic couldn\'t be found.'
            ], 400);
        }

        $item = SanitaryNoteModel::create([
            'child_user_id' => $request->child_user_id,
            'medic_user_id' => $request->medic_user_id,
            'description' => $request->description
        ]);

        return new SanitaryResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|SanitaryResource
     */
    public function show($id)
    {
        $item = SanitaryNoteModel::where('id', '=', $id)->first();
        if ($item){
            return new SanitaryResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SanitaryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|SanitaryResource
     */
    public function update(SanitaryRequest $request, $id)
    {
        try {
            $item = SanitaryNoteModel::where('id', '=', $id)->first();

            if (ChildModel::where('user_id', $request->child_user_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect child_user_id. Child couldn\'t be found.'
                ], 400);
            }

            if (StaffModel::where('user_id', $request->medic_user_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect medic_user_id. Medic couldn\'t be found.'
                ], 400);
            }

            $item->update([
                'child_user_id' => $request->child_user_id,
                'medic_user_id' => $request->medic_user_id,
                'description' => $request->description
            ]);

            return new SanitaryResource($item);
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
            $item = SanitaryNoteModel::where('id', '=', $id)->first();

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
