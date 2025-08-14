@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid py-4">                
        <div>
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-3 px-3">
                        <h6 class="mb-0">Create Subscription Plan</h6>
                    </div>
                    <form action="{{ route('admin.subscriptions.store') }}" method="POST">
                    @csrf
                    <div class="card-body pt-4 p-3">
                        @include ('admin.subscriptions.form', [
                        'subscriptions' => $subscriptions,
                        ])
                    </div>
                    <div class="card-footer pt-3 p-2">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{route('admin.subscriptions.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
