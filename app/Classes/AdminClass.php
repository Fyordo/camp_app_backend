<?php

namespace App\Classes;

use App\Models\User;
/**
 * Class Admin
 *
 * @OA\Schema(
 *      schema="Admin",
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
 *      )
 *  )
 *
 * @package App\Models
 */
class AdminClass
{
    //public int $id;
    public UserClass $user;

    public function __construct(array $arr){
        //$this->id = $arr['id'];
        $this->user = new UserClass(
            User::where('id', '=', $arr['user_id'])->first()->toArray()
        );
    }
}
