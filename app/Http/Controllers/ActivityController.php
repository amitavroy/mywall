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
     * @param ActivityRepository $activity
     */
    public function __construct(ActivityRepository $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Get the list of activities which the admin will see.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getActivityList()
    {
        $activities = $this->activity->paginateActivities(10);

        return view(settings('theme_folder') . 'activity/activity-list', compact('activities'));
    }
}
