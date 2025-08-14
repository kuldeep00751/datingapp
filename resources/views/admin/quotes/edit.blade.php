@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid py-4">                
        <div>
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-3 px-3">
                        <h6 class="mb-0">Menu Quote</h6>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('quotes.store') }}">
                    @csrf
                    <div class="card-body pt-4 p-3">
                        <div class="mb-3">
                            <label for="type" class="form-label">Quote</label>
                            <input type="text" name="text" id="text" class="form-control" required placeholder="Enter Quote" value="{{ old('text', optional($quotes)->text) }}">
                        </div>

                        <div class="mb-3">
                            <label for="locale" class="form-label">Author</label>
                            <input type="text" name="author" id="author" class="form-control" required placeholder="Enter author Name" value="{{ old('author', optional($quotes)->author) }}">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection