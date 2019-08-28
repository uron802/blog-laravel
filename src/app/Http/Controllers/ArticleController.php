<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        // TODO 1ページに表示させたい記事数を設定可能にする
        $articles = Article::publishEqual('1')->orderBy('post_date_time', 'desc')->simplePaginate(1);
        return view('article.index', ["articles" => $articles]);
    }
    public function list(Request $request)
    {
        $articles = Article::orderBy('post_date_time', 'desc')->simplePaginate(10);
        return view('article.list', ["articles" => $articles]);
    }
    public function show(Article $article, Request $request)
    {
        $comments = Comment::where('parent_article_id', $article->id)->get();
        return view('article.show', ['article' => $article, 'comments' => $comments]);
    }
    public function create(Request $request)
    {
        return view('article.create');
    }
    public function edit(Article $article, Request $request)
    {
        return view('article.edit', ['article' => $article]);
    }
    public function store(Request $request)
    {
        $this->validate($request, Article::$rules);

        $article = new Article;
        $article->title = $request->title;
        $article->text = $request->text;
        $article->publish = $request->publish;
        $article->author = Auth::user()->id;
        $article->post_date_time = date("Y/m/d H:i:s");
        $article->save();

        return redirect()->route('article.list');
    }
    public function update(Article $article, Request $request)
    {
        $this->validate($request, Article::$rules);

        $form = $request->all();
        unset($form['_token']);

        if($article != null)
        {
            $article->fill($form)->save();
        }

        return redirect()->route('article.list');
    }
    public function delete(Article $article, Request $request)
    {

        if($article != null)
        {
            $article->delete();
        }

        return redirect()->route('article.list');
    }

    public function backDraft(Article $article, Request $request)
    {
        $form = $request->all();
        unset($form['_token']);

        if($article != null)
        {
            $article->publish = '0';
            $article->fill($form)->save();
        }

        return redirect()->route('article.list');
    }
}
