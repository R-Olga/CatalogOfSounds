@extends('layouts.app')

@section('content')
    <div class="container">
        @include('admin.navadmin')

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

        <div class="row row-cols-1 row-cols-md-2">
            <div >
                <h3 class="mt-3">Все категории: </h3>
                <ul class="col-7">
                    @foreach($categories as $category)
                        {!! Form::open(array('route'=>array('admin.destroy', $category->id))) !!}
                        {{Form::hidden('_method', 'DELETE')}}

                            <li class="row row-cols-2 align-items-center justify-content-start">
                                <p class="">{{$category->title}}</p>
                                <button class="btn btn-primary"type="submit">Удалить</button>
                            </li>
                        {!! Form::close() !!}
                    @endforeach
                </ul>
            </div>

            <div class="">
                <h3 class="mt-3">Добавить категорию</h3>
                {!! Form::model(array('action'=>'AdminController@store')) !!}
                    <div class="input-group-append">
                        {!! Form::text('title', '', array('class'=>'col-5 input-group', 'placeholder'=>'Название категории'))!!}
                        <button class="btn btn-success input-group-append" type="submit">Добавить категорию</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
