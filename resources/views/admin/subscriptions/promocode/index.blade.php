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
                  Promo Code List
                  <div class="float-end">
                     <a href="{{route('admin.promocode.create')}}" class="btn btn-primary btn-sm mb-0">+ Promo Code</a>
                  </div>
               </h6>
            </div>
            <div class="card-body pt-4 p-3 table-responsive">
           
               <table id="myDataTable" class="table table-striped table-response">
                  <thead >
                     <tr>
                        <th style="width:2%">Id</th>
                        <th style="width:15%">Promo Code</th>
                        <th style="width:10%">Discount Type</th>
                        <th style="width:15%">Discount value</th>
                         <th style="width:10%">Expires Date</th>
                         <th style="width:15%">MemberShip (in months)</th>
                        <th style="width:53%">Actions</th>
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
<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="sendEmailForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Send Promo Code Email</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="users" class="form-label">Select Users</label>
            <select name="users[]" id="users" class="form-select" multiple>
              @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="promo_code" class="form-label">Promo Code</label>
            <input type="text" class="form-control" id="promo_code" name="promo_code" readonly>
          </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="sendEmailBtn">
               <span id="sendEmailBtnText">Send Email</span>
               <span id="sendEmailSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
         </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.promocode.getPromocode') }}',
            columns: [
               { data: 'id'},
               { data: 'code'},
               { data: 'discount_type'},
               { data: 'discount'},
               { data: 'expires_at'},
               { data: 'duration'},
               { data: 'action',orderable: false },
            ],
        responsive: true, 
        scrollX: false
        });
    });
</script>
<script>
    function confirm_submit(button) {
        var form = button.closest('form');

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this Promo Code!",
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
<script>
  function openEmailPopup(promoCode) {
    new bootstrap.Modal(document.getElementById('emailModal')).show();
    document.getElementById('promo_code').value = promoCode;
  }

   document.getElementById('sendEmailForm').addEventListener('submit', function(e) {
      e.preventDefault();

      let form = e.target;

      // Show spinner and disable button
      document.getElementById('sendEmailBtn').disabled = true;
      document.getElementById('sendEmailSpinner').classList.remove('d-none');
      document.getElementById('sendEmailBtnText').textContent = 'Sending...';

      let formData = new FormData(form);

      fetch("{{ route('send.promo.email') }}", {
         method: 'POST',
         headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
         body: formData
      })
      .then(response => response.json())
      .then(data => {
         // Hide spinner and re-enable button
         document.getElementById('sendEmailBtn').disabled = false;
         document.getElementById('sendEmailSpinner').classList.add('d-none');
         document.getElementById('sendEmailBtnText').textContent = 'Send Email';

         if (data.success) {
               Swal.fire({
                  icon: 'success',
                  title: 'Success!',
                  text: 'Promo emails sent successfully.',
                  timer: 2500,
                  showConfirmButton: false
               });
               bootstrap.Modal.getInstance(document.getElementById('emailModal')).hide();
         } else {
               Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Error sending emails.',
               });
         }
      })
      .catch(error => {
         Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Unexpected error.',
         });

         // Hide spinner and re-enable button
         document.getElementById('sendEmailBtn').disabled = false;
         document.getElementById('sendEmailSpinner').classList.add('d-none');
         document.getElementById('sendEmailBtnText').textContent = 'Send Email';
      });
   });

</script>

@endsection