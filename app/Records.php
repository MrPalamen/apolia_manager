<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    protected $fillable = ['number', 'surname', 'name', 'name_agent', 'grade_agent', 'note', 'credit'];
}
