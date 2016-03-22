<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 11:00 PM
 */

namespace App\Wall\Repositories\Activity;


interface ActivityRepository
{
    public function log(array $data);

    public function getAllActivities();

    public function paginateActivities($limit, $search = null);

    public function getUserActivitiesWithPagination($limit);
}
