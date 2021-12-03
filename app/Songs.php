<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    protected $table = 'songs';
    protected $fillable = ['title', 'category_id', 'songPath'];
}
