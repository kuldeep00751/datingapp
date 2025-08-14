@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-danger text-white">
            <h3 class="card-title">@lang('messages.account_rejected_1')</h3>
          </div>
          <div class="card-body">
            <h4 class="text-center">@lang('messages.account_rejected_2')</h4>
            <div class="alert alert-danger mt-4" role="alert">
              <strong>@lang('messages.account_rejected_3')</strong> @lang('messages.account_rejected_4')
            </div>

            <div class="text-center mt-4">
              <a href="{{ url('home') }}" class="btn btn-primary">@lang('messages.account_rejected_5')</a>
              <a href="{{ url('contact') }}" class="btn btn-warning ms-2">@lang('messages.account_rejected_6')</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

