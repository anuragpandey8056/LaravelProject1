<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = '_blog';
    use HasFactory;
    protected $fillable = ['title', 'content', 'image'];
}
