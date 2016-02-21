<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 10:59 PM
 */

namespace App\Support\Activity;


use App\Repositories\Activity\ActivityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logger
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var ActivityRepository
     */
    private $activity;

    /**
     * Logger constructor.
     */
    public function __construct(Request $request, ActivityRepository $activity)
    {
        $this->request = $request;
        $this->activity = $activity;
    }

    public function log($message)
    {
        $this->activity->log([
            'description' => $message,
            'user_id' => Auth::user()->id,
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->getUserAgent(),
        ]);
    }

    /**
     * Get user agent from request headers.
     *
     * @return string
     */
    private function getUserAgent()
    {
        return substr((string) $this->request->header('User-Agent'), 0, 500);
    }
}
