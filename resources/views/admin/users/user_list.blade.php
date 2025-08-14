@extends('admin.layouts.master')
@section('content')
<style>
   .btn-group-sm>.btn, .btn-sm {
        border-radius: 0.5rem;
        font-size: 0.75rem;
        padding: 2px 12px;
        margin: 5px 5px;
        text-align: center;
        width: 80px; 
   }
</style>
<div class="container-fluid py-4">
    <div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                <h6 class="mb-0">
                    User Management
                    <div class="float-end">
                    </div>
                </h6>
                </div>
                <div class="card-body pt-4 p-3">
                    @if (session('success'))
                        <div class="alert badge-success text-white" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert badge-danger text-white" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Date Birth</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Profile Created</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">   
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script>
        $(document).ready(function() {

            var searchValue = localStorage.getItem('dataTableSearch') || '';

             var table = $('#myDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('user.getuser') }}',
                lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, "All"]], 
                pageLength: 10, 
                order: [[5, "desc"]],
                columns: [
                    { data: 'id'},
                    { data: 'name'},
                    { data: 'birthday'},
                    { data: 'email'},
                    { data: 'phone'},
                    { data: 'created_at'},
                    { data: 'action',orderable: false },
                ],
                dom: 'lBfrtip', // Adds the length menu
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        className: 'btn btn-success'
                    }
                ]
            });
            if (searchValue) {
                table.search(searchValue).draw();
            }

            // Store search value when input changes
            $('#myDataTable_filter input').on('keyup', function() {
                localStorage.setItem('dataTableSearch', $(this).val());
            });

            
        });
        
        $(document).ready(function() {
            $(document).on('submit', '.permission_store', function(e) {
                e.preventDefault();
        
                var user_id = $(this).find('#user_id').val();
        
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        //console.log(response.message);
                        if(response.alert_type =='success'){
                            toastr.options.timeOut = 10000;
                            toastr.success(response.message);
                            $('#exampleModal'+ user_id).modal('hide');
                        } else if(response.alert_type =='error'){
                            toastr.options.timeOut = 10000;
                            toastr.error(response.message);
                        }else{
                            toastr.options.timeOut = 10000;
                            toastr.error("Something went wrong.");
                        }
                    }
                });
            });
        });
        
        
        function confirmDeletion(id) {
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm'+id).submit();
                }
            });
        }
        
        function confirmApproval(id) {
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to approve this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approveForm'+id).submit();
                }
            });
        }
        
        function confirmRejection(id) {
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to reject this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('rejectForm'+id).submit();
                }
            });
        }
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
</div>
@endsection