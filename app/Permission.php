<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /**
     * @var Fillable columns
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];
}
