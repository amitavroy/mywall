<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/1/16
 * Time: 12:44 PM
 */

namespace App\Repositories\Mail;

use App\Mail;
use App\Repositories\EloquentDBRepository;
use Illuminate\Support\Facades\Auth;
use Mail as SendMailService;

class EloquentMail extends EloquentDBRepository implements MailRepository
{
    /**
     * @var Mail
     */
    private $model;

    /**
     * EloquentMail constructor.
     * @param Mail $model
     */
    public function __construct(Mail $model)
    {
        $this->model = $model;
    }

    /**
     * Log the email into the database before sending it
     *
     * @param array $data
     *
     * $data['from']
     * $data['to']
     * $data['message']
     * $data['attachment']
     * $data['status']
     * $data['user_id']
     * $data['type']
     *
     * $data['subject']
     * $data['view']
     * $data['mailData']
     *
     * @return static
     */
    public function log(array $data)
    {
        $this->sendMail($data);

        return $this->model->create([
            'from' => $data['from'],
            'to' => $data['to'],
            'message' => $data['message'],
            'attachment' => $data['attachment'],
            'status' => $data['status'],
            'user_id' => Auth::user()->id,
            'type' => $data['type'],
            'subject' => $data['subject'],
        ]);
    }

    /**
     * Sending the actual email
     *
     * @param array $data
     */
    public function sendMail(array $data)
    {
        SendMailService::send($data['view'], [
            'pass' => $data['mailData']['pass'],
            'user' => $data['mailData']['user'],
        ], function ($m) use ($data) {
            $m->from('amitav.roy@focalworks.in', 'Amitav Roy');
            $m->to($data['mailData']['user']->email)->subject('Welcome to ' . settings('site_name'));
        });
    }

    /**
     * Get the list of all the mail records from the database
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllMailLog()
    {
        return $this->model->all();
    }

    /**
     * Get the paginated list of email records from the databased
     *
     * @param int $limit
     * @param null $search
     * @return mixed
     */
    public function getMailLogPaginated($limit = 20, $search = null)
    {
        $query = $this->model->query();

        return $this->paginateAndFilterResults($limit, $search, $query);
    }

    /**
     * Logic for the paginated result for Mails from database
     *
     * @param $limit
     * @param $search
     * @param $query
     * @return mixed
     */
    private function paginateAndFilterResults($limit, $search, $query)
    {
        if ($search) {
            $query->where('mails.type', 'LIKE', "%$search%");
        }

        return $query->orderBy('mails.created_at', 'DESC')
            ->paginate($limit);
    }
}
