@extends('layouts.app-admin')

@section('content')

<form action="{{ route('article.store') }}" method='post' id="create-form">
    @csrf
    <div class="field">
        <p class="control">
            <input type="text" name="title" id="title" class='input' placeholder='タイトル' value="{{ old('title') }}" required>
        </p>
        @if ($errors->has('title'))
        <p class="help is-danger">
            {{ $errors->first('title') }}
        </p>
        @endif
    </div>
    <div>
        <textarea name="text" cols="30" rows="10" id="text">{{ old('text') }}</textarea>
        @if($errors->has('text'))
        <div>{{ $errors->first('text') }}</div>
        @endif
    </div>
    <input type="hidden" name="publish" id="publish" value="1">
    <div class='button-area'>
        <input type="submit" class='button' value="下書きに保存する" onclick="event.preventDefault();document.getElementById('publish').value='0';document.getElementById('create-form').submit();">
        <input type="submit" class='button' value="公開する" onclick="event.preventDefault();document.getElementById('publish').value='1';document.getElementById('create-form').submit();">
    </div>
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
