@extends('layouts.template')
@section('title')
    {{ __('messages.quotation') }}
@endsection

@section('style')
    <style>
        .table.quotation-table th,
        .table.quotation-table td {
            padding-left: .3rem!important;
            padding-right: .3rem!important;
        }

        .table.quotation-table th:first-child,
        .table.quotation-table td:first-child {
            width: 50%;
        }

        .table.quotation-table th:nth-child(2),
        .table.quotation-table td:nth-child(2) {
            width: 10%;
        }

        .table.quotation-table th:nth-child(3),
        .table.quotation-table td:nth-child(3),
        .table.quotation-table th:nth-child(4),
        .table.quotation-table td:nth-child(4) {
            width: 20%;
        }
    </style>
@endsection

@section('content')
    @include('quotations.create')
    @include('quotations.show')
    @include('quotations.delete')
    @include('quotations.send')

    <div id="loading" class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="container-fluid py-2 pt-3">
        <div class="card my-4 mr-1">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                <div class="row align-items-center">
                      <div class="col">
                          <h6 class="text-white text-capitalize ps-3">
                              {{ __('messages.quotation') }}
                          </h6>
                      </div>
                      <div class="col-auto text-end pr-2 pb-1">
                          <div class="d-flex align-items-center justify-content-end">
                              <div class="form-group mb-0 mr-1 d-flex align-items-center">
                                  <label for="entries" class="ml-1 mr-1 mb-0 text-white">{{ __('messages.show_entry') }}</label>
                                  <select class="form-control border-white text-white p-2 pt-1" id="entries" name="entries" style="height: 35px; width: 35px;">
                                      <option value="10">10</option>
                                      <option value="25">25</option>
                                      <option value="50">50</option>
                                  </select>
                              </div>
                              <button class="btn btn-outline-white p-sm-btn" data-bs-toggle="modal" data-bs-target="#CreateModal">{{ __('messages.create') }}</button>    
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <div class="card-body px-0 pb-2 table-padding">
              <div class="table-responsive p-0 hide-scrollbar">
                <table id="dt-table" class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr class="bg-color-light-gray">
                      <th class="text-sm sortable" data-column="issued_date">{{ __('messages.issued_date') }}</th>
                      <th class="text-sm sortable" data-column="quotation_no">{{ __('messages.quotation_no') }}</th>
                      <th class="text-sm sortable" data-column="client_name">{{ __('messages.company_name') }}</th>
                      <th class="text-sm sortable text-right" data-column="total">{{ __('messages.total') }} ({{ getCurrencyCode() }})</th>
                      <th class="text-sm sortable text-center" data-column="status">{{ __('messages.status') }}</th>
                      <th class="text-sm">{{ __('messages.action') }}</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>

              <div id="pagination-container" class="d-flex justify-content-end pt-4"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
        reloadquotationTable(entries,page,getQueryParams());

        // change entry
        $('#entries').on('change', function() {
            var entries = $(this).val();
            reloadquotationTable(entries,1,getQueryParams(sorting));
        });

        // pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            reloadquotationTable(entries,page,getQueryParams(sorting));
        });
    });

    // filter
    // $("#submit-filter-button").on('click', function() {
    //     reloadquotationTable(10,1,getQueryParams());
    // });

    // sorting
    $(".sortable").on('click', function() {
        sortObj = onSorting($(this));
        sorting.sortBy = sortObj.sortBy;
        sorting.sortDir = sortObj.sortDir;

        reloadquotationTable(entries,page,getQueryParams(sortObj));
    });

    // reload table
    function reloadquotationTable(entries, page = 1, queryParams = null) {
      $.ajax({
          url: '{{ route("quotations.index") }}?' + queryParams,
          type: 'GET',
          data: { entries: entries, page: page },
          success: function(data) {
              $('#dt-table tbody').html(data.table);
              $('#pagination-container').html(data.pagination);
              changePage(page);
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
    }

    // create
    $('#CreateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        $.ajax({
            url: '{{ route("quotations.show") }}',
            type: 'GET',
            data: { id: 0 },
            success: function(data) {
                $('#quotation_create_modal').html(data.modal);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // delete
    $('#DeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.closest('tr').data('row-id');
        var modal = $(this);
        $('#id').val(data_id);
    });

    // detail
    $('#DetailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.closest('tr').data('row-id');
        var modal = $(this);

        $.ajax({
            url: '{{ route("quotations.show") }}',
            type: 'GET',
            data: { id: data_id },
            success: function(data) {
                $('#quotation_detail_modal').html(data.modal);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // edit
    // $('#EditModal').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget);
    //     var data_id = button.closest('tr').data('row-id');
    //     var modal = $(this);

    //     $.ajax({
    //         url: '{{ route("quotations.show") }}',
    //         type: 'GET',
    //         data: { id: data_id },
    //         success: function(data) {
    //             $('#quotation_edit_modal').html(data.modal);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(error);
    //         }
    //     });
    // });

    // send
    $('#SendModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.closest('tr').data('row-id');
        var data_email = button.closest('tr').data('row-email');
        var modal = $(this);
        $('#send_id').val(data_id);
        $('#send_email').val(data_email);
        $('#send_email').html(data_email);
    });

    // export
    function exportPDF(id)
    {
        $.ajax({
            url: '{{ route("quotations.export") }}',
            type: 'GET',
            data: { id: id },
            success: function(data) {
                //Create a hidden form
                var form = document.createElement('form');
                form.action = '{{ route("quotations.export") }}';
                form.method = 'GET';

                // Create an input field for the quotation ID
                var quotationIdInput = document.createElement('input');
                quotationIdInput.type = 'hidden';
                quotationIdInput.name = 'id';
                quotationIdInput.value = id;

                // Append the input field to the form
                form.appendChild(quotationIdInput);

                // Create a hidden iframe to receive the PDF download
                var iframe = document.createElement('iframe');
                iframe.style.display = 'none';

                // Append the form and iframe to the document body
                document.body.appendChild(form);
                document.body.appendChild(iframe);

                // Set the target of the form to the hidden iframe
                form.target = iframe.name = 'hiddenframe';

                // Submit the form
                form.submit();

                // Remove the form and iframe after submission
                setTimeout(function() {
                    document.body.removeChild(form);
                    document.body.removeChild(iframe);
                }, 5000);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
  </script>

  @stack('scripts')
@endsection