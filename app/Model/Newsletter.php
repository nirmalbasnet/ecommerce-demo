<?php

namespace App\Model;

use App\Events\NewsletterSubscribed;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletters';
    protected $guarded = ['id'];

    protected $dispatchesEvents = [
        'created' => NewsletterSubscribed::class,
    ];
}
