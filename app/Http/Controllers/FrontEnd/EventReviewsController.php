<?php

namespace App\Http\Controllers\FrontEnd;

use App\Facades\AdminPanel;
use App\Http\Controllers\Controller;
use App\Models\EventModel;
use App\Models\EventReviews;

class EventReviewsController extends Controller
{
    public function index(){
        return view('welcome', [
            'event_rating' => AdminPanel::getEventRating(),
            'child_rating' => AdminPanel::childRatingStats(),
            'staff' => AdminPanel::staff(),
        ]);
    }
}
