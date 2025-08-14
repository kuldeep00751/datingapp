@extends('admin.layouts.master')



@section('content')

<style>

    .btn-group-sm>.btn, .btn-sm {

    border-radius: 0.5rem;

    font-size: 0.75rem;

    padding: 2px 12px;

    margin: 5px 5px;

}



</style>





<div class="container-fluid py-4">                

    <div>

        <div class="container-fluid py-4">

            <div class="card">

                <div class="card-header pb-0 px-3">

                    <h6 class="mb-0">User Management

                    <div class="float-end">

                       

                            <a class="btn p-2" href="{{ route('users.create') }}" title="Create new role">

                                <span class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></span>

                            </a>

                       

                    </div>

                    </h6>

                </div>

                <div class="card-body pt-4 p-3">

                <div class="container table-responsive">

                    <table id="myDataTable" class="table table-striped">

                        <thead>

                            <tr>

                                <td>ID</td>

                                <td>Name</td>

                                <td>Email</td>

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

    <script>

        $(document).ready(function() {

            $('#myDataTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{{ route('user.getuser') }}',

                columns: [

                    { data: 'id'},

                    { data: 'name'},

                    { data: 'email'},

                    { data: 'action',orderable: false },

                ]

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



