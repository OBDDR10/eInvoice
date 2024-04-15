@extends('layouts.template')
@section('title')
    {{ __('messages.balance_sheet') }}
@endsection

@section('style')
    <style>
        table th:first-child,
        table td:first-child,
        table th:nth-child(2),
        table td:nth-child(2) {
            width: 26%;
        }

        table th:not(first-child),
        table td:not(first-child) {
            width: 12%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="card my-4 mr-1">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h6 class="text-white text-capitalize ps-3">
                                OceanLabs {{ __('messages.balance_sheet') }}
                            </h6>
                        </div>
                        <div class="col-3 text-end pr-2 pb-h">
                            <span class="text-sm font-weight-md text-white">
                                {{ __('messages.dated_at') }} : {{ date('Y-m-d') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body px-0 pb-2 table-padding">
              <div class="table-responsive p-0 hide-scrollbar">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr class="bg-color-light-gray">
                      <th class="text-sm">{{ __('messages.assets') }}</th>
                      <th class="text-sm"></th>
                      <th class="text-sm text-right">2022</th>
                      <th class="text-sm text-right">2023</th>
                      <th class="text-sm text-right">2024</th>
                      <th class="text-sm text-right">2025</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.current') }}</p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$512,600</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$497,300</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$935,800</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$1,158,500</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.cash') }}</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$372,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$471,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$690,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$932,000</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.account') }} {{ __('messages.receivable') }}</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$128,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$94,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$227,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$195,000</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Prepaid Expenses</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$4,800</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$5,500</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$3,200</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$6,800</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Inventory</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$7,800</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$11,400</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$15,600</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$24,700</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.non') }}-{{ __('messages.current') }}</p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$323,500</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$782,200</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$596,400</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$757,900</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Property & Equipment</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$320,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$675,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$590,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$752,000</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Goodwill</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$3,500</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$7,200</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$6,400</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$5,900</p></td>
                    </tr>
                    <tr class="border-top-dark-2">
                      <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.total') }} {{ __('messages.assets') }}</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$836,100</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$1,279,500</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$1,532,200</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$1,916,400</p></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="table-responsive p-0 pt-2 hide-scrollbar">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr class="bg-color-light-gray">
                      <th class="text-sm">{{ __('messages.liabilities') }}</th>
                      <th class="text-sm"></th>
                      <th class="text-sm text-right">2022</th>
                      <th class="text-sm text-right">2023</th>
                      <th class="text-sm text-right">2024</th>
                      <th class="text-sm text-right">2025</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.current') }}</p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$112,700</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$602,600</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$142,700</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$119,400</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.account') }} {{ __('messages.payable') }}</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$94,500</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$272,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$113,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$96,400</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Accrued Expenses</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$15,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$321,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$27,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$19,600</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Unearned Revenue</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$3,200</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$9,600</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$2,700</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$3,400</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.non') }}-{{ __('messages.current') }}</p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$328,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$788,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$297,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$244,000</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Long Term Debt</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$146,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$572,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$241,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$172,000</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Other Long Term Liabilities</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$182,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$216,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$56,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$72,000</p></td>
                    </tr>
                    <tr class="border-top-dark-2">
                      <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.total') }} {{ __('messages.liabilities') }}</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$440,700</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$1,390,600</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$439,700</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$255,900</p></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="table-responsive p-0 pt-2 hide-scrollbar">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr class="bg-color-light-gray">
                      <th class="text-sm">{{ __('messages.shareholder') }} {{ __('messages.equity') }}</th>
                      <th class="text-sm"></th>
                      <th class="text-sm text-right">2022</th>
                      <th class="text-sm text-right">2023</th>
                      <th class="text-sm text-right">2024</th>
                      <th class="text-sm text-right">2025</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Equity Capital</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$150,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$165,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$330,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$290,000</p></td>
                    </tr>
                    <tr>
                      <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black font-weight-md mb-0">Retained Earnings</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$12,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$24,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$36,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-md mb-0">$29,000</p></td>
                    </tr>
                    <tr class="border-top-dark-2">
                      <td>
                        <p class="text-sm text-black font-weight-bold mb-0">
                            {{ __('messages.total') }} {{ __('messages.shareholder') }} {{ __('messages.equity') }}
                        </p>
                      </td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$162,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$189,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$366,000</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$319,000</p></td>
                    </tr>
                    <tr class="border-top-dark-2">
                      <td>
                        <p class="text-sm text-black font-weight-bold mb-0">
                            {{ __('messages.total') }} {{ __('messages.liabilities') }} &
                            {{ __('messages.shareholder') }} {{ __('messages.equity') }}
                        </p>
                      </td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$602,700</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$1,579,600</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$805,700</p></td>
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">$574,900</p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
@endsection
