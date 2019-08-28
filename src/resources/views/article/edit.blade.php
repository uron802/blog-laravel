@extends('layouts.app-admin')

@section('content')

<form action="{{ route('article.update', ['article' => $article]) }}" method='post' id='update-form'>
    @csrf
    <div class="field">
        <p class="control">
            <input type="text" name="title" id="title" class='input' placeholder='タイトル' value="{{ $article->title }}" required>
        </p>
        @if ($errors->has('title'))
        <p class="help is-danger">
            {{ $errors->first('title') }}
        </p>
        @endif
    </div>
    <div>
        <textarea name="text" id="text" cols="30" rows="10" id="text">{{ $article->text }}</textarea>
        @if($errors->has('text'))
        <div>{{ $errors->first('text') }}</div>
        @endif
    </div>
    <input type="hidden" name="publish" id="publish" value="{{ $article->publish }}">
    <div class='button-area'>
    @if($article->publish == "0")
        <input type="submit" class='button' value="下書きに保存する" onclick="event.preventDefault();document.getElementById('publish').value='0';document.getElementById('update-form').submit();">
        <input type="submit" class='button is-success' value="公開する" onclick="event.preventDefault();document.getElementById('publish').value='1';document.getElementById('update-form').submit();">
    @else
        <input type="submit" class='button is-success' value="更新する" onclick="event.preventDefault();document.getElementById('publish').value='1';document.getElementById('update-form').submit();">
        <input type="submit" class='button' value="下書きに戻す" onclick="event.preventDefault();document.getElementById('back-draft-form').submit();">
    @endif
    </div>
</form>
<form action="{{ route('article.back.draft', ['article' => $article]) }}" method='post' id='back-draft-form'>
    @csrf
</form>

@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<script>
        ClassicEditor
            .create( document.querySelector( '#text' ), {
                toolbar: [ 'bold', 'link', 'blockQuote' ],
            } )
            .catch( error => {
                console.error( error );
            } );
</script>
@endsection
