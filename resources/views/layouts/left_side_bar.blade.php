<style>
    .extra { 
    display: none;
}

a:hover .extra {
    display: inline-block;
}
</style>
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="{{route('profile')}}">
                @if (strlen(Auth::user()->email) > 21){{substr(Auth::user()->email,0,21)}}... <span style="margin-top:-60px;" class="extra">{{Auth::user()->email}}</span> @else {{Auth::user()->email}} @endif
            </a>
        </li>
        <li><a href="{{ route('home') }}">Home</a></li>
        @if(!Auth::user()->admin) 
        <li><a href="{{ route('dependents') }}">Dependents</a></li> 
        <li><a href="{{ route('dependent.add') }}">Add a Dependent</a></li> 
        @endif
        <li><a href="{{ route('events') }}">View all Events</a></li>
        <hr>
        @if(Auth::user()->admin)
        <li class="sidebar-brand"><a href="#">Admin</a></li>
        <li><a href="{{ route('admin.account.create') }}">Create Account</a></li>
        <li><a href="{{ route('event.create') }}">Create Event</a></li>
        <li><a href="{{ route('admin.payment') }}">Payment Details</a></li>
        <hr>
        @endif
        <li class="sidebar-logout">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>