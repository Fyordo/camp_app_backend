<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\EventModel;
use App\Models\EventReviews;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return EventResource::collection(EventModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventRequest  $request
     * @return \Illuminate\Http\JsonResponse|EventResource
     */
    public function store(EventRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        $item = EventModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'beginning' => $request->beginning,
            'ending' => $request->ending,
        ]);

        return new EventResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|EventResource
     */
    public function show($id)
    {
        $item = EventModel::where('id', '=', $id)->first();
        if ($item){
            return new EventResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|EventResource
     */
    public function update(EventRequest $request, $id)
    {
        try {
            $item = EventModel::where('id', '=', $id)->first();

            $item->update([
                'title' => $request->title,
                'description' => $request->description,
                'beginning' => $request->beginning,
                'ending' => $request->ending,
            ]);

            return new EventResource($item);
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
            $item = EventModel::where('id', '=', $id)->first();

            EventReviews::where('event_id', $item->id)->delete();

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
