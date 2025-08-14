@extends('layouts.app')
@section('content')
    <style>
        body{
            height: auto;
            color: #000;
        }
        main
        {
            background: url('public/pictures/Background2.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
        }
        .card{
            background-color: #222222e6;
        }
        .card .body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 40px;
        color: #333;
        }
        h1 {
        text-align: left;
        margin-bottom: 40px;
        color:#fff;
        font-family: 'CambriaItalic', serif;
        }
        h2,h2 strong {
        margin-top: 20px;
        color: #444;
        font-size: 2.0rem;
        line-height: 0.8;
        color:#fff;
        margin-bottom: 20px;
        font-family: 'AvenirNext', sans-serif;
        }
        .p0{
        color:#fff;  
        line-height: 1.0;
        font-family: 'FutureBTBook', sans-serif;
        }
        .p1 {
        margin: 0px 38px;
        color:#fff;
        line-height: 1.0;
        font-family: 'FutureBTBook', sans-serif;
        }
        .p2 {
        margin: 0px 34px;
        color:#fff;
        line-height: 1.0;
        font-family: 'FutureBTBook', sans-serif;
        }
        .custom-heading{
            margin-bottom: 0.5rem;
            font-weight: unset;
            margin-top: 20px;
            color: #444;
            font-size: 1.1rem;
            line-height: 0.5;
            color:#fff;
            font-family: 'FutureBTBook', sans-serif;
        }
        span{
            color:#fff;
        }
        ul li,ol li{
            color:#fff;
            font-family: 'FutureBTBook', sans-serif;
        }
        strong,p{
            color:#fff;
        }
    </style>
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        @if ($data)
                            {!! $data->content !!}
                        @else
                            <p>No privacy policy available in your language.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
