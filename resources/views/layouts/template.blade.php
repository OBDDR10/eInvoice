@extends('layouts.app')
@section('body')  

<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.sidenav') 

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      @include('layouts.header') 
      
      @yield('content')
    </main>
</body>
@endsection
