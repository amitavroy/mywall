<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * @var Fillable columns
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];
}
