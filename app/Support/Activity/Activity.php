<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 2/21/16
 * Time: 10:56 PM
 */

namespace App\Support\Activity;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * This model should not have update at
     */
    const UPDATED_AT = null;

    /**
     * Define the table the model is bind to
     *
     * @var string
     */
    protected $table = 'user_activity';

    /**
     * Define the fields which are fillable
     *
     * @var array
     */
    protected $fillable = ['description', 'user_id', 'ip_address', 'user_agent'];

    /**
     * Set Activity and User relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
