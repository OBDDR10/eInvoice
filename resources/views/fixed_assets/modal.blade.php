<input type="hidden" id="id" name="id" value="{{ $data->id }}" />

<div class="mb-3">
  <label for="company_id" class="form-label mandatory">{{ __('messages.company') }}</label>
  <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="company_id" name="company_id" value="{{ $data->company_id }}" style="height: 35px; width: 100%;">
    @foreach(getCompanies() as $company)
      <option value="{{ $company->id }}" {{ $data->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="name" class="form-label mandatory">{{ __('messages.name') }}</label>
  <input type="text" class="form-control-input" id="name" name="name" value="{{ $data->name }}">
</div>

<div class="mb-3">
  <div class="form-group-date">
    <label for="purchase_date" class="form-label mandatory">{{ __('messages.purchase_date') }}</label>
    <div class="date-calendar-container">
        <input class="form-control-date" type="text" id="purchase_date" name="purchase_date" value="{{ date('Y-m-d', strtotime($data->purchase_date)) }}" onclick="openCalendar(this);" />
        <div id="date-calendar-container" class="calendar-container"></div>
    </div>
  </div>
</div>

<div class="mb-3">
  <label for="purchase_price" class="form-label mandatory">{{ __('messages.purchase_price') }}</label>
  <input type="number" class="form-control-input" id="purchase_price" name="purchase_price" value="{{ $data->purchase_price }}">
</div>

<div class="mb-3">
  <label for="depreciation" class="form-label mandatory">{{ __('messages.depreciation') }}</label>
  <input type="number" class="form-control-input" id="depreciation" name="depreciation" value="{{ $data->depreciation }}">
</div>

<div class="mb-3">
  <label for="net_book_value" class="form-label mandatory">{{ __('messages.net_book_value') }}</label>
  <input type="number" class="form-control-input" id="net_book_value" name="net_book_value" value="{{ $data->net_book_value }}">
</div>

<div class="mb-3">
  <label for="useful_life" class="form-label">{{ __('messages.useful_life') }}</label>
  <input type="number" class="form-control-input" id="useful_life" name="useful_life" value="{{ $data->useful_life }}">
</div>