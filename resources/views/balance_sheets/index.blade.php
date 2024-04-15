@extends('layouts.template')
@section('title')
    {{ __('messages.balance_sheet') }}
@endsection

@section('style')
    <style>
        table.table-responsive th:first-child,
        table.table-responsive td:first-child,
        table.table-responsive th:nth-child(2),
        table.table-responsive td:nth-child(2) {
            width: 26%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="card my-4 mr-1">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h6 class="text-white text-capitalize ps-3">
                                {{ __('messages.balance_sheet') }}
                            </h6>
                        </div>
                        <div class="col-3 text-end pr-2 pb-h">
                            <span class="text-sm font-weight-md text-white">
                                {{ __('messages.dated_at') }} : {{ date('Y-m-d') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dt-table"></div>
        </div>
    </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      reloadBalanceSheet(getQueryParams());
    });

    // filter
    $("#submit-filter-button").on('click', function() {
        reloadBalanceSheet(getQueryParams());
    });

    // reload table
    function reloadBalanceSheet(queryParams = null) {
      $.ajax({
          url: '{{ route("balance_sheets.index") }}?' + queryParams,
          type: 'GET',
          data: { },
          success: function(data) {
              $('#dt-table').html(data.table);
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
    }
  </script>
@endsection