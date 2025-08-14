<!doctype html> 
<html lang="en-US">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Welcome To the Silverbridge</title>
        <meta name="description" content="User Registration">
        <style type="text/css"> 
            a:hover { text-decoration: none !important; } :focus { outline: none; border: 0; }
            .mail-table-item{
                border: 2px solid #ebebeb;
                padding: 1rem;
            }
            .mail-table-item tbody tr .heading-logo{
                padding-top: 0px;
                text-align:center;
            }
            .mail-table-item tbody tr .heading-logo span{
                color: #1e1e2d; 
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
        </style>
    </head>
    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background: #f2f3f8;" bgcolor="#eaeeef" leftmargin="0">
        <!--100% body table--> 
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
                                                        <br>
                                                        <span>@lang('emailsText.welcome_1')</span> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="heading">
                                                        <p>@lang('emailsText.welcome_2') {{($user->name)? $user->name : $user->email}},</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="body" colspan="2">
                                                        <p>@lang('emailsText.welcome_3').</p>
                                                        <p>🌟 @lang('emailsText.welcome_4')</p>
                                                        <p>🔹 {{$user->email}}</p>
                                                        <p>@lang('emailsText.welcome_5')</p>
                                                        <p>@lang('emailsText.welcome_6').</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="body mb-2" colspan="2">
                                                        <p><strong>@lang('emailsText.welcome_7')</strong></p>
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
    </body>
</html>