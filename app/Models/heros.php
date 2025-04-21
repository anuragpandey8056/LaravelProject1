<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class heros extends Model
{
    use HasFactory;
    protected $table='heros';
    protected $guarded=[];

}
