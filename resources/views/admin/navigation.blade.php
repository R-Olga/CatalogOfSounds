
<ul class="mt-4 nav nav-pills offset-1">
    <li class="nav-item">
        <a class="nav-link {{($page === 'index') ? 'active' : ''}}" href="{{url('admin/')}}">Категории</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$page == 'songs' ? 'active' : ''}}" href="{{url('admin/songs')}}">Аудио</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$page == 'users' ? 'active' : ''}}" href="{{url('admin/users')}}">Пользователи</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$page == 'complaints' ? 'active' : ''}}" href="{{url('admin/complaints')}}">Жалобы</a>
    </li>
</ul>
