<?php

namespace App\Classes;
/**
 * Class Product
 *
 * @OA\Schema(
 *      schema="Product",
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
 *          property="price",
 *          description="Цена",
 *          type="interger"
 *      ),
 *      @OA\Property(
 *          property="description",
 *          description="Описание",
 *          type="string"
 *      )
 *  )
 *
 * @package App\Models
 */
class ProductClass
{
    public int $id;
    public string $title;
    public int $price;
    public string $description;

    public function __construct(array $arr){
        $this->id = $arr['id'];
        $this->title = $arr['title'];
        $this->price = $arr['price'];
        $this->description = $arr['description'];
    }
}
