<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        $articles = Article::publishEqual('1')->orderBy('post_date_time', 'desc')->simplePaginate(1);
        return view('article.index', ["articles" => $articles]);
    }
    public function list(Request $request)
    {
        $articles = Article::orderBy('post_date_time', 'desc')->simplePaginate(10);
        return view('article.list', ["articles" => $articles]);
    }
    public function show($id, Request $request)
    {
        $article = Article::find($id);
        return view('article.show', ['article' => $article]);
    }
    public function create(Request $request)
    {
        return view('article.create');
    }
    public function edit($id, Request $request)
    {
        $article = Article::find($id);
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
    public function update($id, Request $request)
    {
        $this->validate($request, Article::$rules);

        $form = $request->all();
        unset($form['_token']);

        $article = Article::find($id);
        $article->fill($form)->save();

        return redirect()->route('article.list');
    }
    public function delete($id, Request $request)
    {
        $article = Article::find($id)->delete();

        return redirect()->route('article.list');
    }

    public function backDraft($id, Request $request)
    {
        $article = Article::find($id);
        $article->publish = '0';
        $article->fill($form)->save();

        return redirect()->route('article.list');
    }
}
