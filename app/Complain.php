<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $table = 'complaints';
    protected $fillable = ['title', 'song_id', 'status_id','description'];
}
