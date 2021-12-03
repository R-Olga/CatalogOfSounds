@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Добавить аудио</h2>

{{--        Вывод сообщений если есть--}}
        @if(count(session('errors'))>0)
            <div class="alert alert-danger">
                @foreach(session('errors')->all() as $er)
                    {{$er}}<br>
                @endforeach
            </div>
        @endif

{{--        Если есть сообщение, то показываем--}}
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif

{{--        Форма добавления аудио--}}
        {!! Form::model($songs, array('action'=>'SongsController@store', 'files'=>true)) !!}
            <div class="row flex-nowrap justify-content-between align-items-center ">
                <div class="col-3 input-group">
                    {!! Form::text('title', '', array('class'=>'form-control')) !!}
                </div>
                <div class="col-3 input-group">
                    {!! Form::select('category_id', $categories, '', array('class'=>'form-control')) !!}
                </div>
                    {!! Form::file('songPath', array('class'=>'col-3; input-group'))!!}
                <div class="col-3 input-group">
                    <button class="col-7  btn btn-success" type="submit">Добавить аудио</button>
                    <a href="{{url('songs/')}}" class="col-4 ml-1 btn btn-success">Отмена</a>
                </div>
            </div>
        {!! Form::close() !!}

        <div class="row justify-content-end">

        </div>
    </div>
@endsection
