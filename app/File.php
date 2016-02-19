<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Define the fillable columns
     * @var array
     */
    protected $fillable = [
        'file_name', 'mime_type', 'file_size', 'file_path', 'status', 'type', 'client_file_name'
    ];
}
