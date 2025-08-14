@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid py-4">                
        <div>
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-3 px-3">
                        <h6 class="mb-0">Edit Legal Content</h6>
                    </div>
                    <form method="POST" action="{{ route('legal-contents.update', $content->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body pt-4 p-3">
                        @include('admin.legal_contents._form', ['content' => $content])
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection