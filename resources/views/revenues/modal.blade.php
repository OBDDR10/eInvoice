<input type="hidden" id="id" name="id" value="{{ $data->id }}" />

<div class="mb-3">
  <div class="form-group-date">
    <label for="date" class="form-label mandatory">{{ __('messages.date') }}</label>
    <div class="date-calendar-container">
        <input class="form-control-date" type="text" id="date" name="date" value="{{ date('Y-m-d', strtotime($data->date)) }}" onclick="openCalendar(this);" />
        <div id="date-calendar-container" class="calendar-container"></div>
    </div>
  </div>
</div>

<div class="mb-3">
  <label for="company_id" class="form-labe mandatory">{{ __('messages.company') }}</label>
  <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="company_id" name="company_id" value="{{ $data->company_id }}" style="height: 35px; width: 100%;">
    @foreach(getCompanies() as $company)
      <option value="{{ $company->id }}" {{ $data->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="sales_type" class="form-labe mandatory">{{ __('messages.sales_type') }}</label>
  <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="sales_type" name="sales_type" value="{{ $data->sales_type }}" style="height: 35px; width: 100%;">
      <option value="1" {{ $data->sales_type == 1 ? 'selected' : '' }}>{{ __('messages.product') }}</option>
      <option value="2" {{ $data->sales_type == 2 ? 'selected' : '' }}>{{ __('messages.service') }}</option>
      <option value="3" {{ $data->sales_type == 3 ? 'selected' : '' }}>{{ __('messages.other') }}</option>
  </select>
</div>

<div class="mb-3">
  <label for="sales_name" class="form-label mandatory">{{ __('messages.sales_name') }}</label>
  <input type="text" class="form-control-input" id="sales_name" name="sales_name" value="{{ $data->sales_name }}">
</div>

<div class="mb-3">
  <label for="sales_amount" class="form-label mandatory">{{ __('messages.sales_amount') }}</label>
  <input type="number" class="form-control-input" id="sales_amount" name="sales_amount" value="{{ $data->sales_amount }}">
</div>

<div class="mb-3">
  <label for="cost_of_sales" class="form-label mandatory">{{ __('messages.cost_of_sales') }}</label>
  <input type="number" class="form-control-input" id="cost_of_sales" name="cost_of_sales" value="{{ $data->cost_of_sales }}">
</div>

<div class="mb-3">
  <label for="description" class="form-label">{{ __('messages.description') }}</label>
  <input type="text" class="form-control-input" id="description" name="description" value="{{ $data->description }}">
</div>

<div class="mb-3">
  <label for="remark" class="form-label">{{ __('messages.remark') }}</label>
  <input type="text" class="form-control-input" id="remark" name="remark" value="{{ $data->remark }}">
</div>