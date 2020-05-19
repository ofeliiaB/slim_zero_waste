<?php

namespace Application\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }
}
?>
