<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FineScale extends Model
{
    protected $fillable = ['type', 'name', 'points', 'price', 'option'];
}
