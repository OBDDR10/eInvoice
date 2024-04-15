<input type="hidden" id="id" name="id" value="{{ $data->id }}" />

<div class="row">
  <div class="col-md-6">
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
      <label for="entity_type" class="form-label mandatory">{{ __('messages.entity_type') }}</label>
      <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="entity_type" name="entity_type" value="{{ $data->entity_type }}" style="height: 35px; width: 100%;">
          <option value="1" {{ $data->entity_type == 1 ? 'selected' : '' }}>{{ __('messages.assets') }}</option>
          <option value="2" {{ $data->entity_type == 2 ? 'selected' : '' }}>{{ __('messages.liabilities') }}</option>
          <option value="3" {{ $data->entity_type == 3 ? 'selected' : '' }}>{{ __('messages.equity') }}</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="is_current" class="form-label mandatory">{{ __('messages.is_current') }}</label>
      <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="is_current" name="is_current" value="{{ $data->is_current }}" style="height: 35px; width: 100%;">
        <option value="1" {{ $data->is_current == 1 ? 'selected' : '' }}>{{ __('messages.true') }}</option>
        <option value="0" {{ $data->is_current == 0 ? 'selected' : '' }}>{{ __('messages.false') }}</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">{{ __('messages.description') }}</label>
      <input type="text" class="form-control-input" id="description" name="description" value="{{ $data->description }}">
    </div>

    <div class="mb-3">
      <label for="remark" class="form-label">{{ __('messages.remark') }}</label>
      <input type="text" class="form-control-input" id="remark" name="remark" value="{{ $data->remark }}">
    </div>
  </div>

  <div class="col-md-6">
      <div class="mb-3">
        <label for="date" class="form-label">{{ __('messages.entity_price_log') }}</label>
        
        <div class="table-responsive p-0 hide-scrollbar">
          <table class="table align-items-center justify-content-center mb-0">
            <thead>
              <tr class="bg-color-light-gray">
                <th class="text-sm">{{ __('messages.date') }}</th>
                <th class="text-sm text-right">{{ __('messages.price') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($price_logs as $price_log)
                <tr>
                  <td><p class="text-sm text-black font-weight-md mb-0">{{ date('Y-m-d', strtotime($price_log->date)) }}</p></td>
                  <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ $price_log->price }}</p></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>