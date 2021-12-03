@extends('layouts.app')

@section('content')
    <div class="container">

        @include('admin.navadmin')

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/complaints')}}">Все</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/complaints/new')}}">Новые</a>
            </li>
        </ul>

        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif

        @foreach($complaints as $complaint)
{{--            @dd($complaint)--}}
            <div class="row justify-content-around align-items-center">

                <p class="col-1 text-left"><span style="font-weight:bold">Id: </span>{{$complaint->song_id}}</p>
                <p class="col text-left"><span style="font-weight:bold">Причина: </span>{{$complaint->description}}</p>
                <p class="col text-left"><span style="font-weight:bold">Название: </span>{{$complaint->title}}</p>

                {!! Form::model($complaint, array('route'=>array('admin.updateComplaint', $complaint->id), 'method'=>'GET')) !!}
                    <div class="input-group">
                        {!! Form::select('status_id', $statuses, $complaint->status_id, array('class' => 'form-control')) !!}
                        {!! Form::submit('Сохранить', array('class'=>'btn btn-primary input-group-append')) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        @endforeach

    </div>
@endsection
