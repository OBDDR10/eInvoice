<input type="hidden" id="id" name="id" value="{{ $data->id }}" />

<div class="row">
  <div class="col-md-4">
    <div class="mb-3">
      <div class="form-group-date">
        <label for="date" class="form-label mandatory">{{ __('messages.issued_date') }}</label>
        <div class="date-calendar-container">
            <input class="form-control-date" type="text" id="issued_date" name="issued_date" value="{{ date('Y-m-d', strtotime($data->issued_date)) }}" onclick="openCalendar(this);" />
            <div id="date-calendar-container" class="calendar-container"></div>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="client_name" class="form-label mandatory">{{ __('messages.client') }} {{ __('messages.name') }}</label>
      <input type="text" class="form-control-input" id="client_name" name="client_name" value="{{ $data->client_name }}">
    </div>

    <div class="mb-3">
      <label for="client_email" class="form-label">{{ __('messages.client') }} {{ __('messages.email') }}</label>
      <input type="email" class="form-control-input" id="client_email" name="client_email" value="{{ $data->client_email }}">
    </div>

    <div class="mb-3">
      <label for="client_address_1" class="form-label">{{ __('messages.client') }} {{ __('messages.address') }} 1</label>
      <input type="text" class="form-control-input" id="client_address_1" name="client_address_1" value="{{ $data->client_address_1 }}">
    </div>

    <div class="mb-3">
      <label for="client_address_2" class="form-label">{{ __('messages.client') }} {{ __('messages.address') }} 2</label>
      <input type="text" class="form-control-input" id="client_address_2" name="client_address_2" value="{{ $data->client_address_2 }}">
    </div>

    <div class="mb-3">
      <label for="client_address_3" class="form-label">{{ __('messages.client') }} {{ __('messages.address') }} 3</label>
      <input type="text" class="form-control-input" id="client_address_3" name="client_address_3" value="{{ $data->client_address_3 }}">
    </div>

    <div class="mb-3">
      <label for="total_amount" class="form-label mandatory">{{ __('messages.total_amount') }}</label>
      <input readonly type="number" class="form-control-input" id="total_amount" name="total_amount" value="{{ $data->total_amount }}">
    </div>
  </div>

  <div class="col-md-8">
    <div class="mb-3">
      <div class="d-flex justify-content-end" style="margin-top: 0!important; margin-bottom: 0!important;">
        <button id="add_invoice_button" type="button" class="btn btn-primary" onclick="AddRow()" 
          style="font-size: 10px; padding: 5px 15px; margin-bottom: 8px!important;">
          {{ __('messages.add') }}
        </button>
      </div>

      <div class="table-responsive p-0 hide-scrollbar">
        <table class="table invoice-table align-items-center justify-content-center mb-0">
          <thead>
            <tr class="bg-color-light-gray">
              <th class="text-sm">{{ __('messages.description') }}</th>
              <th class="text-sm text-center">{{ __('messages.quantity') }}</th>
              <th class="text-sm text-right">{{ __('messages.unit_price') }}</th>
              <th class="text-sm text-right">{{ __('messages.amount') }}</th>
            </tr>
          </thead>
          <tbody>
            @if($details->count() > 0)
              @foreach($details as $detail)
                <tr>
                  <td><p class="text-sm text-black font-weight-md mb-0">{{ $detail->description }}</p></td>
                  <td><p class="text-sm text-black text-center font-weight-md mb-0">{{ $detail->quantity }}</p></td>
                  <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($detail->unit_price, 2) }}</p></td>
                  <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($detail->amount, 2) }}</p></td>
                </tr>
              @endforeach
              <tr>
                <td colspan="3"><p class="text-sm text-black text-right font-weight-bold mb-0">{{ __('messages.total') }}</p></td>
                <td><p class="text-sm text-black text-right font-weight-bold mb-0">{{ number_format($data->total_amount, 2) }}</p></td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>