<?php

namespace App\Classes;

use App\Models\User;

/**
 * Class Shop
 *
 * @OA\Schema(
 *      schema="Shop",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          description="Идентификатор",
 *          type="interger"
 *      ),
 *      @OA\Property(
 *          property="seller",
 *          description="Продавец",
 *          type="object",
 *          ref="#/components/schemas/User"
 *      ),
 *      @OA\Property(
 *          property="title",
 *          description="Название",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="category",
 *          description="Катигория",
 *          type="string"
 *      )
 *  )
 *
 * @package App\Models
 */
class ShopClass
{
    public int $id;
    public UserClass $seller;
    public string $title;
    public string $category;

    public function __construct(array $arr){
        $this->id = $arr['id'];
        $this->seller = new UserClass(User::where('users.id', $arr['seller_id'])->first()->toArray());
        $this->title = $arr['title'];
        $this->category = $arr['category'];
    }
}
