<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="invoiceModalLabel">{{ __('messages.create') }} {{ __('messages.invoice') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" style="padding-top: 10px; padding-bottom: 5px;">
        <form  id="invoice_create_form" name="invoice_create_form" method="POST" action="{{ route('invoices.store') }}">
          @csrf
          <div id="invoice_create_modal"></div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
        <button id="submit_create_form" type="button" class="btn btn-primary mb-0">{{ __('messages.create') }}</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $('#invoice_create_form').on('submit', function(e) {
      e.preventDefault(); 
      $.ajax({
          url: "{{ route('invoices.store') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
              resetField();
              reloadInvoiceTable(entries,page,getQueryParams(sorting));
              toastr.success(response.message, "Success");
          },
          error: function(xhr, status, error) {
              toastr.warning(xhr.responseText, "Warning");
          }
      });

      $('#CreateModal').modal('hide');
    });

    $('#submit_create_form').on('click', function() {
        $('#invoice_create_form').submit();
    });

    function resetField() {
      $('#client_name').val('');
      $('#client_email').val('');
      $('#client_address_1').val('');
      $('#client_address_2').val('');
      $('#client_address_3').val('');
    }

    // invoice details
    function AddRow() {
      var tbody = document.querySelector('.invoice-table tbody');
      var newRow = document.createElement('tr');

      newRow.innerHTML = `
        <td><input class="table-input description" type="text" name="description[]" value=""></td>
        <td><input class="table-input quantity text-center" type="number" name="quantity[]" oninput="calculateAmounts()" value=""></td>
        <td><input class="table-input unit_price text-right" type="number" name="unit_price[]" oninput="calculateAmounts()" value=""></td>
        <td><input class="table-input amount text-right" type="text" name="amount[]" value="" readonly></td>
      `;
      tbody.appendChild(newRow);
    }

    function calculateAmounts() {
      var rows = document.querySelectorAll('.invoice-table tbody tr');
      var totalAmount = 0;
      
      rows.forEach(function(row) {
          var unitPriceInput = row.querySelector('.unit_price');
          var quantityInput = row.querySelector('.quantity');
          var amountInput = row.querySelector('.amount');
          
          var unitPrice = parseFloat(unitPriceInput.value);
          var quantity = parseFloat(quantityInput.value);
          var amount = unitPrice * quantity;
          
          amountInput.value = isNaN(amount) ? 0 : amount.toFixed(2);
          totalAmount += amount;
      });

      $('#total_amount').val(totalAmount);
    }
  </script>
@endpush