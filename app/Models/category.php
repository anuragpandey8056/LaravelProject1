<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;
    protected $table="categories";
    Protected $fillable=[
       
        'categoryname'
       

    ];
    public function product(){
        return $this->hasMany(product::class,'cateory_id');
    }

   

}

