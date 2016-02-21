<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 11:00 PM
 */

namespace App\Repositories\Activity;


interface ActivityRepository
{
    public function log(array $data);
}
