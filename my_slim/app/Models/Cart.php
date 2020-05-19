<?php

namespace Application\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //

    // protected $table='carts';

    // public $primaryKey = 'id';

    public $meals=null;
    public $totalPrice = 0;

    public function __construct($oldCart){
      if($oldCart){
        $this->meals = $oldCart->meals;
        $this->totalPrice = $oldCart->totalPrice;
      }
    }

    // public function add($meals, $id){
    //   $storedItem = ['price'=>$meals->price, 'meal'=>$meal];
    //   if($this->meals){
    //     if(array_key_exists($id, $this->$meals)){
    //       $storedItem = $this->$meals[$id];
    //     }
    //   }
    //
    //   $storedItem['price'] = $meal->price;
    //   $this->meals[$id] = $storedItem;
    //   $this->totalPrice += $meal->price;
    // }

    // public function user(){
    //   return $this->belongsTo('Application\User');
    //
    // }
    // public function meal(){
    //   return $this->belongsTo('Application\Meal');
    //
    // }
}
