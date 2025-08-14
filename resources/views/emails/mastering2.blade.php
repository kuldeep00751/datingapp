@extends('emails.email-layout')
@section('email-content')
<style>
    .mail-table-item{
        border: 2px solid #ebebeb;
        padding: 1rem;
    }
    .mail-table-item tbody tr .header{
        padding-top:6rem;
        padding-left:2rem;
        font-size: 20px !important;
        font-weight: bold;
        color: #444444;
    }
    .mail-table-item tbody tr .body{
        padding-top:1rem;
        padding-left:2rem;
        font-size: 20px !important;
        font-weight: bold;
        color: #444444;
    }
    .mail-table-item tbody tr .body .p-lineheight{
        padding:0px;
        margin:0px;
    }.mail-table-item{
        border: 2px solid #ebebeb;
    }
    .mail-table-item tbody tr .header{
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
    <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;position: relative;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="width: 100%; margin: 50px 0px; background-color: #fff;">
                <tr>
                    <td style="padding:20px;">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="shadow mail-table-item">
                            <tr >
                                <td class="header">
                                    <p>@lang('emailsText.mastering2_1') {{$profiles->like_to_be_called}},</p>
                                </td>
                            </tr>
                            <tr >
                                <td class="body" colspan="2">
                                    <p>{{$user->like_to_be_called}} @lang('emailsText.mastering2_2')</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="body" colspan="2">
                                    <p>@lang('emailsText.mastering2_3')</p>
                                    <p><img src="{{asset('/public/pictures/fire.png')}}" alt="DatingApp" width="20px">  @lang('emailsText.mastering2_4')</p>
                                    <p>@lang('emailsText.mastering2_5')</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="body" colspan="2">
                                    <p>@lang('emailsText.mastering2_6'):</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="body" colspan="2">
                                    <p class="p-lineheight"><img src="{{asset('/public/pictures/sparkling.png')}}" alt="DatingApp" width="20px"> @lang('emailsText.mastering2_7').</p>
                                    <p class="p-lineheight"><img src="{{asset('/public/pictures/sparkling.png')}}" alt="DatingApp" width="20px"> @lang('emailsText.mastering2_8').</p>
                                    <p class="p-lineheight"><img src="{{asset('/public/pictures/sparkling.png')}}" alt="DatingApp" width="20px"> @lang('emailsText.mastering2_9').</p>
                                    <p>@lang('emailsText.mastering2_10').</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="body" colspan="2">
                                    <p>@lang('emailsText.mastering2_11').</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="body" colspan="2">
                                    <p><img src="{{asset('/public/pictures/light-bulb-emoji.png')}}" alt="DatingApp" width="20px">@lang('emailsText.mastering2_12').</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="body" colspan="2">
                                    <p style="margin-bottom: 2rem;"><a href="{{ route('users.show-user', $user->id) }}?mastering-activate={{ $user->id }}" style="background-color:#dc3545;border-color:#dc3545;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">@lang('emailsText.mastering2_13')</a></p> 

                                    <p style="margin-bottom: 1rem;"><a href="{{ route('users.show-user', $user->id) }}" style="background-color:#595959;border-color:#595959;color:white;padding: 10px 25px;border-radius:6px;text-decoration:none;font-size: 16px;text-align: center;text-transform: uppercase;">@lang('emailsText.mastering2_14')</a></p>
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