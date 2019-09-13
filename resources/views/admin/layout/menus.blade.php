<div class="account2">
    <div class="image img-cir img-120">
        <img src="{{ asset('cooladmin/images/icon/avatar-big-01.jpg') }}" alt="John Doe"/>
    </div>
    <h4 class="name">john doe</h4>
    <a href="#">Sign out</a>
</div>
<nav class="navbar-sidebar2">
    <ul class="list-unstyled navbar__list">
        <li class="{{ Request::route()->getName() == 'admin.dashboard'? 'active':'' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-bar"></i>Dashboard</a>
        </li>
        <li class="{{ Request::route()->getName() == 'admin.grade.index'? 'active':'' }}">
            <a href="{{ route('admin.grade.index') }}"><i class="fas fa-sort-numeric-up"></i>Grade</a>
        </li>
        <li class="{{ Request::route()->getName() == 'admin.module.index'? 'active':'' }}">
            <a href="{{ route('admin.module.index') }}"><i class="fas fa-book"></i>Modul</a>
        </li>
        <li class="{{ Request::route()->getName() == 'admin.school.index'? 'active':'' }}">
            <a href="{{ route('admin.school.index') }}"><i class="fas fa-building"></i>Sekolah</a>
        </li>
        <li class="{{ Request::route()->getName() == 'admin.user.index'? 'active':'' }}">
            <a href="{{ route('admin.user.index') }}"><i class="fas fa-user"></i>User</a>
        </li>
    </ul>
</nav>