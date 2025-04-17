<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    protected $table="products";
    Protected $fillable=[
        'name',
        'price',
        'image',
        'cateory_id'
       

    ];
    public function category(){
        return $this->belongsTo(category::class,'cateory_id');
    }


 
}
