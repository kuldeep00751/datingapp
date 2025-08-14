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
                                <p style="font-size:15px; color:#455056; line-height:24px; margin:0;">@lang('emailsText.accept_submit_meeting_1') {{$user->like_to_be_called}},</p>
                            </td>
                            </tr>
                            <tr>
                            <td style="padding-top: 0px;" colspan="2">
                                <p style="font-size:15px; color:#455056; line-height:24px; margin:2px 0 0px;"> @lang('emailsText.accept_submit_meeting_2').</p>
                                <br>
                                <p style="margin-bottom: 1rem;">
                                @lang('emailsText.accept_submit_meeting_6'):<a href="{{ url('/ask-for-meeting')}}" style="background-color:#595959;border-color:#595959;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">@lang('emailsText.accept_submit_meeting_3')</a>
                                </p>
                            </td>
                            </tr>
                                <td>
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td colspan="2" style="font-size:15px;padding:8px 0px;">
                                            <p style="margin:0;">@lang('emailsText.accept_submit_meeting_4')</p>
                                            <p style="display:block;margin:0;">@lang('emailsText.accept_submit_meeting_5')</p>
                                        </td>
                                    </tr>
                                </table>
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