@extends('layouts.template')
@section('title')
    {{ __('messages.financial_entity') }}
@endsection

@section('content')
    @include('financial_entities.create')
    @include('financial_entities.detail')
    @include('financial_entities.edit')
    @include('financial_entities.delete')

    <div class="container-fluid py-2">
        <div class="card my-4 mr-1">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-white text-capitalize ps-3">
                                {{ __('messages.financial_entity') }}
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
                      <th class="text-sm sortable" data-column="name">{{ __('messages.name') }}</th>
                      <th class="text-sm sortable" data-column="entity_type">{{ __('messages.entity_type') }}</th>
                      <th class="text-sm sortable" data-column="is_current">{{ __('messages.is_current') }}</th>
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
        reloadFinancialEntityTable(entries,page,getQueryParams());

        // change entry
        $('#entries').on('change', function() {
            var entries = $(this).val();
            reloadFinancialEntityTable(entries,1,getQueryParams(sorting));
        });

        // pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            reloadFinancialEntityTable(entries,page,getQueryParams(sorting));
        });
    });

    // filter
    $("#submit-filter-button").on('click', function() {
        reloadFinancialEntityTable(10,1,getQueryParams());
    });
    
    // sorting
    $(".sortable").on('click', function() {
        sortObj = onSorting($(this));
        sorting.sortBy = sortObj.sortBy;
        sorting.sortDir = sortObj.sortDir;

        reloadFinancialEntityTable(entries,page,getQueryParams(sortObj));
    });

    // reload table
    function reloadFinancialEntityTable(entries, page = 1, queryParams = null) {
      $.ajax({
          url: '{{ route("financial_entities.index") }}?' + queryParams,
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
            url: '{{ route("financial_entities.show") }}',
            type: 'GET',
            data: { id: data_id },
            success: function(data) {
                $('#financial_entity_detail_modal').html(data.modal);
                console.log(data.modal);
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
            url: '{{ route("financial_entities.show") }}',
            type: 'GET',
            data: { id: data_id },
            success: function(data) {
                $('#financial_entity_edit_modal').html(data.modal);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
  </script>

  @stack('scripts')
@endsection