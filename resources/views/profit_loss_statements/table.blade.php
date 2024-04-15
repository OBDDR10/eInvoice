<div class="table-responsive p-0 hide-scrollbar">
  <table class="table align-items-center justify-content-center mb-0">
    <thead>
      <tr class="bg-color-light-gray">
        <th class="text-sm">{{ __('messages.revenue') }}</th>
        <th class="text-sm text-right">2024</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $row)
        <tr>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->sales_type_text }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->total_sales_amount, 2) }}</p></td>
        </tr>
      @endforeach
      
      <tr>
        <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.total_net_sales') }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_net_sales'], 2) }}</p></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="table-responsive p-0 pt-1 hide-scrollbar">
  <table class="table align-items-center justify-content-center mb-0">
    <thead>
      <tr class="bg-color-light-gray">
        <th class="text-sm">{{ __('messages.cost_of_sales') }}</th>
        <th class="text-sm text-right">2024</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $row)
        <tr>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->sales_type_text }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($row->total_cost_of_sales, 2) }}</p></td>
        </tr>
      @endforeach

      <tr>
        <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.total_cost_of_sales') }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_cost_of_sales'], 2) }}</p></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="table-responsive p-0 pt-1 hide-scrollbar">
  <table class="table align-items-center justify-content-center mb-0">
    <thead>
      <tr class="bg-color-light-gray">
        <th class="text-sm">{{ __('messages.operation') }} {{ __('messages.expense') }}</th>
        <th class="text-sm text-right">2024</th>
      </tr>
    </thead>
    <tbody>
      @foreach($operations as $operation)
        <tr>
          <td><p class="text-sm text-black font-weight-md mb-0">{{ $operation->name }}</p></td>
          <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($operation->total_amount, 2) }}</p></td>
        </tr>
      @endforeach
      
      <tr>
        <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.total') }} {{ __('messages.operation') }} {{ __('messages.expense') }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['total_operation_expenses'], 2) }}</p></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="table-responsive p-0 pt-1 hide-scrollbar">
  <table class="table align-items-center justify-content-center mb-0">
    <thead>
      <tr class="bg-color-light-gray">
        <th class="text-sm">{{ __('messages.earnings') }}</th>
        <th class="text-sm text-right">2024</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.income_before_tax') }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($totals['income_before_tax'], 2) }}</p></td>
      </tr>
      <tr>
        <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.tax_rate') }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ $totals['tax_rate'] }}%</p></td>
      </tr>
      <tr>
        <td><p class="text-sm text-black font-weight-md mb-0">{{ __('messages.tax_paid') }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ getCurrencyCode() }} {{ number_format($totals['tax_paid'], 2) }}</p></td>
      </tr>
      <tr>
        <td><p class="text-sm text-black font-weight-bold mb-0">{{ __('messages.net_income') }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ getCurrencyCode() }} {{ number_format($totals['net_income'], 2) }}</p></td>
      </tr>
    </tbody>
  </table>
</div>