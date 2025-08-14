@extends('emails.email-layout')
<style>
    .mail-table-item{
        border: 2px solid #ebebeb;
        padding: 1rem;
    }
    .mail-table-item tbody tr .heading-logo{
        padding-top: 0px;
        text-align:center;
    }
    .mail-table-item tbody tr .heading-logo span{
        color: #444444; 
        font-weight: bold; 
        margin: 0; 
        font-size: 22px;
        border-bottom: 1px solid #444444;
    }

    .mail-table-item tbody tr .heading {
        padding-top:3rem;
        padding-left:2rem;
        font-size: 16px !important;
        /* font-weight: bold; */
        color: #444444;
    }
    .mail-table-item tbody tr .body{
        padding-top:1rem;
        padding-bottom:1rem;
        padding-left:2rem;
        font-size: 16px !important;
        /* font-weight: bold; */
        color: #444444;
    }
    .mail-table-item tbody tr .body .p-lineheight{
        padding:0px;
        margin:0px;
    }
    .mail-table-item tbody tr .body p a{
        display: inline-block;
        background-color: #007bff;
        color: #ffffff;
        text-decoration: none;
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 14px;
    }
</style>
@section('email-content')
<table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;position: relative;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <td>
         <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="width: 100%; margin: 50px 0px; background-color: #fff;">
            <tr>
               <td style="padding:20px;">
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="shadow mail-table-item">
                     <tr>
                        <td class="heading-logo">
                           <img src="{{asset('/public/pictures/logo.png')}}" alt="DatingApp" width="200px">
                        </td>
                     </tr>
                     <tr>
                        <td class="heading">
                           <p>@lang('emailsText.profile_search_update_1') {{$userName}},</p>
                        </td>
                     </tr>
                     <tr>
                        <td class="body">
                           <p>@lang('emailsText.profile_search_update_2').</p>

                           <p>✨ @lang('emailsText.profile_search_update_3').</p>

                           <p>💡 @lang('emailsText.profile_search_update_4')</p>
                           
                           <p>@lang('emailsText.profile_search_update_5')</p>

                           <p>💡 @lang('emailsText.profile_search_update_6').</p>

                           <p>@lang('emailsText.profile_search_update_7').</p>
                        </td>
                     </tr>
                     @include('emails.signature')
                  </table>
               @include('emails.footer')    
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>
@endsection