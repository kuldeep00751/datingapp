<!DOCTYPE html>
<html>
<head>
    <title>Corporate Email Verification</title>
</head>
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
        padding-top:0rem;
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
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; background-color: #f9f9f9;">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
        <tr>
            <td>
                <table border="0" align="center" cellpadding="0" cellspacing="0" style="background-color: #fff;">
                    <tr>
                        <td style="padding:20px;">
                            <table style="max-width:670px; margin:0 auto;position: relative;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="shadow mail-table-item">
                                <tr >
                                    <td class="heading-logo">
                                        <span>@lang('emailsText.verify_1')</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="heading">
                                        <p>@lang('emailsText.verify_2') {{($user->name)? $user->name : $user->email}},</p>
                                    <td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.verify_3')</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.verify_4')</p>
                                        <p style="margin-bottom: 1rem;">
                                            <a href="{{ url('email_verify_now/'.base64_encode($user->id)) }}" style="background-color:#595959;border-color:#595959;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">
                                            @lang('emailsText.verify_5')
                                            </a>
                                        </p>
                                        <p>@lang('emailsText.verify_6_1')</p>
                                        <p>@lang('emailsText.verify_6_2')</p>
                                        <p>@lang('emailsText.verify_7')</p>
                                    </td>
                                </tr>
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
</body>
</html>
