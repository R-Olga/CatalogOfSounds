@extends('layouts.app')

@section('content')

    <div class="container">

{{--        Вывод навигации для админа--}}
        @if (Gate::allows('admin'))
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{($adminPage === 'main') ? 'active' : ''}}" href="{{url('songs')}}">Главная</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link {{($adminPage === 'admin') ? 'active' : ''}}" href="{{url('admin')}}">Панель упревления</a>
                </li>
            </ul>
        @endif

{{--        Если пользователь авторизован, то показываем кнопку длядобавление аудио--}}
        @if (Gate::allows('addSong'))
            <div class="row justify-content-end">
                <a href="{{url('songs/create')}}" class="m-4 col-3 btn btn-success">Добавить аудио</a>
            </div>
        @endif


{{--        @dd(Auth::user())--}}
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif

{{--        Категории для фильтра--}}
        <div class="row row-cols-3 justify-content-between align-items-center">
            {!! Form::open(array('action'=>'SongsController@search', 'class'=>'px-2')) !!}
            <div class="input-group">
                {!! Form::select('category_id', array_add($categories, 0, 'Все'), $categories[0], ['class'=>'form-control']) !!}
                <div class="input-group-append">
                    <button class="btn btn-success btn-secondary">Показать</button>
                </div>
            </div>
            {!! Form::close() !!}

{{--            Поиск--}}
            {!! Form::open(array('action'=>'SongsController@search')) !!}
                    <div class="input-group">
                        {!! Form::text('textsearch', '',  ['placeholder'=>'Текст поиска', 'class'=>'form-control']) !!}
                        {!! Form::select('category_id', array_add($categories, 0, 'Все'), $categories[0], ['class'=>'form-control']) !!}
                        <div class="input-group-append">
                            <button class="btn btn-success btn-secondary">Нйти</button>
                        </div>
                    </div>
                {!! Form::close() !!}
        </div>

{{--        Вывод аудио--}}
        <div class="row">
            <div class="container">
            @foreach($songs as $song)
                <div class="row row-cols-3 mt-4 justify-content-around align-items-center">
                    <p class="">{{$song->title}}</p>
                    <audio controls preload="none" class="">
                        <source src="{{$song->songPath}}" type="audio/mp3">
                    </audio>
                    <div class="text-right">
                        <a href="{{$song->songPath}}" download="" class="pl-5">Скачать</a>
                        {!! Form::model($song, array('route' => array('complaints.show', $song))) !!}
                            <a href="{{'complaints/'.$song->id}}" class="pl-5">Пожаловаться</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

@endsection
