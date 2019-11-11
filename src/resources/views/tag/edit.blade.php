@extends('layouts.app-admin')

@section('content')

<form action="{{ route('tag.update', ['tag' => $tag]) }}" method='post' id='update-form'>
    @csrf
    <div class="field">
        <label class="label">カテゴリー名</label>
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
@endsection
