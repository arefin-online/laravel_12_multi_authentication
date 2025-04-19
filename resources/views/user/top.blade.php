<a href="{{ route('home') }}">Home</a> | 
<a href="{{ route('about') }}">About</a> | 
@if(Auth::guard('web')->check())
<a href="{{ route('dashboard') }}">Dashboard</a> |
<a href="{{ route('profile') }}">Profile</a> | 
<a href="{{ route('logout') }}">Logout</a>
@else
<a href="{{ route('login') }}">Login</a> | 
<a href="{{ route('registration') }}">Register</a> 
@endif