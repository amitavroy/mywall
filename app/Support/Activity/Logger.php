<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 10:59 PM
 */

namespace App\Support\Activity;


use App\Wall\Repositories\Activity\ActivityRepository;
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
        // if the even is system generated, then add 0 as user id
        // and mark it system event
        if (Auth::guest()) {
            $userId = 1;
            $message = 'System event: ' . $message;
        } else {
            $userId = Auth::user()->id;
        }

        $this->activity->log([
            'description' => $message,
            'user_id' => $userId,
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
