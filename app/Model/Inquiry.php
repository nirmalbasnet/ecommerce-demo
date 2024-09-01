<?php

namespace App\Model;

use App\Events\InquirySubmitted;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';
    protected $guarded = ['id'];

    protected $dispatchesEvents = [
        'created' => InquirySubmitted::class,
    ];
}
