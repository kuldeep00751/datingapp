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
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
        <tr>
            <td>
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
                                                <p>Hi {{$user->like_to_be_called}},</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="body">
                                                <p>It looks like your meeting status is still pending. Would you like to cancel your connection?</p>
                                                <p>If you no longer wish to continue, you can cancel it here:</p>
                                                <p style="margin-bottom: 1rem;"><a href="{{ url('/cancel-connection')}}" style="background-color:#595959;border-color:#595959;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">Cancel Connection</a></p>

                                                <p>If you need more time, feel free to continue the conversation and plan your meeting at your own pace.</p>
                                                <p><strong>– The Silverbridge Team</strong></p>
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
            </td>
        </tr>
    </table>
@endsection