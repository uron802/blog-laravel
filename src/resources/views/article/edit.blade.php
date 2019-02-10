@extends('layouts.app')

@section('content')

<form action="{{ route('article.update', ['id' => $article->id]) }}" method='post' id='update-form'>
    @csrf
    <div>
        <label for="title">タイトル：</label>
        <input type="text" name="title" id="title" value="{{ $article->title }}">
        @if($errors->has('title'))
        <div>{{ $errors->first('title') }}</div>
        @endif
    </div>
    <div>
        <label for="text">本文：</label>
        <textarea name="text" id="text" cols="30" rows="10" id="text">{{ $article->text }}</textarea>
        @if($errors->has('text'))
        <div>{{ $errors->first('text') }}</div>
        @endif
    </div>
    <input type="hidden" name="publish" id="publish" value="{{ $article->publish }}">
    @if($article->publish == "0")
    <input type="submit" value="下書きに保存する" onclick="event.preventDefault();document.getElementById('publish').value='0';document.getElementById('update-form').submit();">
    <input type="submit" value="公開する" onclick="event.preventDefault();document.getElementById('publish').value='1';document.getElementById('update-form').submit();">
    @else
    <input type="submit" value="更新する" onclick="event.preventDefault();document.getElementById('publish').value='1';document.getElementById('update-form').submit();">
    <input type="submit" value="下書きに戻す" onclick="event.preventDefault();document.getElementById('back-draft-form').submit();">
    @endif
</form>
<form action="{{ route('article.back.draft', ['id' => $article->id]) }}" method='post' id='back-draft-form'>
    @csrf
</form>

@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<script>
        ClassicEditor
            .create( document.querySelector( '#text' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
@endsection
