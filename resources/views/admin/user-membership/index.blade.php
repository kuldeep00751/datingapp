@extends('admin.layouts.master')
@section('content')
<div class="container-fluid py-4">
   <div>
      <div class="container-fluid py-4">
         <div class="card">
            <div class="card-header">
               <h6 class="mb-0">
                  User Membership List
                  <div class="float-end">
                     <!-- <a href="{{route('admin.subscriptions.create')}}" class="btn btn-primary btn-sm mb-0">+ Subscription</a> -->
                  </div>
               </h6>
            </div>
            <div class="card-body pt-4 p-3 table-responsive">
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
               <table id="myDataTable" class="table table-striped">
                  <thead class="text-center">
                     <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Plan</th>
                        <th>Price</th>
                        <th>Start Date</th>
                        <th>End Date</th>
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
    function confirmPause(subscriptionId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to pause this subscription.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Pause it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#subscriptionModal').modal('show');
                $('#subscriptionModal').find('[name="subscription_id"]').val(subscriptionId);
            }
        });
    }

    function confirmExtend(subscriptionId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to extend this subscription.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Yes, Extend it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#subscriptionModal-extend').modal('show');
                $('#subscriptionModal-extend').find('[name="subscription_id"]').val(subscriptionId);
            }
        });
    }

    function confirmCancel(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to cancel this subscription",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancel-form-' + id).submit();
            }
        });
    }
    
    function confirmReactive(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to reactive this subscription",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reactive-form-' + id).submit();
            }
        });
    }
</script>

<script>
    $(document).ready(function() { 
        $('#myDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.subscriptions.usersubscriptionList') }}',
            columns: [
                { data: 'id'},
                { data: 'username'},
                { data: 'email'},
                { data: 'plan'},
                { data: 'price'},
                { data: 'start_date'},
                { data: 'end_date'},
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
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscriptionModalLabel">Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.subscription.pause') }}">
                    @csrf
                    <label>Pause Until:</label>
                    <input type="hidden" name="subscription_id" id="subscription_id">
                    <input type="date" name="paused_until" class="form-control" required>
                    <button type="submit" class="btn btn-warning mt-2">Pause</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="subscriptionModal-extend" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscriptionModalLabel">Extend Your Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.subscription.extend') }}">
                    @csrf
                    <label>Extend by Months:</label>
                    <input type="hidden" name="subscription_id" id="subscription_id_extend">
                    <select class="form-control mb-3" name="months" required>
                        <option value="">Select Months</option>
                        @foreach($plans as $plan)
                            <option value="{{$plan->id}}">{{$plan->duration}} Months</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success mt-2">Extend</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var subscriptionModal = document.getElementById("subscriptionModal");
        var subscriptionModalExtend = document.getElementById("subscriptionModal-extend");

        subscriptionModal.addEventListener("show.bs.modal", function(event) {
            var button = event.relatedTarget;
            var subscriptionId = button.getAttribute("data-subscription-id");

            document.getElementById("subscription_id").value = subscriptionId;
        });

        subscriptionModalExtend.addEventListener("show.bs.modal", function(event) {
            var button = event.relatedTarget;
            var subscriptionId = button.getAttribute("data-subscription-extend-id");
            document.getElementById("subscription_id_extend").value = subscriptionId;
        });
    });
</script>
@endsection
