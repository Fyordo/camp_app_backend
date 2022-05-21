<?php

namespace App\Classes;

use App\Models\EventModel;
use App\Models\User;
/**
 * Class EventReview
 *
 * @OA\Schema(
 *      schema="EventReview",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          description="Идентификатор",
 *          type="interger"
 *      ),
 *      @OA\Property(
 *          property="reviewer",
 *          description="Пользователь, оставивший отзыв",
 *          type="object",
 *          ref="#/components/schemas/User"
 *      ),
 *      @OA\Property(
 *          property="event",
 *          description="Мероприятие",
 *          type="object",
 *          ref="#/components/schemas/Event"
 *      ),
 *      @OA\Property(
 *          property="text",
 *          description="Текст отзыва",
 *          type="string"
 *      )
 *  )
 *
 * @package App\Models
 */
class EventReviewClass
{
    public int $id;
    public UserClass $reviewer;
    public EventClass $event;
    public string $text;

    public function __construct(array $arr){
        $this->id = $arr["id"];
        $this->reviewer = new UserClass(User::where('users.id', '=', $arr['reviewer_user_id'])->first()->toArray());
        $this->event = new EventClass(EventModel::where('events.id', '=', $arr['event_id'])->first()->toArray());
        $this->text = $arr["text"];
    }
}
