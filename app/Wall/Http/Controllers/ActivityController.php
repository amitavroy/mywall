<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/27/16
 * Time: 1:10 PM
 */

namespace App\Wall\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Wall\Repositories\Activity\ActivityRepository;

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
        $activities = $this->activity->paginateActivities(20);

        return view(settings('theme_folder') . 'activity/activity-list', compact('activities'));
    }

    /**
     * Get the list of activity for an individual user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserActivityList()
    {
        $activities = $this->activity->getUserActivitiesWithPagination(20);

        return view(settings('theme_folder') . 'user/user-activity-list', compact('activities'));
    }
}
