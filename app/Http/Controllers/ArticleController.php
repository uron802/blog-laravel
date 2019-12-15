<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    const PRIVATE_ARTICLE = '0';
    const PUBLISH_ARTICLE = '1';

    //
    public function index(Request $request)
    {
        // TODO 1ページに表示させたい記事数を設定可能にする
        $tagId = $request->query('tag');
        $tag = Tag::where('id', '=', $tagId)->first();
        if ($tag == null) {
            $articles = Article::publishEqual(self::PUBLISH_ARTICLE)->reserve()->orderBy('post_date_time', 'desc')->with('tags')->simplePaginate(1);

            return view('article.index', ['articles' => $articles]);
        } else {
            $tagId = $request->query('tag');
            $articles = Article::publishEqual(self::PUBLISH_ARTICLE)->reserve()->whereHas('tags', function ($query) use ($tagId) {
                $query->where('id', '=', $tagId);
            })->orderBy('post_date_time', 'desc')->with('tags')->simplePaginate(1);

            return view('article.index', ['articles' => $articles, 'tag' => $tag]);
        }
    }

    public function list(Request $request)
    {
        $articles = Article::orderBy('post_date_time', 'desc')->simplePaginate(10);
        $privateArticles = Article::publishEqual(self::PRIVATE_ARTICLE)->orderBy('post_date_time', 'desc')->simplePaginate(10);
        $publishArticles = Article::publishEqual(self::PUBLISH_ARTICLE)->orderBy('post_date_time', 'desc')->simplePaginate(10);

        return view('article.list', [
            'articles' => [
                [
                    'key'            => 'all',
                    'value'          => $articles,
                    'tab_page_class' => '',
                ],
                [
                    'key'            => 'private',
                    'value'          => $privateArticles,
                    'tab_page_class' => '',
                ],
                [
                    'key'            => 'publish',
                    'value'          => $publishArticles,
                    'tab_page_class' => 'is-active',
                ],
            ],
        ]);
    }

    public function show(Article $article, Request $request)
    {
        // TODO 予約投稿した記事を閲覧できないようにする
        $comments = Comment::where('parent_article_id', $article->id)->get();
        $tags = $article->tags()->get();

        return view('article.show', ['article' => $article, 'comments' => $comments, 'tags' => $tags]);
    }

    public function create(Request $request)
    {
        $allTags = Tag::all();

        return view('article.create', ['all_tags' => $allTags]);
    }

    public function edit(Article $article, Request $request)
    {
        $allTags = Tag::all();
        $tags = $article->tags()->get();

        return view('article.edit', ['article' => $article, 'tags' => $tags, 'all_tags' => $allTags]);
    }

    public function store(ArticleFormRequest $request)
    {
        $article = new Article();
        $request->save($article);

        return redirect()->route('article.list');
    }

    public function update(Article $article, ArticleFormRequest $request)
    {
        if ($article != null) {
            $request->save($article);
        }

        return redirect()->route('article.list');
    }

    public function delete(Article $article, Request $request)
    {
        if ($article != null) {
            $article->tags()->detach();
            $article->delete();
        }

        return redirect()->route('article.list');
    }

    public function backDraft(Article $article, Request $request)
    {
        $form = $request->all();
        unset($form['_token']);

        if ($article != null) {
            $article->publish = '0';
            $article->fill($form)->save();
        }

        return redirect()->route('article.list');
    }

    public function plusLikeNum(Article $article)
    {
        $article->like_num += 1;
        $article->save();
    }
}
