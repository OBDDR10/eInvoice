<div class="card-body px-0 pb-2 table-padding">
  <div class="table-responsive p-0 hide-scrollbar">
    <table class="table table-responsive align-items-center justify-content-center mb-0">
      <thead>
        <tr class="bg-color-light-gray">
          <th class="text-sm">{{ __('messages.assets') }}</th>
          <th class="text-sm"></th>
          <th class="text-sm text-right">2024</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.current') }}</p></td>
          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_current_assets'], 2) }}</p></td>
        </tr>
        <tr>
          <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.account') }} {{ __('messages.receivable') }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($totals['account_receivable'], 2) }}</p></td>
        </tr>
        
        @foreach($data as $row)
          @if($row->entity_type == 1 && $row->is_current == 1)
            <tr>
              <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
              <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
              <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->latest_price, 2) }}</p></td>
            </tr>
          @endif
        @endforeach

        <tr>
          <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.non') }}-{{ __('messages.current') }}</p></td>
          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_non_current_assets'], 2) }}</p></td>
        </tr>

        @foreach($fixed_assets as $row)
          <tr>
            <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
            <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
            <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->total_net_book_value, 2) }}</p></td>
          </tr>
        @endforeach
        
        @foreach($data as $row)
          @if($row->entity_type == 1 && $row->is_current == 0)
            <tr>
              <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
              <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
              <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->latest_price, 2) }}</p></td>
            </tr>
          @endif
        @endforeach

        <tr class="border-top-dark-2">
          <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.total') }} {{ __('messages.assets') }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_assets'], 2) }}</p></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="table-responsive p-0 pt-2 hide-scrollbar">
    <table class="table table-responsive align-items-center justify-content-center mb-0">
      <thead>
        <tr class="bg-color-light-gray">
          <th class="text-sm">{{ __('messages.liabilities') }}</th>
          <th class="text-sm"></th>
          <th class="text-sm text-right">2024</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.current') }}</p></td>
          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_current_liabilities'], 2) }}</p></td>
        </tr>
        <tr>
          <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.account') }} {{ __('messages.payable') }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($totals['account_payable'], 2) }}</p></td>
        </tr>
        
        @foreach($data as $row)
          @if($row->entity_type == 2 && $row->is_current == 1)
            <tr>
              <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
              <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
              <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->latest_price, 2) }}</p></td>
            </tr>
          @endif
        @endforeach

        <tr>
          <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.non') }}-{{ __('messages.current') }}</p></td>
          <td><p class="text-sm text-black font-weight-md mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_non_current_liabilities'], 2) }}</p></td>
        </tr>
        
        @foreach($data as $row)
          @if($row->entity_type == 2 && $row->is_current == 0)
            <tr>
              <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
              <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
              <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->latest_price, 2) }}</p></td>
            </tr>
          @endif
        @endforeach

        <tr class="border-top-dark-2">
          <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.total') }} {{ __('messages.liabilities') }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_liabilities'], 2) }}</p></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="table-responsive p-0 pt-2 hide-scrollbar">
    <table class="table table-responsive align-items-center justify-content-center mb-0">
      <thead>
        <tr class="bg-color-light-gray">
          <th class="text-sm">{{ __('messages.shareholder') }} {{ __('messages.equity') }}</th>
          <th class="text-sm"></th>
          <th class="text-sm text-right">2024</th>
        </tr>
      </thead>
      <tbody>
        
        @foreach($data as $row)
          @if($row->entity_type == 3)
            <tr>
              <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
              <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
              <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->latest_price, 2) }}</p></td>
            </tr>
          @endif
        @endforeach

        <tr>
          <td><p class="text-sm text-black font-weight-bold mb-0"></p></td>
          <td><p class="text-sm text-black font-weight-md mb-0">Retained Earnings</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($totals['retained_earnings'], 2) }}</p></td>
        </tr>

        <tr class="border-top-dark-2">
          <td>
            <p class="text-sm text-black font-weight-bold mb-0">
                {{ __('messages.total') }} {{ __('messages.shareholder') }} {{ __('messages.equity') }}
            </p>
          </td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_shareholder_equity'], 2) }}</p></td>
        </tr>

        <tr class="border-top-dark-2">
          <td>
            <p class="text-sm text-black font-weight-bold mb-0">
                {{ __('messages.total') }} {{ __('messages.liabilities') }} &
                {{ __('messages.shareholder') }} {{ __('messages.equity') }}
            </p>
          </td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0"></p></td>
          <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_assets'], 2) }}</p></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>