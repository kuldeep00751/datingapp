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
                  Feature List
                  <div class="float-end">
                     <a href="{{route('admin.features.create')}}" class="btn btn-primary btn-sm mb-0">+ Feature</a>
                  </div>
               </h6>
            </div>
            <div class="card-body pt-4 p-3 table-responsive">
           
               <table id="myDataTable" class="table table-striped table-response">
                  <thead >
                     <tr>
                        <th style="width:2%">Id</th>
                        <th style="width:28%">Name</th>
                        <th style="width:60%">Description</th>
                        <th style="width:10%">Actions</th>
                     </tr>
                  </thead>
                  <tbody >
                     
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>
</div>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.features.getFeature') }}',
            columns: [
                { data: 'id'},
                { data: 'name'},
                { data: 'description'},
                { data: 'action',orderable: false },
            ],
        responsive: true,  // Enables responsive behavior
        scrollX: false
        });
    });
</script>
<script>
    function confirm_submit(button) {
        var form = button.closest('form');

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this Feature!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection