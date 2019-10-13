<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'image','price', 'type','category'
    ];

    public function getPriceAttribute($value){
        $newForm = 'KSH'.$value;
        return $newForm;
    }

}
