@if(Auth::user()->role == 'admin')
@include('home')
@endif

@if(Auth::user()->role == 'user')
@include('home')
@endif