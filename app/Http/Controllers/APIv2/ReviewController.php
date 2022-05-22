<?php

namespace App\Http\Controllers\APIv2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\EventModel;
use App\Models\EventReviews;
use App\Models\ReviewModel;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ReviewResource::collection(EventReviews::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReviewRequest  $request
     * @return \Illuminate\Http\JsonResponse|ReviewResource
     */
    public function store(ReviewRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json($validated);
        }

        if (EventModel::where('id', $request->event_id)->first() === null){
            return response()->json([
                'state' =>'Error: Incorrect event_id. Event couldn\'t be found.'
            ], 400);
        }

        $item = EventReviews::create([
            'event_id' => $request->event_id,
            'text' => $request->text
        ]);

        return new ReviewResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ReviewResource
     */
    public function show($id)
    {
        $item = EventReviews::where('id', '=', $id)->first();
        if ($item){
            return new ReviewResource($item);
        }
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReviewRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|ReviewResource
     */
    public function update(ReviewRequest $request, $id)
    {
        try {
            $item = EventReviews::where('id', '=', $id)->first();

            if (EventModel::where('id', $request->event_id)->first() === null){
                return response()->json([
                    'state' =>'Error: Incorrect event_id. Event couldn\'t be found.'
                ], 400);
            }

            $item->update([
                'event_id' => $request->event_id,
                'text' => $request->text
            ]);

            return new ReviewResource($item);
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
            $item = EventReviews::where('id', '=', $id)->first();

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
