<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Event-Management') }}</title>
      <!-- Styles -->
      <link href="/css/app.css" rel="stylesheet">
      <link href="/css/public.css" rel="stylesheet">
      <style>
         body {
            background-color: #33373D;
         }
         
         .mac-style {
            width: 75% !important;
            -webkit-transition: width 1s ease-in-out;
            -moz-transition:width 1s ease-in-out;
            -o-transition: width 1s ease-in-out;
            transition: width 1s ease-in-out;
            float:right;
         }

         .mac-style:focus {
            width: 150% !important;
            }

         #navBarSearchForm {
               margin-left:30%;
            }
      </style>
      <!-- Scripts -->
      <script>
         window.Laravel = {!! json_encode([
                  'csrfToken' => csrf_token(),
               ]) !!};
      </script>
   </head>
   <body>
      <div id="app">
         <nav class="navbar navbar-inverse navbar-fixed-top" >
            <div class="container">
               <div class="navbar-header">
                  <!-- Collapsed Hamburger -->
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <!-- Branding Image -->
                  <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name', 'Event-Management') }}
                  </a>
               </div>
               <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  <!-- Left Side Of Navbar -->
                  @if (!Auth::guest())
                  <form class="nav navbar-form navbar-left" id="navBarSearchForm" role="search" method="POST" action="{{route('events.search')}}">
                     {{ csrf_field() }}
                     <div class="form-group has-feedback" >
                        <input  id="keyword" type="text" class="form-control mac-style" name="keyword" placeholder="Search Events" value="{{ old('keyword') }}">
                        <i class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></i>
                        <input type="submit" style="display:none"/>
                     </div>
                  </form>
                  @endif
                  
                  <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                     <!-- Authentication Links -->
                     @if (Auth::guest())
                     <li><a href="{{ route('login') }}">Login</a></li>
                     <li><a href="{{ route('register') }}">Register</a></li>
                     @else
                     <li><a style="font-weight:bold; color:green;" href="{{ route('events') }}">Browse Events</a></li>

                        @if(Auth::user()->admin)
                        <li class="dropdown">
                           <a style="font-weight:bold;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           Admin <span class="caret"></span>
                           </a>
                           <ul class="dropdown-menu" role="menu">
                              <li>
                                 <a href="{{ route('admin.account.create') }}">Create Account</a>
                              </li>
                              <li>
                                 <a href="{{ route('admin.manage.users') }}">Manage Accounts</a>
                              </li>
                              <li class="nav-divider"></li>
                              <li>
                                 <a href="{{ route('event.create') }}">Create Event</a>
                              </li>
                              <li>
                                 <a href="{{ route('registration.event.create') }}">Create Registration Event</a>
                              </li>
                              <li>
                                 <a href="{{ route('admin.manage.events') }}">Manage Events</a>
                              </li>
                              <li>
                                 <a href="{{ route('admin.payment') }}">Event Payment Details</a>
                              </li>
                           </ul>
                        </li>
                        @endif
                     <li class="dropdown">
                        <a style="font-weight:bold;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Account <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                           <li>
                              <a href="{{ route('profile') }}">Profile</a>
                              @if(!Auth::user()->admin)
                              <a href="{{ route('dependents') }}">My Dependents</a>
                              @endif
                           </li>
                           <li class="nav-divider"></li>
                           <li>
                              <a href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                              Logout
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                              </form>
                           </li>
                        </ul>
                     </li>
                     @endif
                  </ul>
               </div>
            </div>
         </nav>
         <div style="padding-top:50px;">
            @yield('content')
         </div>
      </div>
      <!-- Scripts -->
      <script src="/js/app.js"></script>
   </body>
   @include('layouts.footer')
</html>