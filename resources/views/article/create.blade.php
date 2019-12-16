@extends('layouts.app-admin')

@section('content')
<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
        <li class="is-active"><a href="#" aria-current="page">記事作成</a></li>
    </ul>
</nav>
<section class='box'>
    <form action="{{ route('article.store') }}" method='post' id="create-form">
        @csrf
        <div class="field">
            <label class="label">記事タイトル<span class="tag is-danger">必須</span></label>
            <div class="control">
                <input type="text" name="title" id="title" class='input' placeholder='タイトル' value="{{ old('title') }}" required>
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
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                <textarea name="text" cols="30" rows="10" id="text">{{ old('text') }}</textarea>
            </div>
            @if($errors->has('text'))
            <div>{{ $errors->first('text') }}</div>
            @endif
        </div>
        <div class="field">
            <label class="label">予約投稿</label>
        </div>
        <div class="field">
            <div class="control">
                <label class="radio">
                <input type="radio" name="reserve" value="0" checked>
                すぐに公開する
                </label>
                <label class="radio">
                <input type="radio" name="reserve" value="1">
                指定日時で予約投稿する
                </label>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <input type="date" name="reserve_date" id="reserve_date" class='input' value="{{ old('reserve_date') }}" >
            </div>
            <div class="control">
                <input type="time" name="reserve_time" id="reserve_time" class='input' value="{{ old('reserve_time') }}">
            </div>
        </div>
        <div class="field">
            @if ($errors->has('reserve_date'))
            <div class="help is-danger">
                {{ $errors->first('reserve_date') }}
            </div>
            @endif
            @if ($errors->has('reserve_time'))
            <div class="help is-danger">
                {{ $errors->first('reserve_time') }}
            </div>
            @endif
        </div>
        <input type="hidden" name="publish" id="publish" value="1">
        <div class='button-area'>
            <input type="submit" class='button' value="下書きに保存する" onclick="event.preventDefault();document.getElementById('publish').value='0';document.getElementById('create-form').submit();">
            <input type="submit" class='button' value="公開する" onclick="event.preventDefault();document.getElementById('publish').value='1';document.getElementById('create-form').submit();">
        </div>
    </form>
</section>
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
