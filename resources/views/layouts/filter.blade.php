<div class="fixed-filter">
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3">
            <div class="float-start">
            <h5 class="mt-3 mb-0">Filter</h5>
            </div>
            <div class="float-end mt-4">
            <button class="btn btn-link text-dark p-0 fixed-filter-close-button">
                <i class="material-icons">clear</i>
            </button>
            </div>
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <div class="form-group mb-0 ml-3">
                <label for="company_id" class="mr-1 mb-0 text-md text-black font-weight-md">{{ __('messages.select') }} {{ __('messages.company') }}</label>
                <select class="form-control bg-gradient-primary text-white mt-1 p-2 pt-1" id="company_id" style="height: 35px; width: 100%;">
                    @foreach(getCompanies() as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>

                <div class="form-group-date">
                    <label for="start_date" class="mr-1 mb-0 pt-4 text-md text-black font-weight-md">{{ __('messages.start_date') }}</label>
                    <div class="date-calendar-container">
                        <input class="form-control-date" type="text" id="start_date" name="start_date" value="{{ date('Y') }}-01-01" />
                        <div id="start-calendar-container" class="calendar-container"></div>
                    </div>
                </div>

                <div class="form-group-date">
                    <label for="end_date" class="mr-1 mb-0 pt-4 text-md text-black font-weight-md">{{ __('messages.end_date') }}</label>
                    <div class="date-calendar-container">
                        <input class="form-control-date" type="text" id="end_date" name="end_date" value="{{ date('Y') }}-12-31" />
                        <div id="end-calendar-container" class="calendar-container"></div>
                    </div>
                </div>

                <button id="submit-filter-button" class="btn btn-primary mt-6 w-100 fixed-filter-close-button">{{ __('messages.filter') }}</button>
            </div>
        </div>
    </div>
</div>