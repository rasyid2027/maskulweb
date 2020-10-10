<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{route('dashboard')}}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="{{route('student')}}" class="{{ request()->is('student') ? 'active' : '' }}"><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
            </ul>
        </nav>
    </div>
</div>