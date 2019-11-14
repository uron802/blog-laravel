<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $articles = Article::publishEqual(self::PUBLISH_ARTICLE)->orderBy('post_date_time', 'desc')->with('tags')->simplePaginate(1);

            return view('article.index', ['articles' => $articles]);
        } else {
            $tagId = $request->query('tag');
            $articles = Article::publishEqual(self::PUBLISH_ARTICLE)->whereHas('tags', function ($query) use ($tagId) {
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
        $article->title = $request->title;
        $article->text = $request->text;
        $article->publish = $request->publish;
        $article->author = Auth::user()->id;
        $article->post_date_time = date('Y/m/d H:i:s');
        $article->save();

        $this->storeTag($request, $article);

        return redirect()->route('article.list');
    }

    public function update(Article $article, ArticleFormRequest $request)
    {
        $article->title = $request->title;
        $article->text = $request->text;
        $article->publish = $request->publish;
        $article->author = Auth::user()->id;
        $article->post_date_time = date('Y/m/d H:i:s');

        if ($article != null) {
            $article->save();

            $this->storeTag($request, $article);
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

    private function storeTag($request, $article)
    {
        $tags = $request->input('tag');
        if ($tags != null) {
            $article->tags()->detach();
            foreach ($tags as $tag) {
                $addTag = Tag::find($tag);
                $article->tags()->save($addTag);
            }
        }

        $newTagNames = $request->input('new-tag-name');
        if ($newTagNames != null) {
            foreach ($newTagNames as $newTagName) {
                $newTag = new Tag();
                $newTag->name = $newTagName;
                $newTag->save();
                $article->tags()->save($newTag);
            }
        }
    }
}
