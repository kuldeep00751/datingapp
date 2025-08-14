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
        padding: 2px 10px;
        border-radius: 5px;
        font-size: 14px;
    }
</style>
@section('email-content')
    <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;position: relative;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table border="0" align="center" cellpadding="0" cellspacing="0" style="background-color: #fff;">
                    <tr>
                        <td style="padding: 20px;">
                            <table style="max-width: 670px; margin: 0 auto; position: relative;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="shadow mail-table-item">
                                <tr>
                                    <td class="heading-logo" style="text-align: center; padding: 30px 0;">
                                        <h2>@lang('emailsText.reset_1')</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="heading" style="padding: 0 30px;">
                                        <p style="font-size: 16px;">@lang('emailsText.reset_2') {{ $userAdmin->email ?? "Admin" }},</p> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body" style="padding: 0 30px;">
                                        <p style="font-size: 15px; line-height: 1.6;">
                                            @lang('emailsText.reset_3') 
                                        </p>
                                        <p style="font-size: 15px; line-height: 1.6;">
                                            @lang('emailsText.reset_4') 
                                        </p>
                                        <p style="margin: 25px 0;">
                                            <a href="{!! $resetLink !!}" style="background-color: #007bff; border-color: #007bff; color: white; padding: 10px 25px; border-radius: 6px; text-decoration: none; font-size: 16px; text-align: center; text-transform: uppercase;">
                                                @lang('emailsText.reset_5') 
                                            </a>
                                        </p>
                                        <p style="font-size: 14px; color: #555;">
                                            @lang('emailsText.reset_6')
                                        </p>
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
