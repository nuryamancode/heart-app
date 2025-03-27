<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Heart<span style="color: #00930c">App</span>
        </a>
        <div class="sidebar-toggler">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav" id="sidebarNav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('chat') }}" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Chat</span>
                </a>
            </li>
            <li class="nav-item nav-category">Fungsi</li>
            <li class="nav-item">
                <a href="{{ route('test-manual') }}" class="nav-link">
                    <i class="link-icon" data-feather="sliders"></i>
                    <span class="link-title">Test Manual</span>
                </a>
            </li>
            <li class="nav-item nav-category">Kelola</li>
            <li class="nav-item">
                <a href="{{ route('artikel') }}" class="nav-link">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Artikel</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('jadwal-dokter') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Jadwal Dokter</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tutorial-video') }}" class="nav-link">
                    <i class="link-icon" data-feather="video"></i>
                    <span class="link-title">Tutorial Video</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('no-antrian') }}" class="nav-link">
                    <i class="link-icon" data-feather="pocket"></i>
                    <span class="link-title">Antrian</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
