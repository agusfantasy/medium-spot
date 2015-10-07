<?php
namespace MediumSpot;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tag';

    /**
     * Get all of the owning taggables models.
     */
    public function taggables()
    {
        return $this->morphTo();
    }
}