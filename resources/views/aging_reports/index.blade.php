@extends('layouts.template')
@section('title')
    {{ __('messages.aging_report') }}
@endsection

@section('content')
    <div class="container-fluid py-2">
      <div class="card my-4 mr-1">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-white text-capitalize ps-3">
                            {{ __('messages.aging_report') }}
                        </h6>
                    </div>
                    <div class="col-auto text-end pr-2 pb-1">
                        <div class="d-flex align-items-center justify-content-end">
                            <span class="text-sm font-weight-md text-white pr-1">
                                {{ __('messages.dated_at') }} : {{ date('Y-m-d') }}
                            </span>
                            <div class="form-group mb-0 ml-3 d-flex align-items-center">
                                <label for="report_type" class="mr-1 mb-0 text-white">{{ __('messages.report') }} {{ __('messages.type') }}</label>
                                <select class="form-control border-white text-white p-2 pt-1" id="report_type" style="height: 35px; width: 125px;">
                                    <option>{{ __('messages.receivable') }}</option>
                                    <option>{{ __('messages.payable') }}</option>
                                </select>

                                <label for="entries" class="ml-1 mr-1 mb-0 text-white">{{ __('messages.show_entry') }}</label>
                                <select class="form-control border-white text-white p-2 pt-1" id="entries" name="entries" style="height: 35px; width: 35px;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body px-0 pb-2 table-padding" style="padding-top: 2rem;">
            <div id="aging-report-banner"></div>

            <div class="table-responsive p-0 pt-0">
                <table id="dt-table" class="table align-items-center justify-content-center mb-0">
                    <thead>
                        <tr class="bg-color-light-gray">
                            <th class="text-sm sortable" data-column="company_id">{{ __('messages.company') }}</th>
                            <th class="text-right sortable text-sm" data-column="current">{{ __('messages.current') }} ({{ getCurrencyCode() }})</th>
                            <th class="text-right sortable text-sm" data-column="over_one">1 - 30 {{ __('messages.day') }} ({{ getCurrencyCode() }})</th>
                            <th class="text-right sortable text-sm" data-column="over_thirty">31 - 60 {{ __('messages.day') }} ({{ getCurrencyCode() }})</th>
                            <th class="text-right sortable text-sm" data-column="over_sixty">61 - 90 {{ __('messages.day') }} ({{ getCurrencyCode() }})</th>
                            <th class="text-right sortable text-sm" data-column="over_ninety">> 90 {{ __('messages.day') }} ({{ getCurrencyCode() }})</th>
                            <th class="text-right sortable text-sm" data-column="total">{{ __('messages.total') }} ({{ getCurrencyCode() }})</th>
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
        reloadAgingReport(entries,page,getQueryParams());

        // change entry
        $('#entries').on('change', function() {
            var entries = $(this).val();
            reloadAgingReport(entries,1,getQueryParams(sorting));
        });

        // pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            reloadAgingReport(entries,page,getQueryParams(sorting));
        });
    });

    // filter
    $("#submit-filter-button").on('click', function() {
        reloadAgingReport(10,1,getQueryParams());
    });

    // sorting
    $(".sortable").on('click', function() {
        sortObj = onSorting($(this));
        sorting.sortBy = sortObj.sortBy;
        sorting.sortDir = sortObj.sortDir;

        reloadAgingReport(entries,page,getQueryParams(sortObj));
    });

    // reload table
    function reloadAgingReport(entries, page = 1, queryParams = null) {
        $.ajax({
            url: '{{ route("aging_reports.index") }}?' + queryParams,
            type: 'GET',
            data: { entries: entries, page: page },
            success: function(data) {
                $('#dt-table tbody').html(data.table);
                $('#aging-report-banner').html(data.banner);
                $('#pagination-container').html(data.pagination);
                changePage(page);
            },
            error: function(xhr, status, error) {
                console.error(error);
                console.log(xhr.responseText);
            }
        });
    }
  </script>
@endsection
