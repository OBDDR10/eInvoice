<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.edit') }} {{ __('messages.entity_price_log') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="entity_price_log_edit_form" name="entity_price_log_edit_form" method="POST" action="{{ route('entity_price_logs.update') }}">
          @csrf
          <div id="entity_price_log_edit_modal"></div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.discard') }}</button>
        <button id="submit_edit_form" type="button" class="btn btn-primary">{{ __('messages.update') }}</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $('#entity_price_log_edit_form').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
          url: "{{ route('entity_price_logs.update') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
              resetField();
              reloadEntityPriceLogTable(entries,page,getQueryParams(sorting));
              toastr.success(response.message, "Success");
          },
          error: function(xhr, status, error) {
              toastr.warning(xhr.responseText, "Warning");
          }
      });

      $('#EditModal').modal('hide');
    });

    $('#submit_edit_form').on('click', function() {
        $('#entity_price_log_edit_form').submit();
    });

    function resetField() {
      $('#price').val('');
    }
  </script>
@endpush