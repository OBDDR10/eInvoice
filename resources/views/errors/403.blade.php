@extends('layouts.app')
@section('title')
    403 Forbidden
@endsection

@section('body')
  <style>
    body, html {
        height: 100%;
    }
    
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
  </style>

  <body class="bg-gray-200">
      <div class="container">
          <div class="card shadow-lg flex justify-center items-center" style="min-height: 60vh; width: 50%;">
              <div class="card-body flex justify-center items-center" style="display: flex;">
                  <div style="margin: auto;">
                    <h1 class="text-3xl font-bold text-center">403 - Forbidden</h1>
                    <p class="text-lg text-bold text-center">Sorry, you are not allowed to access this page.</p>
                    <button class="text-center btn btn-primary mt-2 w-100">
                      <a href="{{ route('dashboard.index') }}" class="text-blue-500">Go to Dashboard</a>
                    </button>
                  </div>
              </div>
          </div>
      </div>
  </body>
@endsection
