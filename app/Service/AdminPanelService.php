<?php

namespace App\Service;

use App\Http\Resources\ChildResource;
use App\Http\Resources\LeaderResource;
use App\Http\Resources\ParentResource;
use App\Http\Resources\StaffResource;
use App\Models\ChildModel;
use App\Models\EventModel;
use App\Models\EventReviews;
use App\Models\LeaderModel;
use App\Models\ParentModel;
use App\Models\StaffModel;

class AdminPanelService
{
    public function getEventRating(): array
    {
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

            $line['score'] = $reviews->count() == 0 ? 0 : $sum / $reviews->count();
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

        return $lines;
    }

    public function childRatingStats(): array{
        $children = ChildResource::collection(ChildModel::all()->sortDesc())->toArray(request());

        usort($children, function($a, $b){
            return $a["points"] < $b["points"];
        });
        return $children;
    }

    public function staff(): array{
        $staff = StaffResource::collection(StaffModel::all())->toArray(request());
        usort($staff, function($a, $b){
            return $a["role"] < $b["role"];
        });
        return [
            'staff' => $staff,
            'leaders' => LeaderResource::collection(LeaderModel::all())->toArray(request()),
        ];
    }
}
