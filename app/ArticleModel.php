<?php
namespace MediumSpot;

use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * The topic that belong to the article.
     */
    public function topic()
    {
        return $this->belongsToMany('MediumSpot\TopicModel');
    }

    /**
     * The user that belong to the article.
     */
    public function user_like()
    {
        return $this->belongsToMany('MediumSpot\UserLikeArticleModel');
    }

    /**
     * Get all of the article's tag.
     */
    public function tag()
    {
        return $this->morphMany('MediumSpot\TagModel', 'taggables');
    }
}