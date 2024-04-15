<input type="hidden" id="id" name="id" value="{{ $data->id }}" />
<input type="hidden" id="financial_entity_id" name="financial_entity_id" value="{{ $data->financial_entity_id }}" />

<div class="mb-3">
  <label for="company_id" class="form-label mandatory">{{ __('messages.company') }}</label>
  <select disabled class="form-control bg-gradient-primary text-white p-2 pt-1" id="company_id" name="company_id" value="{{ $data->company_id }}" style="height: 35px; width: 100%;">
    @foreach(getCompanies() as $company)
      <option value="{{ $company->id }}" {{ $data->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label for="entity_name" class="form-label mandatory">{{ __('messages.financial_entity') }}</label>
  <input disabled type="text" class="form-control-input" id="entity_name" name="entity_name" value="{{ $data->entity_name }}">
</div>

<div class="mb-3">
  <label for="entity_type" class="form-label mandatory">{{ __('messages.entity_type') }}</label>
  <select disabled class="form-control bg-gradient-primary text-white p-2 pt-1" id="entity_type" name="entity_type" value="{{ $data->entity_type }}" style="height: 35px; width: 100%;">
      <option value="1" {{ $data->entity_type == 1 ? 'selected' : '' }}>{{ __('messages.assets') }}</option>
      <option value="2" {{ $data->entity_type == 2 ? 'selected' : '' }}>{{ __('messages.liabilities') }}</option>
      <option value="3" {{ $data->entity_type == 3 ? 'selected' : '' }}>{{ __('messages.equity') }}</option>
  </select>
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
  <label for="price" class="form-label mandatory">{{ __('messages.price') }}</label>
  <input type="number" class="form-control-input" id="price" name="price" value="{{ $data->price }}">
</div>