<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagFormRequest;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function list(Request $request)
    {
        $tags = Tag::orderBy('name', 'asc')->simplePaginate(10);
        return view('tag.list', [
            "tags" => $tags
        ]);
    }
    public function edit(Tag $tag, Request $request)
    {
        return view('tag.edit', ['tag' => $tag]);
    }
    public function update(Tag $tag, TagFormRequest $request)
    {
        if($tag != null)
        {
            $tag->name = $request->name;
            $tag->save();
        }

        return redirect()->route('tag.list');
    }
    public function delete(Tag $tag, Request $request)
    {

        if($tag != null)
        {
            $tag->articles()->detach();
            $tag->delete();
        }

        return redirect()->route('tag.list');
    }
}
