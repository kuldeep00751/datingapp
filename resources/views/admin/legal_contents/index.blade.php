@extends('admin.layouts.master')
@section('content')
<style>
   
   .table td, .table th {
      white-space: unset;
   }
</style>
<div class="container-fluid py-4">
   <div>
      <div class="container-fluid py-4">
         <div class="card">
            <div class="card-header">
               <h6 class="mb-0">
                  Legal Contents
                  <div class="float-end">
                     <a href="{{ route('legal-contents.create') }}" class="btn btn-primary btn-sm mb-0">+ Add New</a>
                  </div>
               </h6>
            </div>
            <div class="card-body pt-4 p-3 table-responsive">
           
               <table id="myDataTable" class="table table-striped table-response">
                  <thead >
                     <tr>
                        <th style="width:15%">Type</th>
                        <th style="width:10%">Locale</th>
                        <th style="width:15%">Actions</th>
                     </tr>
                  </thead>
                  <tbody >
                     @foreach($contents as $content)
                        @php
                           $language = match ($content->locale) {
                              'en' => 'English',
                              'es' => 'Spanish',
                              default => 'No Language',
                           };
                        @endphp
                    <tr>
                        <td>{{ ucfirst($content->type) }}</td>
                        <td>{{ $language }}</td>
                        <td>
                           <a href="{{ route('legal-contents.show', $content->id) }}" class="btn btn-sm btn-success">View</a>
                            <a href="{{ route('legal-contents.edit', $content->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('legal-contents.destroy', $content->id) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this content?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>
</div>
@endsection