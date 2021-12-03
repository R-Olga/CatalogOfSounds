@extends('layouts.app')

@section('content')
    <div class="container">

        @if(count(session('errors'))>0)
            <div class="alert alert-danger">
                @foreach(session('errors')->all() as $er)
                    {{$er}}<br>
                @endforeach
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif

        {!! Form::model($category, array('action'=>'CategoriesController@store')) !!}
                {!! Form::text('title', '', array('class'=>'col-md-5', 'placeholder'=>'Название категории'))!!}
                <button class="btn btn-success" type="submit">Добавить категорию</button>
        {!! Form::close() !!}
    </div>
@endsection
