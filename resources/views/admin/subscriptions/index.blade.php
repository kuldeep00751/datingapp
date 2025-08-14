@extends('admin.layouts.master')
@section('content')
<div class="container-fluid py-4">
   <div>
      <div class="container-fluid py-4">
         <div class="card">
            <div class="card-header">
               <h6 class="mb-0">
                  Subscription Plan List
                  <div class="float-end">
                     <a href="{{route('admin.subscriptions.create')}}" class="btn btn-primary btn-sm mb-0">+ Subscription</a>
                  </div>
               </h6>
            </div>
            <div class="card-body pt-4 p-3 table-responsive">
               <table id="myDataTable" class="table table-striped">
                  <thead class="text-center">
                     <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody class="text-center">
                     
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
            ajax: '{{ route('admin.subscriptions.subscriptionList') }}',
            columns: [
                { data: 'id'},
                { data: 'name'},
                { data: 'price'},
                { data: 'duration'},
                { data: 'status'},
                { data: 'action',orderable: false },
            ]
        });
    });
</script>
<script>
    function confirm_submit(button) {
        var form = button.closest('form');

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this User!",
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