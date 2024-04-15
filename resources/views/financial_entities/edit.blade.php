<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.edit') }} {{ __('messages.financial_entity') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="financial_entity_edit_form" name="financial_entity_edit_form" method="POST" action="{{ route('financial_entities.update') }}">
          @csrf
          <div id="financial_entity_edit_modal"></div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.discard') }}</button>
        <button id="submit_edit_form" type="button" class="btn btn-primary">{{ __('messages.update') }}</button>
        <button type="button" class="btn btn-info">
          <a href="../entity_price_log" class="text-white">
            {{ __('messages.update') }} {{ __('messages.entity_price_log') }}
          </a>
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $('#financial_entity_edit_form').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
          url: "{{ route('financial_entities.update') }}",
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

      $('#EditModal').modal('hide');
    });

    $('#submit_edit_form').on('click', function() {
        $('#financial_entity_edit_form').submit();
    });

    function resetField() {
      $('#name').val('');
      $('#description').val('');
      $('#remark').val('');
    }
  </script>
@endpush