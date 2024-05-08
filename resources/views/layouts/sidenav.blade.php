<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start  bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0">
        <img src="{{ asset('/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">eInvoice</span>
    </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    
    <ul class="navbar-nav">
        <li class="nav-item">
            <a id="nav_" class="nav-link text-white " href="../">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">grid_view</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.dashboard') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_quotation" class="nav-link text-white " href="../quotation">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">file_open</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.quotation') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_invoice" class="nav-link text-white " href="../invoice">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">description</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.invoice') }}</span>
            </a>
        </li>
    </ul>
</aside>