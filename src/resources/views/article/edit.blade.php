@extends('layouts.app-admin')

@section('content')

<form action="{{ route('article.update', ['article' => $article]) }}" method='post' id='update-form'>
    @csrf
    <div class="field">
        <label class="label">記事タイトル</label>
        <div class="control">
            <input type="text" name="title" id="title" class='input' placeholder='タイトル' value="{{ $article->title }}" required>
        </div>
        @if ($errors->has('title'))
        <div class="help is-danger">
            {{ $errors->first('title') }}
        </div>
        @endif
    </div>
    <div class="field is-grouped">
        <label class="label">カテゴリー（※複数選択可）</label>
        <div class="control">
            <div class="select is-multiple">
                <select multiple size="5" name="tag[]">
                    @foreach ($all_tags as $tag)
                    @if ($tags->contains($tag->id))
                    <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                    @else
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="control">
            <a id="bt-add-category" class="button is-link is-light">新しいカテゴリーを追加</a>
        </div>
        <div class="field is-grouped is-grouped-multiline" id="new-category-field">
        </div>
    </div>
    <div class="field">
        <label class="label">記事本文</label>
        <div class="control">
            <textarea name="text" id="text" cols="30" rows="10" id="text">{{ $article->text }}</textarea>
        </div>
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
