<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.delete') }} {{ __('messages.revenue') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <form id="revenue_delete_form" name="revenue_delete_form" method="POST" action="{{ route('revenues.destroy') }}">
          @csrf
          <input type="hidden" id="id" name="id" value="" />
          <i class="material-icons text-danger" style="font-size: 100px;">cancel</i>
          <p class="text-black text-md font-weight-md pt-3">Are you sure you want to delete this item?</p>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
        <button id="submit_delete_form" type="button" class="btn btn-primary">{{ __('messages.confirm') }}</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $('#revenue_delete_form').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
          url: "{{ route('revenues.destroy') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
              reloadRevenueTable(10,1);
              toastr.success(response.message, "Success");
          },
          error: function(xhr, status, error) {
              toastr.warning(xhr.responseText, "Warning");
          }
      });

      $('#DeleteModal').modal('hide');
    });

    $('#submit_delete_form').on('click', function() {
        $('#revenue_delete_form').submit();
    });
  </script>
@endpush