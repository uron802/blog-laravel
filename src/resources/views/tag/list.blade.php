@extends('layouts.app-admin')

@section('content')

    <table class='table'>
        <tr>
            <th>カテゴリー名</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($tags as $tag)
        <tr>
            <td>{{ $tag->name }}</td>
            <td><a class='button is-primary' href='{{ route('tag.edit', ['tag' => $tag]) }}'>編集する</a></td>
            <form action="{{ route('tag.delete', ['tag' => $tag]) }}" method='post' id="tag-form">
                @csrf
                <td><button class='button is-danger'>削除する</button></td>
            </form>
        </tr>
        @endforeach
    </table>
    {{ $tags->links() }}
@endsection
