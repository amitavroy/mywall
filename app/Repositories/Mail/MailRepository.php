<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 3/1/16
 * Time: 12:42 PM
 */

namespace App\Repositories\Mail;


interface MailRepository
{
    public function log(array $data);

    public function getAllMailLog();

    public function getMailLogPaginated($limit, $search);

    public function sendMail(array $data);
}
