<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav"  style="font-size: 1.2rem;">
            <a class="nav-link"
            href="{{ Auth::user()->role == 'student' ? route('home') : (Auth::user()->role == 'teacher' ? route('home.teacher') : route('home.admin')) }}">
             <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
             <span class="nav-text">Dashboard</span>
         </a>

            <!-- Sidebar for Student -->
            @if (Auth::user()->role == 'student')
                <div class="sb-sidenav-menu-heading">Student Menu</div>
                <a class="nav-link" href="{{ route('student.my-subjects') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    <span class="nav-text">My Subjects</span>
                </a>
                <a class="nav-link" href="{{ route('student.materials') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    <span class="nav-text">Materials</span>
                </a>
                <a class="nav-link" href="{{ route('student.assignments') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    <span class="nav-text">Assignments</span>
                </a>
                <a class="nav-link" href="{{ route('student.results') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                    <span class="nav-text">Results</span>
                </a>
                <a class="nav-link" href="{{ route('student.change-password') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                    <span class="nav-text">Change Password</span>
                </a>

            <!-- Sidebar for Teacher -->
            @elseif (Auth::user()->role == 'teacher')
                <div class="sb-sidenav-menu-heading">Teacher Menu</div>
                <a class="nav-link" href="{{ route('teacher.upload-materials') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                    <span class="nav-text">Upload Materials</span>
                </a>
                <a class="nav-link" href="{{ route('teacher.upload-assignments') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-pencil-alt"></i></div>
                   <span class="nav-text">Upload Assignments</span>
                </a>
                <a class="nav-link" href="{{ route('teacher.upload-results') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    <span class="nav-text">Upload Results</span>
                </a>
                <a class="nav-link" href="{{ route('teacher.change-password') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                    <span class="nav-text">Change Password</span>
                </a>

            <!-- Sidebar for Admin -->
            @elseif (Auth::user()->role == 'admin')
                <div class="sb-sidenav-menu-heading">Admin Menu</div>
                <a class="nav-link" href="{{ route('admin.upload-announcement') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                    <span class="nav-text">Upload Announcement</span>
                </a>
                <a class="nav-link" href="{{ route('admin.register-classes') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>
                    <span class="nav-text">Register Classes</span>
                </a>
                <a class="nav-link" href="{{ route('admin.register-teachers') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="nav-text">Register Teachers</span>
                </a>
                <a class="nav-link" href="{{ route('admin.register-students') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-graduate"></i></div>
                    <span class="nav-text">Register Students</span>
                </a>
                <a class="nav-link" href="{{ route('admin.register-subjects') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                   <span class="nav-text">Register Subjects</span>
                </a>
                <a class="nav-link" href="{{ route('admin.register-exams') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    <span class="nav-text">Register Exam</span>
                </a>
                <a class="nav-link" href="{{ route('admin.change-password') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                    <span class="nav-text">Change Password</span>
                </a>
            @endif
        </div>

    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name ?? 'Guest' }}
    </div>

</nav>
