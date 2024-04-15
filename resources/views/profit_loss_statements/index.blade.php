@extends('layouts.template')
@section('title')
    {{ __('messages.profit_loss_statement') }}
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="card my-4 mr-1">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h6 class="text-white text-capitalize ps-3">
                                {{ __('messages.profit_loss_statement') }}
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

            <div class="card-body px-0 pb-2 table-padding">
              <div id="dt-table"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
          reloadProfitLossStatement(getQueryParams());
      });

      // filter
        $("#submit-filter-button").on('click', function() {
            reloadProfitLossStatement(getQueryParams());
        });

      // reload table
      function reloadProfitLossStatement(queryParams = null) {
          $.ajax({
              url: '{{ route("profit_loss_statements.index") }}?' + queryParams,
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