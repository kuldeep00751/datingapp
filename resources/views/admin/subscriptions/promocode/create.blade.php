@extends('admin.layouts.master')

@section('content')
    <div class="container py-4 px-9 mb-6">
        <div class="card">
            <div class="card-header pb-3 px-3">
                <h6 class="mb-0">Create Promo code</h6>
            </div>
            <form action="{{ route('admin.promocode.store') }}" method="POST">
            @csrf
            <div class="card-body pt-4 p-3">
                @include ('admin.subscriptions.promocode.form', [
                'promocode' => [],
                ])
            </div>
            <div class="card-footer pt-3 p-2">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{route('admin.promocode.index')}}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
