@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">You are Manager.</div>
                    <div class="card-header">Список заявок</div>
                    <div class="card-body">
{{--                        @dd($posts)--}}
                        @foreach ($posts as $post)
                            <div>ID: {{ $post->id }}</div>
                            <div><strong>Ім'я: {{ $post->name }}</strong></div>
                            <div>Email: {{ $post->email }}</div>
                            <div>Тема: {{ $post->subject }}</div>
                            <div>Повідомлення: {{ $post->message }}</div>
                            <div><a href="{{ $post->fileurl }}">{{ $post->fileurl }}</a></div>
                            <div>Дата: {{ $post->created_at }}</div>
                            <div>Оброблено: <input type="checkbox" value="{{ $post->sent }}"></div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
