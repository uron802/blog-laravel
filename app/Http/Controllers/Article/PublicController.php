<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Article\Controller as ArticleController;
use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;

class PublicController extends ArticleController
{
    public function store(ArticleFormRequest $request)
    {
        $request->setPublish(Article::PUBLIC_OF_PUBLISH);
        parent::store($request);
        return redirect()->route('article.list');
    }

    public function update(Article $article, ArticleFormRequest $request)
    {
        $request->setPublish(Article::PUBLIC_OF_PUBLISH);
        parent::update($article, $request);
        return redirect()->route('article.list');
    }
}