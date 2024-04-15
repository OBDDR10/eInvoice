<div class="row pt-1 pb-1">
  <div class="col-xl-2 mb-4" style="width: 16%;">
    <div class="card">
        <div class="card-header p-2 pt-2 d-flex justify-content-center">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center 
                d-flex justify-content-center align-items-center mt-n4 position-absolute" style="width: 55%;">
                <i class="material-icons opacity-10 icon-2x" style="top: 0; font-size: 35px;">access_time</i>
            </div>
            <div class="text-end" style="padding-top: 3.5rem;">
                <p class="text-sm mb-0 text-capitalize">{{ __('messages.current') }}</p>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 text-center">
            <h6 class="mb-0">{{ getCurrencyCode() }} {{ number_format($totals->current, 2) }}</h6>
        </div>
    </div>
  </div>
  <div class="col-xl-2 mb-4" style="width: 16%;">
    <div class="card">
        <div class="card-header p-2 pt-2 d-flex justify-content-center">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center 
                d-flex justify-content-center align-items-center mt-n4 position-absolute" 
                style="width: 55%; background: linear-gradient(195deg, #FFD700, #FFC800);">
                <a class="text-white text-2xl font-weight-bold">> 0</a>
            </div>
            <div class="text-end" style="padding-top: 3.5rem;">
                <p class="text-sm mb-0 text-capitalize">1 - 30 {{ __('messages.day') }}</p>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 text-center">
            <h6 class="mb-0">{{ getCurrencyCode() }} {{ number_format($totals->over_one, 2) }}</h6>
        </div>
    </div>
  </div>
  <div class="col-xl-2 mb-4" style="width: 16%;">
    <div class="card">
        <div class="card-header p-2 pt-2 d-flex justify-content-center">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center 
                d-flex justify-content-center align-items-center mt-n4 position-absolute" 
                style="width: 55%; background: linear-gradient(195deg, #FF8C00, #FF7F50);">
                <a class="text-white text-2xl font-weight-bold">> 30</a>
            </div>
            <div class="text-end" style="padding-top: 3.5rem;">
                <p class="text-sm mb-0 text-capitalize">31 - 60 {{ __('messages.day') }}</p>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 text-center">
            <h6 class="mb-0">{{ getCurrencyCode() }} {{ number_format($totals->over_thirty, 2) }}</h6>
        </div>
    </div>
  </div>
  <div class="col-xl-2 mb-4" style="width: 16%;">
    <div class="card">
        <div class="card-header p-2 pt-2 d-flex justify-content-center">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center 
                d-flex justify-content-center align-items-center mt-n4 position-absolute" 
                style="width: 55%; background: linear-gradient(195deg, #DC143C, #FF0000);">
                <a class="text-white text-2xl font-weight-bold">> 60</a>
            </div>
            <div class="text-end" style="padding-top: 3.5rem;">
                <p class="text-sm mb-0 text-capitalize">61 - 90 {{ __('messages.day') }}</p>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 text-center">
            <h6 class="mb-0">{{ getCurrencyCode() }} {{ number_format($totals->over_sixty, 2) }}</h6>
        </div>
    </div>
  </div>
  <div class="col-xl-2 mb-4" style="width: 16%;">
    <div class="card">
        <div class="card-header p-2 pt-2 d-flex justify-content-center">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center 
                d-flex justify-content-center align-items-center mt-n4 position-absolute" 
                style="width: 55%; background: linear-gradient(195deg, #8B0000, #800000);">
                <a class="text-white text-2xl font-weight-bold">> 90</a>
            </div>
            <div class="text-end" style="padding-top: 3.5rem;">
                <p class="text-sm mb-0 text-capitalize">> 90 {{ __('messages.day') }}</p>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 text-center">
            <h6 class="mb-0">{{ getCurrencyCode() }} {{ number_format($totals->over_ninety, 2) }}</h6>
        </div>
    </div>
  </div>
  <div class="col-xl-2 mb-4" style="width: 16%;">
    <div class="card">
        <div class="card-header p-2 pt-2 d-flex justify-content-center">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center 
                d-flex justify-content-center align-items-center mt-n4 position-absolute" style="width: 55%;">
                <i class="material-icons opacity-10 icon-2x" style="top: 0; font-size: 35px;">done</i>
            </div>
            <div class="text-end" style="padding-top: 3.5rem;">
                <p class="text-sm mb-0 text-capitalize">{{ __('messages.total') }}</p>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 text-center">
            <h6 class="mb-0">{{ getCurrencyCode() }} {{ number_format($totals->total, 2) }}</h6>
        </div>
    </div>
  </div>               
</div>