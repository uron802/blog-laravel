@extends('layouts.app')

@section('content')

<form action="{{ route('article.store') }}" method='post' id="create-form">
    @csrf
    <div>
        <label for="title">タイトル：</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}">
        @if($errors->has('title'))
        <div>{{ $errors->first('title') }}</div>
        @endif
    </div>
    <div>
        <label for="text">本文：</label>
        <textarea name="text" cols="30" rows="10" id="text">{{ old('text') }}</textarea>
        @if($errors->has('text'))
        <div>{{ $errors->first('text') }}</div>
        @endif
    </div>
    <input type="hidden" name="publish" id="publish" value="1">
    <input type="submit" value="下書きに保存する" onclick="event.preventDefault();document.getElementById('publish').value='0';document.getElementById('create-form').submit();">
    <input type="submit" value="公開する" onclick="event.preventDefault();document.getElementById('publish').value='1';document.getElementById('create-form').submit();">
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
