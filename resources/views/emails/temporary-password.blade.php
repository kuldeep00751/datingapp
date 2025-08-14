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
                                        <p>Hello {{$user->like_to_be_called}},</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>Your temporary password is: <strong>{{ $tempPassword }}</strong>.</p>
                                        <p>Please log in and reset your password as soon as possible.</p>
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