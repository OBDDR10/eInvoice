@include('layouts.filter') 
@include('layouts.settings') 

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-2 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-0 pt-1">
    <div class="card mr-1 w-100" style="border-radius: .5rem!important;">
      <div class="card-body px-0 pb-2 table-padding" style="padding-top: .5rem!important; padding-bottom: .25rem!important;">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0">
              @yield('title')
            </h6>
          </nav>

          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>

          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item px-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-download cursor-pointer"></i>
              </a>
            </li>

            <li class="nav-item px-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-filter fixed-filter-button-nav cursor-pointer"></i>
              </a>
            </li>

            <li class="nav-item px-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            
            <li class="nav-item px-2 d-flex align-items-center dropdown">
              <a href="{{ route('login') }}" class="nav-link text-body px-0 dropdown-toggle" id="profile_dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-sm-1"></i>
              </a>

              @auth
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile_dropdown">
                  <li>
                      <span class="dropdown-item disabled">
                        <a class="text-md text-black font-weight-bold">{{ Auth::user()->name }}</a><br/>
                        <a class="text-sm font-weight-sm" style="text-transform: capitalize;">{{ Auth::user()->role }}</a>
                      </span>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="dropdown-item">
                            <a class="text-black font-weight-md">{{ __('auth.logout') }}</a>
                          </button>
                      </form>
                  </li>
                </ul>
              @else
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile_dropdown">
                  <li>
                      <span class="dropdown-item disabled">
                        <a class="text-black font-weight-md">{{ __('auth.guest') }}</a>
                      </span>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
                    <button type="submit" class="dropdown-item">
                      <a class="text-black font-weight-md" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                    </button>
                  </li>
                </ul>
              @endauth
            </li>
          </ul>

        </div>
      </div>
    </div>
  </div>
</nav>