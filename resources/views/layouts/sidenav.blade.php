<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start  bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0">
        <img src="{{ asset('/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">eAccount</span>
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
            <a id="nav_transaction" class="nav-link text-white " href="../transaction">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">swap_horiz</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.transaction') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_financial_entity" class="nav-link text-white " href="../financial_entity">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">account_balance</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.financial_entity') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_entity_price_log" class="nav-link text-white " href="../entity_price_log">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">attach_money</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.entity_price_log') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_financial_activity" class="nav-link text-white " href="../financial_activity">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">directions_run</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.financial_activity') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_fixed_assets" class="nav-link text-white " href="../fixed_assets">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">business</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.fixed_assets') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_revenue" class="nav-link text-white " href="../revenue">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">trending_up</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.revenue') }}</span>
            </a>
        </li>

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">{{ __('messages.report') }}</h6>
        </li>

        <li class="nav-item">
            <a id="nav_aging_report" class="nav-link text-white " href="../aging_report">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.aging_report') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_balance_sheet" class="nav-link text-white " href="../balance_sheet">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.balance_sheet') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_cashflow_report" class="nav-link text-white " href="../cashflow_report">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.cashflow_report') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_fixed_assets_report" class="nav-link text-white " href="../fixed_assets_report">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.fixed_assets_report') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="nav_profit_loss_statement" class="nav-link text-white " href="../profit_loss_statement">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <span class="nav-link-text ms-1">{{ __('messages.profit_loss_statement') }}</span>
            </a>
        </li>
    </ul>

    </div>
    <!-- <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
        
    </div>
    </div> -->
</aside>