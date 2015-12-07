<?php
namespace MediumSpot\Http\Controllers\Front;

use MediumSpot\Http\Controllers\Controller;
use MediumSpot\Article;
use MediumSpot\Topic;
use MediumSpot\Helper;

class ArticleController extends Controller
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;

    }

    public function index()
    {
        $data['articles'] = $this->article->fetch(session('user')->id);
        return view('front.index', $data);
    }
}
