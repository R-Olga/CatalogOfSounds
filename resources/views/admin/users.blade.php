@extends('layouts.app')

@section('content')
    <div class="container">

        @include('admin.navadmin')

        <h4>Users</h4>

        @foreach($users as $user)
            <div class="row">
            <p class="col-1 mr-3">{{$user->name}}</p>

            {!! Form::model($user, array('route'=>array('admin.userUpdate', $user->id), 'method'=>'GET')) !!}

            {!! Form::submit(($user->blocked == 0 ? 'Заблокировать' : 'Разблокировать'), array('class'=> [$user->blocked == 0 ? 'btn btn-danger' : 'btn  btn-success'])) !!}
        {!! Form::close() !!}
            </div>
    @endforeach

</div>
@endsection
