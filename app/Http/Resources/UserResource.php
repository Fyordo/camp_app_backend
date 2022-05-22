<?php

namespace App\Http\Resources;

use App\Http\Requests\UserRequest;
use App\Models\AdminModel;
use App\Models\ChildModel;
use App\Models\LeaderModel;
use App\Models\ParentModel;
use App\Models\StaffModel;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  UserRequest  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'cash' => $this->cash,
            'role' => $this->getRole($this->id)
        ];
    }

    private function getRole($id){
        if ($this->child($id)){
            return 'child';
        }
        else if ($this->parent($id)){
            return 'parent';
        }
        else if ($this->admin($id)){
            return 'admin';
        }
        else if ($this->leader($id)){
            return 'leader';
        }
        else if ($this->staff($id)){
            return 'staff';
        }
        else{
            return 'the role is not set';
        }
    }

    private function child($id){
        return ChildModel::where('user_id', $id)->first();
    }

    private function parent($id){
        return ParentModel::where('user_id', $id)->first();
    }

    private function admin($id){
        return AdminModel::where('user_id', $id)->first();
    }

    private function leader($id){
        return LeaderModel::where('user_id', $id)->first();
    }

    private function staff($id){
        return StaffModel::where('user_id', $id)->first();
    }
}
