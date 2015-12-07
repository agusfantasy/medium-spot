<?php
namespace MediumSpot;

use MediumSpot\UserModel;
use MediumSpot\Topic;
use MediumSpot\Article;

class User
{
    /**
     * @var \MediumSpot\Topic
     */
    protected $topic;

    /**
     * @var \MediumSpot\Article
     */
    protected $article;

    public function __construct()
    {
        $this->article = new Article;
        //$this->topic = new Topic;
    }

    public function fetch($offset = 0, $limit = 20, $isActive = null, array $filter = [], array $order = [], $user_id = null)
    {
        $model = UserModel::skip($offset)->take($limit);

        if (!is_null($isActive)) {
            $model->where('active', $isActive);
        }

        if (!empty($filter)) {
            if (isset($filter['topic'])) {
                $model->topic()->find($filter['topic']);
            }
        }

        if (!is_null($user_id)) {
            $model->where('user_id', $user_id);
        }

        $articles = new \StdClass();

        $articles->count = $model->count();
        $articles->data = [];

        if ($model->exists()) {

            foreach($model->get() as $k => $row) {
                array_push($articles->data, $this->toObject($row));
            }

            if (empty($order)) {
                $article->orderBy('id', 'desc');
                $articles->next_id = $article->last()->id - 1;
            } else {
                $article->orderBy($order[0], $order[1]);
            }

        }

        return $articles;
    }

    public function find($id)
    {
        $model = UserModel::find($id);

        if (!$model->count()) {
            return $this->toObject($model);
        }

        return false;
    }

    function findBy($email, $password)
    {
        $model = UserModel::where('email', $email);

        $builder = $model->where('password', $password);

        $model = $builder->first();

        if (!is_null($model)) {
            return $this->toObject($model);
        }

        return false;
    }

    function create($data)
    {
        $model = new UserModel;

        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->password = $data['password'];

        if ($model->save()) {
            return $this->toObject($model);
        }

        return false;
    }

    public function toObject($model)
    {
        $user = new \StdClass();

        $user->id = $model->id;
        $user->name = $model->name;
        $user->email = $model->email;
        $user->avatar = $model->avatar;

        /*$user->article = $model->article();
        $user->like_article = $model->like_article();
        $user->follow = $model->follow();*/

        return $user;
    }
}
