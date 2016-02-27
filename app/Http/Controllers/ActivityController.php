<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/27/16
 * Time: 1:10 PM
 */

namespace App\Http\Controllers;


use App\Repositories\Activity\ActivityRepository;

class ActivityController extends Controller
{
    /**
     * @var ActivityRepository
     */
    private $activity;

    /**
     * ActivityController constructor.
     */
    public function __construct(ActivityRepository $activity)
    {
        $this->activity = $activity;
    }

    public function getActivityList()
    {
        $activities = $this->activity->paginateActivities();

        return view(settings('theme_folder') . 'activity/activity-list', compact('activities'));
    }
}
