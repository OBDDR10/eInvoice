<div class="table-responsive p-0 hide-scrollbar">
  <div class="row">
      <div class="col-3 d-flex justify-content-center">
          <canvas class="doughnut-chart" id="chart1"></canvas>
      </div>
      <div class="col-9">
          <table class="table table-responsive align-items-center justify-content-center mb-0">
              <thead>
                  <tr class="bg-color-light-gray">
                    <th class="text-sm">{{ __('messages.operation') }}</th>
                    <th class="text-sm text-right"></th>
                    <th class="text-sm text-right"></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.received_from') }}</p></td>
                    <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                    <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_operation_received_from'], 2) }}</p></td>
                  </tr>

                  @foreach($data as $row)
                    @if ($row->activity_type == 1 && $row->action_type == 1)
                      <tr>
                          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
                          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->total_amount, 2) }}</p></td>
                      </tr>
                    @endif
                  @endforeach
                  
                  <tr>
                    <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.paid_for') }}</p></td>
                    <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                    <td><p class="text-sm text-red text-right font-weight-bold mb-0">({{ getCurrencyCode() }} {{ number_format($totals['total_operation_paid_for'], 2) }})</p></td>
                  </tr>

                  @foreach($data as $row)
                    @if ($row->activity_type == 1 && $row->action_type == 2)
                      <tr>
                          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
                          <td><p class="text-sm text-red text-right font-weight-md mb-0">({{ getCurrencyCode() }} {{ number_format($row->total_amount, 2) }})</p></td>
                      </tr>
                    @endif
                  @endforeach

                  <tr>
                    <td>
                        <p class="text-sm text-dark font-weight-bold mb-0">
                            {{ __('messages.net_cashflow') }} {{ __('messages.from') }} {{ __('messages.operation') }}
                        </p>
                    </td>
                    <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                    
                    @if($totals['total_operation_net_cashflow'] > 0)
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_operation_net_cashflow'], 2) }}</p></td>
                    @else
                      <td><p class="text-sm text-red text-right font-weight-bold mb-0">({{ getCurrencyCode() }} {{ number_format($totals['total_operation_net_cashflow'], 2) }})</p></td>
                    @endif
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>

<div class="table-responsive p-0 pt-1 hide-scrollbar">
  <div class="row">
      <div class="col-3 d-flex justify-content-center">
      <canvas class="doughnut-chart" id="chart2"></canvas>
      </div>
      <div class="col-9">
          <table class="table table-responsive align-items-center justify-content-center mb-0">
              <thead>
                  <tr class="bg-color-light-gray">
                    <th class="text-sm">{{ __('messages.investing') }} {{ __('messages.activity') }}</th>
                    <th class="text-sm text-right"></th>
                    <th class="text-sm text-right"></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.received_from') }}</p></td>
                    <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                    <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_investing_received_from'], 2) }}</p></td>
                    </tr>
                  <tr>
                  
                  @foreach($data as $row)
                    @if ($row->activity_type == 2 && $row->action_type == 1)
                      <tr>
                          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
                          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->total_amount, 2) }}</p></td>
                      </tr>
                    @endif
                  @endforeach

                  <tr>
                    <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.paid_for') }}</p></td>
                    <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                    <td><p class="text-sm text-red text-right font-weight-bold mb-0">({{ getCurrencyCode() }} {{ number_format($totals['total_investing_paid_for'], 2) }})</p></td>
                  </tr>
                  
                  @foreach($data as $row)
                    @if ($row->activity_type == 2 && $row->action_type == 2)
                      <tr>
                          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
                          <td><p class="text-sm text-red text-right font-weight-md mb-0">({{ getCurrencyCode() }} {{ number_format($row->total_amount, 2) }})</p></td>
                      </tr>
                    @endif
                  @endforeach

                  <tr>
                    <td>
                        <p class="text-sm text-black font-weight-bold mb-0">
                            {{ __('messages.net_cashflow') }} {{ __('messages.from') }} {{ __('messages.investing') }}
                        </p>
                    </td>
                    <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                    
                    @if($totals['total_investing_net_cashflow'] > 0)
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_investing_net_cashflow'], 2) }}</p></td>
                    @else
                      <td><p class="text-sm text-red text-right font-weight-bold mb-0">({{ getCurrencyCode() }} {{ number_format($totals['total_investing_net_cashflow'], 2) }})</p></td>
                    @endif
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>

<div class="table-responsive p-0 pt-1 hide-scrollbar">
  <div class="row">
      <div class="col-3 d-flex justify-content-center">
          <canvas class="doughnut-chart" id="chart3"></canvas>
      </div>
      <div class="col-9">
          <table class="table table-responsive align-items-center justify-content-center mb-0">
              <thead>
                  <tr class="bg-color-light-gray">
                    <th class="text-sm">{{ __('messages.financing') }} {{ __('messages.activity') }}</th>
                    <th class="text-sm text-right"></th>
                    <th class="text-sm text-right"></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.received_from') }}</p></td>
                    <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                    <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_financing_received_from'], 2) }}</p></td>
                  </tr>
                  
                  @foreach($data as $row)
                    @if ($row->activity_type == 3 && $row->action_type == 1)
                      <tr>
                          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
                          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->total_amount, 2) }}</p></td>
                      </tr>
                    @endif
                  @endforeach

                  <tr>
                    <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.paid_for') }}</p></td>
                    <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                    <td><p class="text-sm text-red text-right font-weight-bold mb-0">({{ getCurrencyCode() }} {{ number_format($totals['total_financing_paid_for'], 2) }})</p></td>
                  </tr>
                  
                  @foreach($data as $row)
                    @if ($row->activity_type == 3 && $row->action_type == 2)
                      <tr>
                          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
                          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
                          <td><p class="text-sm text-red text-right font-weight-md mb-0">({{ getCurrencyCode() }} {{ number_format($row->total_amount, 2) }})</p></td>
                      </tr>
                    @endif
                  @endforeach

                  <tr>
                    <td>
                        <p class="text-sm text-black font-weight-bold mb-0">
                            {{ __('messages.net_cashflow') }} {{ __('messages.from') }} {{ __('messages.financing') }}
                        </p>
                    </td>
                    <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
                    
                    @if($totals['total_financing_net_cashflow'] > 0)
                      <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_financing_net_cashflow'], 2) }}</p></td>
                    @else
                      <td><p class="text-sm text-red text-right font-weight-bold mb-0">({{ getCurrencyCode() }} {{ number_format($totals['total_financing_net_cashflow'], 2) }})</p></td>
                    @endif
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>

<div class="table-responsive p-0 pt-4 hide-scrollbar">
  <div class="row">
      <div class="col-3 d-flex justify-content-center"></div>
      <div class="col-9">
          <table class="table table-responsive align-items-center justify-content-center mb-0">
              <thead>
                  <tr class="bg-color-light-gray">
                    <th class="text-md">{{ __('messages.net_increase_in_cash') }}</th>
                    <th class="text-md text-right"></th>

                    @if($totals['total_net_cashflow'] > 0)
                      <th class="text-md text-green text-right">{{ getCurrencyCode() }} {{ number_format($totals['total_net_cashflow'], 2) }}</th>
                    @else
                      <th class="text-md text-red text-right">({{ getCurrencyCode() }} {{ number_format($totals['total_net_cashflow'], 2) }})</th>
                    @endif
                  </tr>
              </thead>
          </table>
      </div>
  </div>
</div>