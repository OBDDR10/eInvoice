<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.create') }} {{ __('messages.financial_entity') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form  id="financial_entity_create_form" name="financial_entity_create_form" method="POST" action="{{ route('financial_entities.store') }}">
          @csrf
          <div class="mb-3">
            <label for="company_id" class="form-label mandatory">{{ __('messages.company') }}</label>
            <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="company_id" name="company_id" style="height: 35px; width: 100%;">
              @foreach(getCompanies() as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="name" class="form-label mandatory">{{ __('messages.name') }}</label>
            <input type="text" class="form-control-input" id="name" name="name">
          </div>

          <div class="mb-3">
            <label for="entity_type" class="form-label mandatory">{{ __('messages.entity_type') }}</label>
            <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="entity_type" name="entity_type" style="height: 35px; width: 100%;">
                <option value="1">{{ __('messages.assets') }}</option>
                <option value="2">{{ __('messages.liabilities') }}</option>
                <option value="3">{{ __('messages.equity') }}</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="is_current" class="form-label mandatory">{{ __('messages.is_current') }}</label>
            <select class="form-control bg-gradient-primary text-white p-2 pt-1" id="is_current" name="is_current" style="height: 35px; width: 100%;">
                <option value="1">{{ __('messages.true') }}</option>
                <option value="0">{{ __('messages.false') }}</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label for="description" class="form-label">{{ __('messages.description') }}</label>
            <input type="text" class="form-control-input" id="description" name="description">
          </div>

          <div class="mb-3">
            <label for="remark" class="form-label">{{ __('messages.remark') }}</label>
            <input type="text" class="form-control-input" id="remark" name="remark">
          </div>

          <div class="mb-3">
            <div class="form-group-date">
              <label for="date" class="form-label mandatory">{{ __('messages.purchase_date') }}</label>
              <div class="date-calendar-container">
                  <input class="form-control-date" type="text" id="date" name="date" value="{{ date('Y-m-d') }}" onclick="openCalendar(this);" />
                  <div id="date-calendar-container" class="calendar-container"></div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="price" class="form-label mandatory">{{ __('messages.purchase_price') }}</label>
            <input type="number" class="form-control-input" id="price" name="price">
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
        <button id="submit_create_form" type="button" class="btn btn-primary">{{ __('messages.create') }}</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $('#financial_entity_create_form').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
          url: "{{ route('financial_entities.store') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
              resetField();
              reloadFinancialEntityTable(entries,page,getQueryParams(sorting));
              toastr.success(response.message, "Success");
          },
          error: function(xhr, status, error) {
              toastr.warning(xhr.responseText, "Warning");
          }
      });

      $('#CreateModal').modal('hide');
    });

    $('#submit_create_form').on('click', function() {
        $('#financial_entity_create_form').submit();
    });

    function resetField() {
      $('#name').val('');
      $('#description').val('');
      $('#remark').val('');
      $('#price').val('');
    }
  </script>
@endpush