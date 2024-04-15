@extends('layouts.template')
@section('title')
    {{ __('messages.dashboard') }}
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="card my-4 mr-1">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h6 class="text-white text-capitalize ps-3">
                                {{ __('messages.dashboard') }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection