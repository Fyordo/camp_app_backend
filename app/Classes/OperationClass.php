<?php

namespace App\Classes;

use App\Models\ShopModel;
use App\Models\StaffModel;
use App\Models\User;

/**
 * Class Operation
 *
 * @OA\Schema(
 *      schema="Operation",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          description="Идентификатор",
 *          type="interger"
 *      ),
 *      @OA\Property(
 *          property="shop",
 *          description="Магазин",
 *          type="object",
 *          ref="#/components/schemas/Shop"
 *      ),
 *      @OA\Property(
 *          property="buyer",
 *          description="Покупатель",
 *          type="object",
 *          ref="#/components/schemas/User"
 *      ),
 *      @OA\Property(
 *          property="sum",
 *          description="Сумма покупки",
 *          type="float"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="Когда была произведена покупка UNIX",
 *          type="interger"
 *      )
 *  )
 *
 * @package App\Models
 */
class OperationClass
{
    public int $id;
    public ShopClass $shop;
    public UserClass $buyer;
    public float $sum;
    public int $created_at;

    public function __construct(array $arr){
        $this->id = $arr['id'];
        $this->buyer = new UserClass(User::where('users.id', $arr['buyer_id'])->first()->toArray());
        $this->shop = new ShopClass(ShopModel::where('shops.seller_id', $arr['seller_id'])->first()->toArray());
        $this->sum = $arr['sum'];

        $this->created_at = strtotime($arr['created_at']);
    }
}
