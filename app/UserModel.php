<?php
namespace MediumSpot;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The user created the article.
     */
    public function article()
    {
        return $this->hasMany('MediumSpot\ArticleModel');
    }

    /**
     * The user that belong to the article.
     */
    public function like_article()
    {
        return $this->belongsToMany('MediumSpot\ArticleModel');
    }

    /**
     * The user that belong to the user follow.
     */
    public function follow()
    {
        return $this->belongsToMany('MediumSpot\UserFollowModel');
    }
}
