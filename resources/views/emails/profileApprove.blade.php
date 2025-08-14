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
        padding-top: 1rem;
        padding-bottom: 1rem;
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
        padding: 2px 10px;
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
                                    <td class="heading">
                                        <p>@lang('emailsText.profile_approve_1') {{$user->like_to_be_called}},</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.profile_approve_2') 🎉 @lang('emailsText.profile_approve_3').</p>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.profile_approve_4'):</p>
                                        <p>✅ @lang('emailsText.profile_approve_5').</p>
                                        <p>✅ @lang('emailsText.profile_approve_6').</p>
                                        <p>✅ @lang('emailsText.profile_approve_7').</p>
                                        <p>✅ @lang('emailsText.profile_approve_8').</p>
                                        <p>✅ @lang('emailsText.profile_approve_9').</p>
                                        <p>✅ @lang('emailsText.profile_approve_10').</p>
                                        <p>✅ @lang('emailsText.profile_approve_11').</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>🔹 @lang('emailsText.profile_approve_12').</p>
                                        <p>
                                            <a href="{{ $url }}">@lang('emailsText.profile_approve_13')</a> @lang('emailsText.profile_approve_14').
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.profile_approve_15')</p>
                                        <p>@lang('emailsText.profile_approve_16').</p>
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