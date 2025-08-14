@extends('admin.layouts.master')

@section('content')
    <div class="container py-4 px-9 mb-6">
        <div class="card">
            <div class="card-header pb-3 px-3">
                <h6 class="mb-0">Add Legal Content</h6>
            </div>
            <form action="{{ route('legal-contents.store') }}" method="POST">
                @csrf
                <div class="card-body pt-4 p-3">
                    @include('admin.legal_contents._form')
                </div>
            </form>
        </div>
    </div>
@endsection