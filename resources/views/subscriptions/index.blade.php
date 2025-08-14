@extends('layouts.app')

<style>

  main

   {

      position: relative;

      width: 100%;

      /* height: 100%; */

      background: url('{{ asset("pictures/welcome_background.png") }}') no-repeat center center;

      background-size: cover;

      display: flex;

      justify-content: center;

      align-items: center;

   }

   main::before {

      content: "";

      position: absolute;

      width: 100%;

      height: 100%;

      backdrop-filter: blur(5px);

      background-color: rgba(0, 0, 0, 0.5);

      top: 0;

      left: 0;

      z-index: 0;

   }

   @media (max-width: 768px)

   {

   .pad-b6{

   padding-bottom: 5rem !important;

   }

   }

   .card{

      background-color:unset !important;

      border: unset !important;

   }

   .main-table table {

   border: 1px solid #fff !important;

   border-collapse: collapse; /* Makes borders consistent */

   }



   .main-table table thead th,

   .main-table table tbody td {

   border-right: 1px solid #fff !important;

   border-bottom: none !important;

   padding: 0.75rem;

   color: white;

   border-top: none !important;

   }



   .main-table table thead tr th:last-child,

   .main-table table tbody tr td:last-child {

   border-right: none !important; /* Removes border on last column */

   }

   .main-table .table-dark th, .table-dark td, .table-dark thead th

   {

      border-color: #fff !important;

   }

   .main-table .table-dark {

      color: #fff;

      background-color: #0000007d !important;

   }

   .plan-footer tr td{

         text-align:center;

      }

      .plan-footer tr td p{

         text-align:left;

         margin-bottom:0px !important;

         margin-left: 2rem;

         font-size: 15px;

      }

      .footer-position-bottom{

         display:none !important;

      }

       @media(max-width :786px)
        {
            main
            {
                height: auto;
            }
            .card-body
            {
               padding: 20px !important;
            }
            .plan-footer tr td p
            {
                margin-left:0px;
                margin-bottom: 10px !important;

            }
         }
.plan-footer tr td {
            padding-bottom: 10px; 
        }
</style>

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href="{{ asset('assets/css/subscription.css') }}" rel="stylesheet">

<div class="container">

   <div class="row justify-content-center" style="font-family: 'AvenirNext', sans-serif;">

      <div class="col-md-12 mt-5">

         <div class="card">

            <div class="card-body ">

               <div class="pricing-container col-lg-12 col-md-12 col-sm-12">

                  <div class="col-lg-12 col-md-12 col-sm-12 text-center"><img src='{{ asset("pictures/LOGO H W.png") }}' width="50%"></div>

                  <div class="col-lg-12 col-md-12 col-sm-12 text-center text-white h3" style="margin-top: -1rem;font-size: 28px;">@lang('messages.subscription_plan_0')</div>

               </div>

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

               <div class="table-responsive main-table">

                  <table class="table table-striped">

                     <thead class="table-dark ">

                        <tr>

                           <th>@lang('messages.subscription_index_2')</th>

                           <th>@lang('messages.subscription_index_3')</th>

                           <th>@lang('messages.subscription_index_4')</th>

                           <th>@lang('messages.subscription_index_5')</th>

                           <th>@lang('messages.subscription_index_6')</th>

                           <th>@lang('messages.subscription_index_7')</th>

                           <th>@lang('messages.subscription_index_8')</th>

                        </tr>

                     </thead>

                     <tbody>

                        @if($subscriptions && $subscriptions->count() > 0)

                        @foreach($subscriptions as $index =>$subscription)

                        @php

                        $statusBadge = ($subscription->status == 'active') 

                        ? '<span class="badge badge-success fs-2">' . $subscription->status . '</span>' 

                        : '<span class="badge badge-warning fs-2">' . $subscription->status . '</span>';

                        $paymentBadge = ($subscription->payment_status == 'completed') 

                        ? '<span class="badge badge-success fs-2">' . $subscription->payment_status . '</span>' 

                        : '<span class="badge badge-warning fs-2">' . $subscription->payment_status . '</span>';

                        $feedback = getUserFeedback(40);

                        $feedbackRating = $feedback['feedbackTotalAverage'];

                        @endphp

                        <tr>

                           <td>{{ $loop->iteration }}</td>

                           <td>{{ $subscription->planDetail->name }}-{{ $subscription->planDetail->duration }} Months</td>

                           <td>{!! $statusBadge !!}</td>

                           <td>{{ $subscription->start_date->toFormattedDateString() }}</td>

                           <td>{{ $subscription->end_date->toFormattedDateString() }}</td>

                           <td>{!!  $paymentBadge !!}</td>

                           <td class="d-flex pad-b6">

                              @if($subscription->status !='cancelled')

                              @if($subscription->paused_hide ==0)

                              @if($subscription->status =='paused')

                              <form action="{{ route('user.subscription.pause') }}" method="POST" class="d-inline m-0">

                                 @csrf

                                 <button type="submit" class="badge badge-secondary border-0 px-3 py-2">@lang('messages.subscription_index_9')</button>

                              </form>

                              @else

                              <button type="button" class="badge badge-secondary border-0 px-3 py-2" data-bs-toggle="modal" data-bs-target="#subscriptionModal" data-subscription-id="{{ $subscription->id }}" data-subscription-plan="{{ $subscription->plan}}">@lang('messages.subscription_index_10')</button>

                              @endif

                              @endif

                              @if($subscription->is_renew == 0 && $subscription->renew_status == 1)

                              <button type="button" class="badge badge-primary mx-2 border-0 px-3 py-2" data-bs-toggle="modal" data-bs-target="#subscriptionModal-extend" data-subscription-extend-id="{{ $subscription->id }}" data-subscription-plan="{{ $subscription->plan}}">

                              @lang('messages.subscription_index_11')

                              </button>

                              @endif

                              @endif

                              @if($subscription->status =='cancelled')

                                 <button class="badge badge-danger border-0 px-3 py-2">@lang('messages.subscription_index_12')</button>

                                 @if($subscription->end_date > now())

                                    <form action="{{ route('user.subscription.cancel') }}" method="POST" class="d-inline m-0">

                                       @csrf

                                       <input name="subscriptionId" type="hidden" value="{{ $subscription->id }}">

                                       <input name="subscriptionStatus" type="hidden" value="reactive">

                                       <button type="submit" class="badge badge-primary border-0 px-3 py-2">Re-activate</button>

                                    </form>

                                 @else

                                    <button type="button" class="badge badge-primary mx-2 border-0 px-3 py-2" data-bs-toggle="modal" data-bs-target="#subscriptionModal-extend" data-subscription-extend-id="{{ $subscription->id }}" data-subscription-plan="{{ $subscription->plan}}">

                                    @lang('messages.subscription_index_11')

                                    </button>

                                 @endif

                              @else

                              <form action="{{ route('user.subscription.cancel') }}" method="POST" class="d-inline m-0">

                                 @csrf

                                 <input name="subscriptionId" type="hidden" value="{{ $subscription->id }}">

                                 <input name="subscriptionStatus" type="hidden" value="cancel">

                                 <button type="submit" class="badge badge-danger border-0 px-3 py-2">@lang('messages.subscription_index_13')</button>

                              </form>



                              @endif

                           </td>

                        </tr>

                        @endforeach

                        @else

                        <tr>

                           <td colspan="7" class="text-center">@lang('messages.subscription_index_14').@lang('messages.subscription_index_14_1') <a href="{{route('payment.paymentnow')}}" class="btn btn-primary">@lang('messages.subscription_index_14_2')</a></td>

                        </tr>

                        @endif

                     </tbody>

                  </table>

               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center py-3 px-3">
                  <a href="{{ route('user.subscription.plans') }}" class="btn" style="background-color:#0000007d; color:#fff;border:1px solid #fff; border-radius:unset;padding: 1rem; box-shadow: unset;font-family: 'FutureBTBook', sans-serif;">@lang('messages.subscription_index_1')</a>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-white text-center">
                    <p>@lang('messages.subscription_plan_8').</p>
                </div>

               <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-white text-center my-3">

                  <table style="width: 50%;color: white;" class="plan-footer" style="border:none;">

                     <tr>

                           <td>

                              <img src="{{ asset('pictures/image49.png') }}" alt="TrueOne" style="max-height: 40px;">

                           </td>

                           <td>

                              <p>@lang('messages.subscription_plan_9').</p>

                           </td>

                     </tr>

                     <tr>

                           <td>

                              <img src="{{ asset('pictures/image4.png') }}" alt="Safe Circle" style="max-height: 40px;">

                           </td>

                           <td>

                              <p>@lang('messages.subscription_plan_10') .</p>

                           </td>

                     </tr>

                     <tr>

                           <td>

                              <img src="{{ asset('pictures/image19.png') }}" alt="Real Standards" style="max-height: 40px;">

                           </td>

                           <td>

                              <p>@lang('messages.subscription_plan_11').</p>

                           </td>

                     </tr>

                     <tr>

                           <td>

                              <img src="{{ asset('pictures/image26.png') }}" alt="Mastering Delivery" style="max-height: 40px;">

                           </td>

                           <td>

                              <p>@lang('messages.subscription_plan_12').</p>

                           </td>

                     </tr>

                  </table>

               </div>

            </div>

            

         </div>

      </div>

   </div>

</div>

<!-- Subscription Management Modal -->

<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">

   <div class="modal-dialog">

      <div class="modal-content">

         <div class="modal-header">

            <h5 class="modal-title" id="subscriptionModalLabel">@lang('messages.subscription_index_15')</h5>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

         </div>

         <div class="modal-body">

            <form method="POST" action="{{ route('user.subscription.pause') }}">

               @csrf

               <label>@lang('messages.subscription_index_16'):</label>

               <input type="hidden" name="subscription_id" id="subscription_id">

               <input type="date" name="paused_until" class="form-control" required>

               <button type="submit" class="btn btn-warning mt-2">@lang('messages.subscription_index_17')</button>

            </form>

         </div>

      </div>

   </div>

</div>

<div class="modal fade" id="subscriptionModal-extend" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">

   <div class="modal-dialog">

      <div class="modal-content">

         <div class="modal-header">

            <h5 class="modal-title" id="subscriptionModalLabel">@lang('messages.subscription_index_18')</h5>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

         </div>

         <div class="modal-body">

            <form method="POST" action="{{ route('user.subscription.extend') }}">

               @csrf

               <label>@lang('messages.subscription_index_19'):</label>

               <input type="hidden" name="subscription_id" id="subscription_id_extend">

               <select class="form-control mb-3" name="months" required>

                  <option value="">@lang('messages.subscription_index_20')</option>

                  @foreach($plans as $plan)

                  <option value="{{$plan->id}}">{{$plan->duration}} @lang('messages.subscription_index_21')</option>

                  @endforeach

               </select>

                <div class="mb-3">

                  <label for="promocode" class="form-label" style="float: left;margin-right: 1rem;">@lang('messages.payment_promo1')</label>

                  <div class="input-group">

                     <input type="text" id="promocode" class="form-control" style="border-radius: unset;">

                     <input type="hidden" id="subscriptionPackage" value="0">

                     <button id="applyPromocodeBtn" class="btn btn-success ml-2" style="border-radius: unset;">@lang('messages.payment_promo3')</button>

                     <br>

                     <div id="promocode-feedback" class="mt-2 text-success mb-2 col-md-12" style="display: none; float: left;"></div>

                  </div>

                  

               </div>

               <hr>

               <button type="submit" class="btn btn-success mt-2">@lang('messages.subscription_index_22')</button>

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

           var subscriptionPlanId = button.getAttribute("data-subscription-plan");

           document.getElementById("subscription_id_extend").value = subscriptionId;

           document.getElementById("subscriptionPackage").value = subscriptionPlanId;

       });

   });

</script>

<script>

   document.getElementById('applyPromocodeBtn').addEventListener('click', function () {

      const code = document.getElementById('promocode').value;

      const subscriptionPackage = document.getElementById('subscriptionPackage').value;

      const feedback = document.getElementById('promocode-feedback');

      

      if (!code) {

         feedback.style.display = 'block';

         feedback.classList.remove('text-success');

         feedback.classList.add('text-danger');

         feedback.innerText = 'Please enter a promocode.';

         return;

      }



      fetch('{{ route("promocode.apply") }}', {

         method: 'POST',

         headers: {

               'Content-Type': 'application/json',

               'X-CSRF-TOKEN': '{{ csrf_token() }}'

         },

         body: JSON.stringify({ 

            code: code,

            subscriptionPackage: subscriptionPackage,

         })

      })

      .then(res => res.json())

      .then(data => {

         if (data.discount) {

               feedback.style.display = 'block';

               feedback.classList.remove('text-danger');

               feedback.classList.add('text-success');

               feedback.innerText = `Promocode applied!`;

         } else {

               throw new Error(data.message || 'Failed to apply promocode.');

         }

      })

      .catch(err => {

         feedback.style.display = 'block';

         feedback.classList.remove('text-success');

         feedback.classList.add('text-danger');

         feedback.innerText = err.message;

      });

   });

</script>

@endsection