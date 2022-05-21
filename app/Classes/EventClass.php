<?php

namespace App\Classes;

/**
 * Class Event
 *
 * @OA\Schema(
 *      schema="Event",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          description="Идентификатор",
 *          type="interger"
 *      ),
 *      @OA\Property(
 *          property="title",
 *          description="Название",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description",
 *          description="Описание события",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="beginning",
 *          description="Время начала UNIX",
 *          type="integer"
 *      ),
 *      @OA\Property(
 *          property="ending",
 *          description="Время конца UNIX",
 *          type="integer"
 *      )
 *  )
 *
 * @package App\Models
 */
class EventClass
{
    public string $title;
    public string $description;
    public int $beginning;
    public int $ending;

    public function __construct(array $arr){
        $this->title = $arr['title'];
        $this->description = $arr['description'];
        $this->beginning = strtotime($arr['beginning']);
        $this->ending = strtotime($arr['ending']);
    }
}
