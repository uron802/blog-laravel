<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store($id, Request $request)
    {
        $this->validate($request, Comment::$rules);

        $comment = new Comment;
        $comment->contributor = $request->contributor;
        $comment->text = $request->text;
        $comment->parent_article_id = $id;
        $comment->approval_flg = false;
        $comment->save();

        return redirect()->route('article.show', ['id' => $id]);
    }

    public function list(Request $request)
    {
        $comments = Comment::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('comment.list', ["comments" => $comments]);
    }

    public function approve($id, Request $request)
    {
        $comment = Comment::find($id);

        if($comment != null)
        {
            $comment->approval_flg = true;
            $comment->approval_user_id = Auth::user()->id;
            $comment->save();
        }

        return redirect()->route('comment.list');
    }

    public function backApprovalPending($id, Request $request)
    {
        $comment = Comment::find($id);

        if($comment != null)
        {
            $comment->approval_flg = false;
            $comment->approval_user_id = null;
            $comment->save();
        }

        return redirect()->route('comment.list');
    }

    public function delete($id, Request $request)
    {
        $comment = Comment::find($id);

        if($comment != null)
        {
            $comment->delete();
        }

        return redirect()->route('comment.list');
    }
}
