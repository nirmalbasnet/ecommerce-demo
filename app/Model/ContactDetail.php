<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $table = 'contact_details';
    protected $guarded = ['id'];
}
