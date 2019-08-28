<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Article $article, Request $request)
    {
        $this->validate($request, Comment::$rules);

        $comment = new Comment;
        $comment->contributor = $request->contributor;
        $comment->text = $request->text;
        $comment->parent_article_id = $article->id;
        $comment->approval_flg = false;
        $comment->save();

        return redirect()->route('article.show', ['article' => $article]);
    }

    public function list(Request $request)
    {
        $comments = Comment::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('comment.list', ["comments" => $comments]);
    }

    public function approve(Comment $comment, Request $request)
    {

        if($comment != null)
        {
            $comment->approval_flg = true;
            $comment->approval_user_id = Auth::user()->id;
            $comment->save();
        }

        return redirect()->route('comment.list');
    }

    public function backApprovalPending(Comment $comment, Request $request)
    {
        if($comment != null)
        {
            $comment->approval_flg = false;
            $comment->approval_user_id = null;
            $comment->save();
        }

        return redirect()->route('comment.list');
    }

    public function delete(Comment $comment, Request $request)
    {
        if($comment != null)
        {
            $comment->delete();
        }

        return redirect()->route('comment.list');
    }
}
