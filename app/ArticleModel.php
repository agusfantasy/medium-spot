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

    public function topics()
    {
        return $this->belongsToMany('MediumSpot\TopicModel');
    }

}