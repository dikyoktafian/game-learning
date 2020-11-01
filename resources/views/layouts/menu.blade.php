<li class="nav-head">Content</li>
@if (Auth::user()->role->name === 'teacher')
    <li class="nav-item {{ Request::is('tasks*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tasks.index') }}">
            <i class="nav-icon icon-cursor"></i>
            <span>Tasks</span>
        </a>
    </li>
@else
    


{{-- <li class="nav-item {{ Request::is('taskQuestions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('taskQuestions.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Task Questions</span>
    </a>
</li>
<li class="nav-item {{ Request::is('taskAnswers*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('taskAnswers.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Task Answers</span>
    </a>
</li> --}}



<li class="nav-item {{ Request::is('members*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('members.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Members</span>
    </a>
</li>
{{-- <li class="nav-item {{ Request::is('memberAnswers*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('memberAnswers.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Member Answers</span>
    </a>
</li>
<li class="nav-item {{ Request::is('memberPoints*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('memberPoints.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Member Points</span>
    </a>
</li> --}}

<li class="nav-item {{ Request::is('classrooms*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('classrooms.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Classrooms</span>
    </a>
</li>
{{-- <li class="nav-item {{ Request::is('classroomDetails*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('classroomDetails.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Classroom Details</span>
    </a>
</li> --}}
{{-- <li class="nav-item {{ Request::is('memberTasks*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('memberTasks.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Member Tasks</span>
    </a>
</li> --}}

<li class="nav-head mt-3">Settings</li>
{{-- <li class="nav-item {{ Request::is('settings*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('settings.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Settings</span>
    </a>
</li> --}}
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('roles.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Roles</span>
    </a>
</li>
<li class="nav-item {{ Request::is('subjects*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('subjects.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Subjects</span>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
@endif