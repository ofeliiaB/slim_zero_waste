<?php

namespace Application\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    //

    protected $table = 'meals';

    public $primaryKey = 'id';

    // public function carts(){
    //   return $this->hasMany('App\Cart');
    // }
}
