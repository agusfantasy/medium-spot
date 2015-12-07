<?php
namespace MediumSpot;

use MediumSpot\TopicModel;
use MediumSpot\User;
use MediumSpot\Article;

class Topic
{
    /**
     * @var \MediumSpot\User
     */
    protected $user;

    /**
     * @var \MediumSpot\Article
     */
    protected $article;

    public function __construct()
    {
        $this->user = new User;
        $this->topic = new Article;
    }

    public function fetch($offset = 0, $limit = 20, $user_id = null, $isActive = null, array $filter = [], array $order = [])
    {
        $model = TopicModel::skip($offset)->take($limit);

        if (!is_null($isActive)) {
            $model->where('active', $isActive);
        }

        if (!is_null($user_id)) {
            $model->where('user_id', $user_id);
        }

        $topics = new \StdClass();

        $topics->count = $model->count();
        $topics->data = [];

        if ($model->exists()) {

            foreach($model->get() as $k => $row) {
                array_push($topics->data, $this->toObject($row));
            }

            if (empty($order)) {
                $model->orderBy('id', 'desc');
                $model->next_id = $topic->last()->id - 1;
            } else {
                $model->orderBy($order[0], $order[1]);
            }

        }

        return $articles;
    }

    public function find($id)
    {
        $model = TopicModel::find($id);

        if (!$model->count()) {
            return $this->toObject($model);
        }

        return false;
    }

    /**
     * Create new Topic
     *
     * @param array $data
     * @return object $this->toObject | false
     */
    public function create(array $data = [])
    {
        $model = new ArticleModel;

        $model->name = $data['name'];
        $model->user_id = $data['user_id'];
        $model->active = $data['active'];

        if (!$model->save()) {
            return false;
        }

        return $this->toObject($model);
    }

    /**
     * Update Article
     *
     * @param int $id
     * @param array $data
     * @return object Article | false
     */
    public function update($id, $data = [])
    {
        $model = new ArticleModel::find($id);

        if (!empty($data['name']) ) {
            $model->title = $data['title'];
        }

        if (!empty($data['active']) ) {
            $model->active = $data['active'];
        }

        if (!$model->save()) {
            return false;
        }

        return $this->toObject($model);
    }

    public function delete($id)
    {
        return TopicModel::delete($id);
    }

    public function toObject($model)
    {
        $topic = new \StdClass();

        $topic->id = $model->id;
        $topic->name = $model->title

        $topic->user = $this->user->find($model->user_id);
        $topic->article = $model->articles()->get();

        return $topic;

    }
}
