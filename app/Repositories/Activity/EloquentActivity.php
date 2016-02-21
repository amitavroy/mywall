<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 11:01 PM
 */

namespace App\Repositories\Activity;


use App\Support\Activity\Activity;

class EloquentActivity implements ActivityRepository
{

    public function log(array $data)
    {
        return Activity::create($data);
    }
}
