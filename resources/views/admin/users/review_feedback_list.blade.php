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
                        Resolved Feedback List
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
                    <table id="myDataTable1" class="table table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Message</td>
                                <td>Date</td>
                                <td>Action</td>
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
    <div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        Review Feedback List
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
                                <td>Message</td>
                                <td>Date</td>
                                <td>Action</td>
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
    <!-- <script>
        $(document).ready(function() {

            var searchValue = localStorage.getItem('dataTableSearch') || '';

            var table = $('#myDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.getreviewFeedback_list') }}',
                lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, "All"]], 
                pageLength: 10, 
                order: [[2   , "desc"]],
                columns: [
                    { data: 'id'},
                    { data: 'name'},
                    { data: 'message'},
                    { data: 'created_at'},
                    { data: 'action'},
                ],
            });
            if (searchValue) {
                table.search(searchValue).draw();
            }

            // Store search value when input changes
            $('#myDataTable_filter input').on('keyup', function() {
                localStorage.setItem('dataTableSearch', $(this).val());
            });

            var table = $('#myDataTable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.getreviewFeedback_list') }}',
                lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, "All"]], 
                pageLength: 10, 
                order: [[2   , "desc"]],
                columns: [
                    { data: 'id'},
                    { data: 'name'},
                    { data: 'message'},
                    { data: 'created_at'},
                    { data: 'action'},
                ],
            });
            
        });
    </script> -->
    <script>
    $(document).ready(function () {
        var searchValue = localStorage.getItem('dataTableSearch') || '';

        // 🔵 Table 1 – Review Feedback List (read = 0)
        var table1 = $('#myDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.getreviewFeedback_list') }}',
            lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, "All"]],
            pageLength: 10,
            order: [[3, "desc"]],
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'message' },
                { data: 'created_at' },
                { data: 'action' },
            ],
        });

        if (searchValue) {
            table1.search(searchValue).draw();
        }

        $('#myDataTable_filter input').on('keyup', function () {
            localStorage.setItem('dataTableSearch', $(this).val());
        });

        // 🔴 Table 2 – Resolved Feedback List (read = 1)
        var table2 = $('#myDataTable1').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.getreviewedFeedback_list') }}', // <- use correct route
            lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, "All"]],
            pageLength: 10,
            order: [[3, "desc"]],
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'message' },
                { data: 'created_at' },
                { data: 'action' },
            ],
        });
    });
</script>

</div>
@endsection