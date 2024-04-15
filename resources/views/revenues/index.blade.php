@extends('layouts.template')
@section('title')
    {{ __('messages.revenue') }}
@endsection

@section('content')
    @include('revenues.create')
    @include('revenues.detail')
    @include('revenues.edit')
    @include('revenues.delete')

    <div class="container-fluid py-2">
        <div class="card my-4 mr-1">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-white text-capitalize ps-3">
                                {{ __('messages.revenue') }}
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
                      <th class="text-sm sortable" data-column="date">{{ __('messages.date') }}</th>
                      <th class="text-sm sortable" data-column="sales_type">{{ __('messages.sales_type') }}</th>
                      <th class="text-sm sortable" data-column="sales_name">{{ __('messages.sales_name') }}</th>
                      <th class="text-sm sortable text-right" data-column="sales_amount">{{ __('messages.sales_amount') }} ({{ getCurrencyCode() }})</th>
                      <th class="text-sm sortable text-right" data-column="cost_of_sales">{{ __('messages.cost_of_sales') }} ({{ getCurrencyCode() }})</th>
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
        reloadRevenueTable(entries,page,getQueryParams());

        // change entry
        $('#entries').on('change', function() {
            var entries = $(this).val();
            reloadRevenueTable(entries,1,getQueryParams(sorting));
        });

        // pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            reloadRevenueTable(entries,page,getQueryParams(sorting));
        });
    });

    // filter
    $("#submit-filter-button").on('click', function() {
        reloadRevenueTable(10,1,getQueryParams());
    });

    // sorting
    $(".sortable").on('click', function() {
        sortObj = onSorting($(this));
        sorting.sortBy = sortObj.sortBy;
        sorting.sortDir = sortObj.sortDir;

        reloadRevenueTable(entries,page,getQueryParams(sortObj));
    });

    // reload table
    function reloadRevenueTable(entries, page = 1, queryParams = null) {
      $.ajax({
          url: '{{ route("revenues.index") }}?' + queryParams,
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
            url: '{{ route("revenues.show") }}',
            type: 'GET',
            data: { id: 0 },
            success: function(data) {
                $('#revenue_create_modal').html(data.modal);
            },
            error: function(xhr, status, error) {
                console.error(error);
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
            url: '{{ route("revenues.show") }}',
            type: 'GET',
            data: { id: data_id },
            success: function(data) {
                $('#revenue_detail_modal').html(data.modal);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // edit
    $('#EditModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data_id = button.closest('tr').data('row-id');
        var modal = $(this);

        $.ajax({
            url: '{{ route("revenues.show") }}',
            type: 'GET',
            data: { id: data_id },
            success: function(data) {
                $('#revenue_edit_modal').html(data.modal);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
  </script>

  @stack('scripts')
@endsection