<?php
namespace MediumSpot;

use Illuminate\Database\Eloquent\Model;

class TopicModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topic';

    /**
     * The article that belong to the topic.
     */
    public function articles()
    {
        return $this->belongsToMany('MediumSpot\ArticleModel');
    }
}