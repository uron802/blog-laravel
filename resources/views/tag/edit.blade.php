@extends('layouts.app-admin')

@section('content')
<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
            <li><a href="{{ route('tag.list') }}">カテゴリー一覧</a></li>
        <li class="is-active"><a href="#" aria-current="page">カテゴリー編集</a></li>
    </ul>
</nav>
<section class='box'>
    <form action="{{ route('tag.update', ['tag' => $tag]) }}" method='post' id='update-form'>
        @csrf
        <div class="field">
            <label class="label">カテゴリー名<span class="tag is-danger">必須</span></label>
            <div class="control">
                <input type="text" name="name" id="name" class='input' placeholder='カテゴリー名' value="{{ $tag->name }}" required>
            </div>
            @if ($errors->has('name'))
            <div class="help is-danger">
                {{ $errors->first('name') }}
            </div>
            @endif
        </div>
        <div class='button-area'>
            <input type="submit" class='button is-success' value="変更する" onclick="event.preventDefault();document.getElementById('update-form').submit();">
        </div>
    </form>
</section>
@endsection
