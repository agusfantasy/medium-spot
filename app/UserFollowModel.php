<?php
namespace MediumSpot;

use Illuminate\Database\Eloquent\Model;

class UserFollowModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_follow';


    /**
     * The user that belong to the user follow.
     */
    public function user()
    {
        return $this->belongsToMany('MediumSpot\UserModel');
    }
}