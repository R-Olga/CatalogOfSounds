@extends('layouts.app')

@section('content')
    <div class="container">

        @include('admin.navadmin')

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/songs')}}">Все</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/songs/new')}}">Новые</a>
            </li>
        </ul>

        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif

        @foreach($songs as $song)
            <div class="row row-cols-3 mt-4 justify-content-around align-items-center">
                <p class="col-3">{{$song->title}}</p>
                <audio controls preload="none" class="">
                    <source src="{{$song->songPath}}" type="audio/mp3">
                </audio>
                <div class="text-right">
                    {!! Form::model($song, array('route'=>array('admin.update', $song->id), 'method'=>'PUT')) !!}
                        <div class="input-group">
                            {!! Form::select('category_id', $categories, $song->category_id, array('class'=>'form-control')) !!}
                            {!! Form::select('status_id', $statuses, $song->status_id, array('class'=>'form-control')) !!}
                            {!! Form::submit('Сохранить', array('class'=>'btn btn-primary input-group-append')) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach

    </div>
@endsection
