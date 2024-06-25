<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        {{-- <div class="sidebar-header">
            <img src="assets/images/logo.svg" alt="" srcset="">
        </div> --}}
        <p class="mt-4">
        <h1 class="text-center"><b>Logo</b></h1>
        </p>
        <div class="sidebar-menu">
            @php
                $user = auth()->user();
                $role_id = $user->roles->first()->pivot->role_id ?? null;
            @endphp

            {{$role_id}}

            <ul class="menu">

                <li class='sidebar-title'>Main Menu</li>
                <li class="sidebar-item">
                    <a href="/dashboard" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                @if ($role_id == 1)
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i data-feather="user" width="20"></i>
                            <span>Management User</span>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="{{ route('admin.users.index') }}">Users</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.faculties.index') }} " class='sidebar-link'>
                            <i data-feather="codesandbox" width="20"></i>
                            <span>Faculties</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.programs.index') }} " class='sidebar-link'>
                            <i data-feather="code" width="20"></i>
                            <span>Programs</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.scholarship_types.index') }} " class='sidebar-link'>
                            <i data-feather="layers" width="20"></i>
                            <span>Scholarship</span>
                        </a>
                    </li>
                @endif
                
                @if ($role_id == 2)
                    <li class="sidebar-item">
                        <a href="{{ route('scholarship-applications.index') }} " class='sidebar-link'>
                            <i data-feather="codesandbox" width="20"></i>
                            <span>Applications</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('scholarship-applications.create') }} " class='sidebar-link'>
                            <i data-feather="code" width="20"></i>
                            <span>Make Applications</span>
                        </a>
                    </li>
                @endif

                @if ($role_id == 4)

                    <li class="sidebar-item">
                        <a href="{{ route('studyProgram.student.index') }} " class='sidebar-link'>
                            <i data-feather="users" width="20"></i>
                            <span>Student Applicants</span>
                        </a>
                    </li>

                @endif

                @if ($role_id == 3)

                    <li class="sidebar-item">
                        <a href="{{ route('faculty.periods.index') }} " class='sidebar-link'>
                            <i data-feather="calendar" width="20"></i>
                            <span>Periode</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('faculty.student.index') }} " class='sidebar-link'>
                            <i data-feather="users" width="20"></i>
                            <span>Student Applicants</span>
                        </a>
                    </li>

                @endif
                
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
