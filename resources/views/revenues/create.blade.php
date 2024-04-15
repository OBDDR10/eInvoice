<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.create') }} {{ __('messages.revenue') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form  id="revenue_create_form" name="revenue_create_form" method="POST" action="{{ route('revenues.store') }}">
          @csrf
          <div id="revenue_create_modal"></div>
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
    $('#revenue_create_form').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
          url: "{{ route('revenues.store') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
              resetField();
              reloadRevenueTable(entries,page,getQueryParams(sorting));
              toastr.success(response.message, "Success");
          },
          error: function(xhr, status, error) {
              toastr.warning(xhr.responseText, "Warning");
          }
      });

      $('#CreateModal').modal('hide');
    });

    $('#submit_create_form').on('click', function() {
        $('#revenue_create_form').submit();
    });

    function resetField() {
      $('#sales_name').val('');
      $('#description').val('');
      $('#sales_amount').val('');
      $('#cost_of_sales').val('');
      $('#remark').val('');
    }
  </script>
@endpush