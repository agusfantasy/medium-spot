<?php
namespace MediumSpot;

use MediumSpot\ArticleModel;
use MediumSpot\User;
use MediumSpot\Topic;

class Article
{
    /**
     * @var \MediumSpot\User
     */
    protected $user;

    /**
     * @var \MediumSpot\Topic
     */
    protected $topics;

    public function __construct()
    {
        $this->user = \MediumSpot\User::class;
        $this->topics = \MediumSpot\Topic::class;
    }


    public function find($id)
    {
        $model = ArticleModel::find($id);

        if (!$model->count()) {
            return $this->toObject($model);
        }

        return false;
    }

    public function fetch($user_id = null, $isActive = 0, $offset = 0, $limit = 20, array $filter = [], array $order = [])
    {
        $model = new ArticleModel;

        if (!is_null($user_id)) {
            $model->where('user_id', $user_id);
        }

        $count = $model->count();

        $model->skip($offset)->take($limit);
        $model->where('active', $isActive);

        if (!is_null($user_id)) {
            $model->where('user_id', $user_id);
        }

        if (!empty($filter)) {
            if (isset($filter['topic'])) {
                $model->topic()->find($filter['topic']);
            }
        }

        $articles = new \StdClass();

        $articles->count = $model->count();
        $articles->data = [];

        if ($model->count() > 0) {

            if (empty($order)) {
                $model->orderBy('id', 'desc');
            } else {
                $model->orderBy($order[0], $order[1]);
            }

            foreach($model->get() as $k => $row) {
                array_push($articles->data, $this->toObject($row));
            }

            $articles->next_id = $model->id;
        }

        return $articles;
    }


    /**
     * Create new Article
     *
     * @param array $data
     * @return object $this->toObject | false
     */
    public function create(array $data = [])
    {
        $model = new ArticleModel;

        $model->title = $data['title'];
        $model->content = $data['content'];
        $model->user_id = $data['user_id'];
        $model->active = $data['active'];

        if (!empty($data['thumbnail'])) {
            $model->thumbnail = $data['thumbnail'];
        }

        if (!empty($data['topics'])) {
            $model->topics()->sync($data['topics']);
        }

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
        $model = ArticleModel::find($id);

        if (!empty($data['title']) ) {
            $model->title = $data['title'];
        }

        if (!empty($data['content']) ) {
            $model->content = $data['content'];
        }

        if (!empty($data['active']) ) {
            $model->active = $data['active'];
        }

        if (!empty($data['thumbnail'])) {
            $model->thumbnail = $data['thumbnail'];
        }

        if (!empty($data['topics'])) {
            $model->topics()->sync($data['topics']);
        }

        if (!$model->save()) {
            return false;
        }

        return $this->toObject($model);
    }

    public function delete($id)
    {
        return ArticleModel::delete($id);
    }

    public function toObject($model)
    {
        $article = new \StdClass();

        $article->id = $model->id;
        $article->title = $model->title;
        $article->content = $model->content;
        $article->thumbnail = $model->thumbnail;

        //$article->user = $this->user->find($model->user_id);
        //$article->topics = $model->topics()->get();

        $article->created_at = $model->created_at->toDateTimeString();
        $article->updated_at = $model->updated_at->toDateTimeString();

        return $article;
    }
}
