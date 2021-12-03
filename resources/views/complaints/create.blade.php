@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Причина жалобы</h1>
        <div class="row">
        @foreach($song as $s)
            {!! Form::model($s, array('action'=>'ComplaintsController@store', 'class'=>'mt-5')) !!}
            <h3>Песня: {{$s->title}}</h3>
            {!! Form::hidden('song_id', $s->id) !!}
            <div class='form-group'>
                {!! Form::textarea('description', '', array('col'=>'5', 'rows' => '3')) !!}
            </div>
            <div>
                <a href="{{url('songs/')}}" class="col-4 ml-1 btn btn-success float-right">Отмена</a>
                <button class="btn btn-success float-right" type="submit">Отправить</button>
            </div>
            {!! Form::close() !!}
        @endforeach

        </div>

    </div>
@endsection
