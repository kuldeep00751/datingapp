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
    .mail-table-item tbody tr .body p {
        margin:0px;
        padding:0px;
        line-height:22px;
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
                                    <p>@lang('emailsText.reconsider_invitation_1') {{($profilesName)? $profilesName : $profilesEmail}},</p>
                                </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p> {{$userName }} @lang('emailsText.reconsider_invitation_2')</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.reconsider_invitation_3')</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>🔥 @lang('emailsText.reconsider_invitation_4')</p>
                                        <p>@lang('emailsText.reconsider_invitation_5').</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.reconsider_invitation_6'):</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>✨ @lang('emailsText.reconsider_invitation_7').</p>
                                        <p>✨ @lang('emailsText.reconsider_invitation_8').</p>
                                        <p>✨ @lang('emailsText.reconsider_invitation_9').</p>
                                        <p>✨ @lang('emailsText.reconsider_invitation_10').</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>@lang('emailsText.reconsider_invitation_11').</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="body">
                                        <p>💡 @lang('emailsText.reconsider_invitation_12').</p>
                                        <p style="margin-bottom: 1rem;"><a href="{{ route('users.show-user', $user_id) }}?mastering-activate={{ $user->id }}" style="background-color:#595959;border-color:#595959;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">@lang('emailsText.reconsider_invitation_13')</a></p>

                                        <p style="margin-bottom: 1rem;"><a href="{{ route('users.show-user', $user_id) }}" style="background-color:#595959;border-color:#595959;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">@lang('emailsText.reconsider_invitation_14')</a></p>
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