<div class="modal fade" id="SendModal" tabindex="-1" aria-labelledby="SendModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendModalLabel">{{ __('messages.send') }} {{ __('messages.quotation') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <form id="send_form" name="send_form" method="POST" action="{{ route('quotations.send') }}">
          @csrf
          <input type="hidden" id="send_id" name="send_id" value="" />
          <i class="material-icons text-info" style="font-size: 100px;">send</i>
          <p class="text-black text-md font-weight-md pt-3">Are you sure you want to send this quotation?</p>
          <p class="text-sm font-weight-md">You are sending this quotation to</p>
          <p class="text-black text-md font-weight-md" id="send_email" name="send_email" value=""></p>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
        <button id="submit_send_form" type="button" class="btn btn-primary">{{ __('messages.confirm') }}</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $('#send_form').on('submit', function(e) {
      e.preventDefault(); 
      startLoading();

      $.ajax({
          url: "{{ route('quotations.send') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
              reloadquotationTable(10,1);
              stopLoading();
              toastr.success(response.message, "Success");
          },
          error: function(xhr, status, error) {
              toastr.warning(xhr.responseText, "Warning");
          }
      });

      $('#SendModal').modal('hide');
    });

    $('#submit_send_form').on('click', function() {
        $('#send_form').submit();
    });
  </script>
@endpush