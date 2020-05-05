<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = ['type', 'name', 'points', 'price', 'option', 'user_id'];
}
