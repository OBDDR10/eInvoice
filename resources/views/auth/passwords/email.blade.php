@extends('layouts.app')
@section('title')
    {{ __('auth.reset_password') }}
@endsection

@section('body')
    <body class="bg-gray-200">
        <main class="main-content  mt-0">
            <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                @if (session('status'))
                    <div class="alert alert-success text-md text-white" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                  <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ __('auth.reset_password') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label for="email" class="form-label">{{ __('auth.email') }}</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">{{ __('auth.reset_password_link') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-12 col-md-6 my-auto">
                        <div class="copyright text-center text-sm text-white text-lg-start">
                            © <script>
                            document.write(new Date().getFullYear())
                            </script>
                            made with <i class="fa fa-heart" aria-hidden="true"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">OceanLabs</a>
                        </div>
                    </div>
                </div>
                </div>
            </footer>
            </div>
        </main>
    </body>
@endsection
