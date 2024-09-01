<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $table = 'policies';
    protected $guarded = ['id'];
}
