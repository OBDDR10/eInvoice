<input type="hidden" id="id" name="id" value="{{ $data->id }}" />

<div class="mb-3" id="ref_no_group">
  <label for="name" class="form-label">{{ __('messages.ref_no') }}</label>
  <input readonly type="text" class="form-control-input" value="{{ $data->ref_no }}">
</div>

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
  <label for="receiving_company_id" class="form-label mandatory">{{ __('messages.receiving_company') }}</label>
  <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="receiving_company_id" name="receiving_company_id" value="{{ $data->receiving_company_id }}" style="height: 35px; width: 100%;">
    @foreach(getCompanies() as $company)
      <option value="{{ $company->id }}" {{ $data->receiving_company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="paying_company_id" class="form-label mandatory">{{ __('messages.paying_company') }}</label>
  <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="paying_company_id" name="paying_company_id" value="{{ $data->paying_company_id }}" style="height: 35px; width: 100%;">
    @foreach(getCompanies() as $company)
      <option value="{{ $company->id }}" {{ $data->paying_company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="name" class="form-label mandatory">{{ __('messages.name') }}</label>
  <input type="text" class="form-control-input" id="name" name="name" value="{{ $data->product_service_name }}">
</div>

<div class="mb-3">
  <label for="description" class="form-label">{{ __('messages.description') }}</label>
  <input type="text" class="form-control-input" id="description" name="description" value="{{ $data->description }}">
</div>

<div class="mb-3">
  <label for="amount_payable" class="form-label mandatory">{{ __('messages.amount_payable') }}</label>
  <input type="number" class="form-control-input" id="amount_payable" name="amount_payable" value="{{ $data->amount_payable }}">
</div>

<div class="mb-3">
  <label for="amount_paid" class="form-label">{{ __('messages.amount_paid') }}</label>
  <input type="number" class="form-control-input" id="amount_paid" name="amount_paid" value="{{ $data->amount_paid }}">
</div>

<div class="mb-3">
  <label for="remark" class="form-label">{{ __('messages.remark') }}</label>
  <input type="text" class="form-control-input" id="remark" name="remark" value="{{ $data->remark }}">
</div>