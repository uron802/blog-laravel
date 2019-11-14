<?php

namespace App\Http\Composers;

use App\Models\Article;
use Illuminate\View\View;

class NewArticleComposers
{
    public function compose(View $view)
    {
        $newArticles = Article::publishEqual('1')->orderBy('post_date_time', 'desc')->take(5)->get();
        $view->with('newArticles', $newArticles);
    }
}
