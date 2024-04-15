<div class="table-responsive p-0">
  <table class="table align-items-center justify-content-center mb-0">
    <thead>
      <tr class="bg-color-light-gray">
        <th class="text-sm">{{ __('messages.cost') }}</th>
        <th class="text-sm text-right">{{ __('messages.opening_balance') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm text-right">{{ __('messages.disposal') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm text-right">{{ __('messages.closing_balance') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm">{{ __('messages.depreciation') }} {{ __('messages.rate') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $row)
        <tr>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->cost_opening_balance, 2) }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->cost_disposal, 2) }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->cost_closing_balance, 2) }}</p></td>
          <td>
            @php
              $percentage = ($row->cost_closing_balance / $row->cost_opening_balance) * 100;
              $colorClass = 'green';

              if ($percentage <= 10) {
                  $colorClass = 'dark-red';
              } elseif ($percentage <= 30) {
                  $colorClass = 'red';
              } elseif ($percentage <= 50) {
                  $colorClass = 'orange';
              } elseif ($percentage <= 70) {
                  $colorClass = 'yellow';
              }
            @endphp

            <div class="progress d-flex align-items-center">
                <div class="progress-bar {{ $colorClass }} bg-success" role="progressbar" style="width:{{ $percentage }}%;"></div>
            </div> 
          </td>
        </tr>
      @endforeach
      <tr>
        <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_cost_opening_balance'], 2) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_cost_disposal'], 2) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_cost_closing_balance'], 2) }}</p></td>
        <td>
          @php
            $percentage = ($totals['total_cost_closing_balance'] / $totals['total_cost_opening_balance']) * 100;
            $colorClass = 'green';

            if ($percentage <= 10) {
                $colorClass = 'dark-red';
            } elseif ($percentage <= 30) {
                $colorClass = 'red';
            } elseif ($percentage <= 50) {
                $colorClass = 'orange';
            } elseif ($percentage <= 70) {
                $colorClass = 'yellow';
            }
          @endphp

          <div class="progress d-flex align-items-center">
              <div class="progress-bar {{ $colorClass }} bg-success" role="progressbar" style="width:{{ $percentage }}%;"></div>
          </div> 
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="table-responsive p-0">
  <table class="table align-items-center justify-content-center mb-0">
    <thead>
      <tr class="bg-color-light-gray">
        <th class="text-sm">{{ __('messages.depreciation') }}</th>
        <th class="text-sm text-right">{{ __('messages.opening_balance') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm text-right">{{ __('messages.disposal') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm text-right">{{ __('messages.closing_balance') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm">{{ __('messages.depreciation') }} {{ __('messages.rate') }}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->depreciation_opening_balance, 2) }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->depreciation_disposal, 2) }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->depreciation_closing_balance, 2) }}</p></td>
          <td>
            @php
              $percentage = ($row->depreciation_closing_balance / $row->depreciation_opening_balance) * 100;
              $colorClass = 'green';

              if ($percentage <= 10) {
                  $colorClass = 'dark-red';
              } elseif ($percentage <= 30) {
                  $colorClass = 'red';
              } elseif ($percentage <= 50) {
                  $colorClass = 'orange';
              } elseif ($percentage <= 70) {
                  $colorClass = 'yellow';
              }
            @endphp

            <div class="progress d-flex align-items-center">
                <div class="progress-bar {{ $colorClass }} bg-success" role="progressbar" style="width:{{ $percentage }}%;"></div>
            </div> 
          </td>
        </tr>
      @endforeach
      <tr>
        <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_depreciation_opening_balance'], 2) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_depreciation_disposal'], 2) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_depreciation_closing_balance'], 2) }}</p></td>
        <td>
          @php
            $percentage = ($totals['total_depreciation_closing_balance'] / $totals['total_depreciation_opening_balance']) * 100;
            $colorClass = 'green';

            if ($percentage <= 10) {
                $colorClass = 'dark-red';
            } elseif ($percentage <= 30) {
                $colorClass = 'red';
            } elseif ($percentage <= 50) {
                $colorClass = 'orange';
            } elseif ($percentage <= 70) {
                $colorClass = 'yellow';
            }
          @endphp

          <div class="progress d-flex align-items-center">
              <div class="progress-bar {{ $colorClass }} bg-success" role="progressbar" style="width:{{ $percentage }}%;"></div>
          </div> 
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="table-responsive p-0">
  <table class="table align-items-center justify-content-center mb-0">
    <thead>
      <tr class="bg-color-light-gray">
        <th class="text-sm">{{ __('messages.net_book_value') }}</th>
        <th class="text-sm text-right">{{ __('messages.opening_balance') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm text-right">{{ __('messages.disposal') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm text-right">{{ __('messages.closing_balance') }} ({{ getCurrencyCode() }})</th>
        <th class="text-sm">{{ __('messages.depreciation') }} {{ __('messages.rate') }}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->net_book_value_opening_balance, 2) }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->net_book_value_disposal, 2) }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->net_book_value_closing_balance, 2) }}</p></td>
          <td>
            @php
              $percentage = ($row->net_book_value_closing_balance / $row->net_book_value_opening_balance) * 100;
              $colorClass = 'green';

              if ($percentage <= 10) {
                  $colorClass = 'dark-red';
              } elseif ($percentage <= 30) {
                  $colorClass = 'red';
              } elseif ($percentage <= 50) {
                  $colorClass = 'orange';
              } elseif ($percentage <= 70) {
                  $colorClass = 'yellow';
              }
            @endphp

            <div class="progress d-flex align-items-center">
                <div class="progress-bar {{ $colorClass }} bg-success" role="progressbar" style="width:{{ $percentage }}%;"></div>
            </div> 
          </td>
        </tr>
      @endforeach
      <tr>
        <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_net_book_value_opening_balance'], 2) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_net_book_value_disposal'], 2) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($totals['total_net_book_value_closing_balance'], 2) }}</p></td>
        <td>
          @php
            $percentage = ($totals['total_net_book_value_closing_balance'] / $totals['total_net_book_value_opening_balance']) * 100;
            $colorClass = 'green';

            if ($percentage <= 10) {
                $colorClass = 'dark-red';
            } elseif ($percentage <= 30) {
                $colorClass = 'red';
            } elseif ($percentage <= 50) {
                $colorClass = 'orange';
            } elseif ($percentage <= 70) {
                $colorClass = 'yellow';
            }
          @endphp

          <div class="progress d-flex align-items-center">
              <div class="progress-bar {{ $colorClass }} bg-success" role="progressbar" style="width:{{ $percentage }}%;"></div>
          </div> 
        </td>
      </tr>
    </tbody>
  </table>
</div>