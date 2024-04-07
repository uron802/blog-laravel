<?php

namespace App\Http\Controllers\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleFormRequest;
use App\Application\Business\Rules\Article\UseCases\Store\Input;
use App\Http\Controllers\Article\Controller as ArticleController;
use App\Application\Business\Rules\Article\UseCases\Store\Interactor;

class PublicController extends ArticleController
{
    public function store(ArticleFormRequest $request, Interactor $interactor)
    {
        $output = $interactor->execute(
            Input::create(
                title: $request->title,
                content: $request->content,
                isPublish: true,
                isReserve: $request->reserve,
                reserveDate: $request->reserveDate,
                reserveTime: $request->reserveTime,
                authorId: Auth::id(),
                createdAt: new \DateTimeImmutable(),
                tagIds: $request->tag,
            )
        );

        return redirect()->route('article.list');
    }

    public function update(Article $article, ArticleFormRequest $request)
    {
        $request->setPublish(Article::PUBLIC_OF_PUBLISH);
        parent::update($article, $request);

        return redirect()->route('article.list');
    }
}
