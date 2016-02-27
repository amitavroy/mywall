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
    /**
     * @var Activity
     */
    private $model;

    /**
     * EloquentActivity constructor.
     */
    public function __construct(Activity $model)
    {
        $this->model = $model;
    }

    public function log(array $data)
    {
        return Activity::create($data);
    }

    public function getAllActivities()
    {
        return $this->model->all();
    }

    /**
     * Get the list of activity with pagination
     *
     * @param int $limit
     * @param null $search
     * @return mixed
     */
    public function paginateActivities($limit = 20, $search = null)
    {
        $query = $this->model->query();

        return $this->paginateAndFilterResults($limit, $search, $query);
    }

    /**
     * @param $perPage
     * @param $search
     * @param $query
     * @return mixed
     */
    private function paginateAndFilterResults($perPage, $search, $query)
    {
        if ($search) {
            $query->where('user_activity.description', 'LIKE', "%$search%");
        }

        $query->join('users as u', 'u.id', '=', 'user_activity.user_id', 'inner');

        $query->select([
            'user_activity.description as description',
            'user_activity.id as id',
            'u.name as name',
            'user_activity.ip_address as ip_address',
            'user_activity.created_at',
            'user_activity.user_agent',
        ]);

        return $query->orderBy('user_activity.created_at', 'DESC')
            ->paginate($perPage);
    }
}
