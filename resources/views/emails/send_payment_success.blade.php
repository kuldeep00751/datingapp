@extends('emails.email-layout')
@section('email-content')
    <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;position: relative;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="width: 100%; margin: 50px 0px; background-color: #fff;">
                <tr>
                    <td style="padding:20px;">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                            <td style="padding-top: 0px;text-align:center;"> 
                            <img src="{{asset('/public/pictures/logo.png')}}" alt="DatingApp" width="200px">
                            <br>
                            <hr>
                            </td>
                        </tr>
                            <tr>
                                <td style="padding-top: 16px;">
                                    <p style="font-size:15px; color:#455056; line-height:24px; margin:0;">@lang('emailsText.successPayment_1') {{$user->like_to_be_called}},</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;" colspan="2">
                                    <p style="font-size:15px; color:#455056; line-height:24px; margin:2px 0 0px;"> @lang('emailsText.successPayment_2') {{$startdate}} @lang('emailsText.successPayment_3') {{$enddate}}.</p>
                                    <br>
                                    <p style="margin-bottom: 1rem;">
                                    @lang('emailsText.successPayment_4').
                                    </p>
                                </td>
                            <tr>
                                <td style="padding-top: 0px;" colspan="2">
                                    <p style="font-size:15px; color:#455056; line-height:24px; margin:2px 0 0px;">From now on, @lang('emailsText.successPayment_5') </p>
                                </td>
                            </tr> 
                            <tr>
                                <td style="padding-top: 0px;" colspan="2">
                                    <p style="font-size:15px; color:#455056; line-height:24px; margin:2px 0 0px;">@lang('emailsText.successPayment_6'). </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;" colspan="2">
                                    <p style="font-size:15px; color:#455056; line-height:24px; margin:2px 0 0px;">@lang('emailsText.successPayment_7'). </p>
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