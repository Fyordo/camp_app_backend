<?php

namespace App\Classes;

use App\Models\AdminModel;
use App\Models\ChildModel;
use App\Models\LeaderModel;
use App\Models\ParentModel;
use App\Models\StaffModel;
use App\Models\User;
/**
 * Class User
 *
 * @OA\Schema(
 *      schema="User",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          description="Идентификатор",
 *          type="interger"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="ФИО",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="Почта",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="phone",
 *          description="Телефон",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="cash",
 *          description="Счёт",
 *          type="float"
 *      ),
 *      @OA\Property(
 *          property="role",
 *          description="Роль",
 *          type="string"
 *      )
 *  )
 *
 * @package App\Models
 */
class UserClass
{
    public int $id;
    public string $name;
    public string $phone;
    public string $email;
    public float $cash;
    public string $role;

    public function __construct(array $arr){
        $this->id = $arr["id"];
        $this->name = $arr["name"];
        $this->phone = $arr["phone"];
        $this->email = $arr["email"];
        $this->cash = $arr['cash'];

        // Определение роли

        if ($this->child()){
            $this->role = 'child';
        }
        else if ($this->parent()){
            $this->role = 'parent';
        }
        else if ($this->admin()){
            $this->role = 'admin';
        }
        else if ($this->leader()){
            $this->role = 'leader';
        }
        else if ($this->staff()){
            $this->role = 'staff';
        }
        else{
            $this->role = 'error';
        }
    }

    public function child(){
        return ChildModel::where('user_id', $this->id)->first();
    }

    public function parent(){
        return ParentModel::where('user_id', $this->id)->first();
    }

    public function admin(){
        return AdminModel::where('user_id', $this->id)->first();
    }

    public function leader(){
        return LeaderModel::where('user_id', $this->id)->first();
    }

    public function staff(){
        return StaffModel::where('user_id', $this->id)->first();
    }

    public static function getById(int $user_id){
        return new UserClass(User::where('id', $user_id)->first()->toArray());
    }
}
