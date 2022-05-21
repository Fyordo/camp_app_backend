<?php

namespace App\Classes;

use App\Models\User;
/**
 * Class Staff
 *
 * @OA\Schema(
 *      schema="Staff",
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
 *          property="role",
 *          description="Роль персонала",
 *          type="string"
 *      )
 *  )
 *
 * @package App\Models
 */
class StaffClass
{
    public int $id;
    public UserClass $user;
    public string $role;

    public function __construct(array $arr){
        $this->id = $arr['id'];
        $this->role = $arr['role'];
        $this->user = new UserClass(
            User::where('id', '=', $arr['user_id'])->first()->toArray()
        );
    }
}
