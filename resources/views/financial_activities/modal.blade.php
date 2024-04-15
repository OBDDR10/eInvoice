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
  <label for="activity_type" class="form-label mandatory">{{ __('messages.activity_type') }}</label>
  <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="activity_type" name="activity_type" value="{{ $data->activity_type }}" style="height: 35px; width: 100%;">
      <option value="1" {{ $data->activity_type == 1 ? 'selected' : '' }}>{{ __('messages.operation') }}</option>
      <option value="2" {{ $data->activity_type == 2 ? 'selected' : '' }}>{{ __('messages.investing') }}</option>
      <option value="3" {{ $data->activity_type == 3 ? 'selected' : '' }}>{{ __('messages.financing') }}</option>
  </select>
</div>

<div class="mb-3">
  <label for="action_type" class="form-label mandatory">{{ __('messages.action_type') }}</label>
  <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="action_type" name="action_type" value="{{ $data->action_type }}" style="height: 35px; width: 100%;">
      <option value="1" {{ $data->action_type == 1 ? 'selected' : '' }}>{{ __('messages.received_from') }}</option>
      <option value="2" {{ $data->action_type == 2 ? 'selected' : '' }}>{{ __('messages.paid_for') }}</option>
  </select>
</div>

<div class="mb-3">
  <label for="description" class="form-label">{{ __('messages.description') }}</label>
  <input type="text" class="form-control-input" id="description" name="description" value="{{ $data->description }}">
</div>

<div class="mb-3">
  <label for="amount" class="form-label mandatory">{{ __('messages.amount') }}</label>
  <input type="number" class="form-control-input" id="amount" name="amount" value="{{ $data->amount }}">
</div>

<div class="mb-3">
  <label for="remark" class="form-label">{{ __('messages.remark') }}</label>
  <input type="text" class="form-control-input" id="remark" name="remark" value="{{ $data->remark }}">
</div>