<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\EventModel;
use App\Models\EventReviews;

class EventReviewsController extends Controller
{
    public function index(){
        $events = EventModel::all();
        $lines = [];
        foreach ($events as $event){
            $line = [];
            $line['event'] = $event->title;
            $line['description'] = $event->description;
            $line['beginning'] = $event->beginning;
            $line['ending'] = $event->ending;

            $reviews = EventReviews::where('event_id', '=', $event->id)->get();
            $count_emoji = [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0
            ];
            $sum = 0;
            foreach ($reviews as $review) {
                switch ($review->text){
                    case '1':
                        $sum += 1;
                        break;
                    case '2':
                        $sum += 2;
                        break;
                    case '3':
                        $sum += 3;
                        break;
                    case '4':
                        $sum += 4;
                        break;
                    case '5':
                        $sum += 5;
                        break;
                    default:
                        $sum += 0;
                        break;
                }
                $count_emoji[$review->text] += 1;
            }

            $line['score'] = $sum / $reviews->count();
            $rates = "";

            foreach ($count_emoji as $key => $value){
                $rates .= $key . '(' . $value . ') ';
            }

            $line["rates"] = $rates;

            $lines[] = $line;
        }

        usort($lines, function ($a, $b) {
            return $a['score'] < $b['score'];
        });

        return view('welcome', [
            'lines' => $lines
        ]);
    }
}
