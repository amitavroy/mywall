<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    /**
     * Define the fillable column
     *
     * @var array
     */
    protected $fillable = [
        'from', 'to', 'message', 'attachment', 'status', 'user_id', 'type', 'subject'
    ];
}
