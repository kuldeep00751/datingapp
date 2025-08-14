<!doctype html> 
<html lang="en-US">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title></title>
        <meta name="description" content="User Registration">
        <link href="" rel="stylesheet">
        <style type="text/css"> 
            a:hover { text-decoration: none !important; } :focus { outline: none; border: 0; }
            body{
                background: url('{{url('public/img/tinder_banner-view.jpg')}}');
                width:100%;
                height:100%;
                background-size: cover;
            }
            .backgroundGray{
                background:#dddddd;
            }
            .all-member p:last-child{
                background: #df314d;
                position: relative;
                margin-bottom: 0px;
                border-radius: 2px;
            }
            .all-member p:last-child:before {
                left: -10px;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 12.5px 21.7px 12.5px 0;
                border-color: transparent #df314d transparent transparent;
                position: absolute;
                content: "";
            }
            .w-40{

            }
            .fontStyle{
                font-weight:bold;
            } 
            .col {
                flex-basis: 0;
                flex-grow: 1;
                min-width: 0;
                max-width: 100%;
            }
            .col-md-auto {
                flex: 0 0 auto;
                max-width: none;
            }
            .row {
                display: flex;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }
            .custom-padding-shadow {
                
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                background-color: #f3f3f3;
            }
            .justify-content-md-center {
                justify-content: center;
            }
            .content-box
            {
                padding:0px 19px 10px;  
            }

        </style>
    </head>
    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background: #f2f3f8;" bgcolor="#eaeeef" leftmargin="0">
        <!--100% body table--> 
        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
            <tr>
                <td>
                    @yield('email-content')
                </td>
            </tr>
        </table>
    </body>
</html>