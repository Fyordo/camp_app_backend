<?php

namespace App\Classes;

use App\Models\ChildModel;
use App\Models\StaffModel;
use App\Models\User;
use DateTime;

class SanitaryNoteClass
{
    public int $id;
    public UserClass $child;
    public UserClass $medic;
    public string $description;
    public int $created_at;

    public function __construct(array $arr){
        $this->id = $arr['id'];
        $this->child = new UserClass(User::where('users.id', $arr['child_user_id'])->first()->toArray(), false);
        $this->medic = new UserClass(User::where('users.id', $arr['medic_user_id'])->first()->toArray());
        $this->description = $arr['description'];

        $this->created_at = strtotime($arr['created_at']);
    }
}
