<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['prod_name','prod_price','prod_desc','prod_image','prod_qty'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
