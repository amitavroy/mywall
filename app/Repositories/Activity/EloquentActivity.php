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

    public function paginateActivities($limit = 20, $search = null)
    {
        $query = $this->model->query();

        return $this->paginateAndFilterResults($limit, $search, $query);
    }

    private function paginateAndFilterResults($perPage, $search, $query)
    {
        if ($search) {
            $query->where('description', 'LIKE', "%$search%");
        }

        return $query->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }
}
