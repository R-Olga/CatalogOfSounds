
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{($adminPage === 'main') ? 'active' : ''}}" href="{{url('songs')}}">Главная</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link {{($adminPage === 'admin') ? 'active' : ''}}" href="{{url('admin')}}">Панель упревления</a>
            </li>
        </ul>
    </div>
    <div class="row">
        @include('admin.navigation')
    </div>
</div>
