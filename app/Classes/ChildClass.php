<?php

namespace App\Classes;

use App\Models\ParentModel;
use App\Models\SanitaryNoteModel;
use App\Models\User;
/**
 * Class Child
 *
 * @OA\Schema(
 *      schema="Child",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          description="Идентификатор",
 *          type="interger"
 *      ),
 *      @OA\Property(
 *          property="user",
 *          description="Пользователь",
 *          type="object",
 *          ref="#/components/schemas/User"
 *      ),
 *      @OA\Property(
 *          property="parent",
 *          description="Родитель",
 *          type="object",
 *          ref="#/components/schemas/User"
 *      ),
 *      @OA\Property(
 *          property="points",
 *          description="Баллы за смену",
 *          type="integer"
 *      ),
 *      @OA\Property(
 *          property="longitude",
 *          description="Долгота",
 *          type="float"
 *      ),
 *      @OA\Property(
 *          property="latitude",
 *          description="Широта",
 *          type="float"
 *      )
 *  )
 *
 * @package App\Models
 */
class ChildClass
{
    //public int $id;
    public UserClass $parent;
    public UserClass $user;
    public int $points;
    public array $notes;
    public float $longitude;
    public float $latitude;
    public int $updated_at;

    public function __construct(array $arr, bool $append_notes = true){
        //$this->id = $arr['id'];
        $this->parent = new UserClass(
            User::where('id', '=', $arr['parent_id'])->first()->toArray()
        );
        $this->user = new UserClass(
            User::where('id', '=', $arr['user_id'])->first()->toArray()
        );
        $this->points = $arr['points'];
        $this->longitude = $arr['longitude'];
        $this->latitude = $arr['latitude'];
        $this->notes = [];
        $this->updated_at = strtotime($arr['updated_at']);
        if ($append_notes){
            $notesDB = SanitaryNoteModel::where('child_user_id', $this->user->id)->get();

            foreach ($notesDB as $note){
                $this->notes[] = new SanitaryNoteClass($note->toArray());
            }
        }
    }
}
