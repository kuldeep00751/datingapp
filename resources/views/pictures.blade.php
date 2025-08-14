@extends('layouts.app')

@section('content')

    <style>
        body {
            background: url('{{url('public/img/profile_users.jpg')}}');
        }

        .user-picture:hover {
            opacity: 0.7;
            cursor: pointer;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$user->name}}'s Gallery</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach($pictures as $picture)

                            @if(substr( $picture->picture_location, 0, 4 ) === "http")
                                <img class="myImg user-picture pb-1" src="{{$picture->picture_location}}"
                                     alt="{{$picture->name}}"
                                     width="30%"
                                     height="200px"/>
                            @else
                                <img class="myImg user-picture pb-1" src="{{$picture->getPicture()}}"
                                     alt="{{$picture->name}}"
                                     width="30%"
                                     height="200px"/>
                            @endif

                            <div id="myModal" class="modal">
                                <span class="close">&times;</span>
                                <img class="modal-content" id="img01">
                                <div id="caption"></div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let modal = document.getElementById("myModal");

        let img = document.getElementsByClassName("myImg");
        let modalImg = document.getElementById("img01");
        let captionText = document.getElementById("caption");

        for (let i = 0; i < img.length; i++) {
            img[i].onclick = showCaption;
        }

        function showCaption() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        let span = document.getElementsByClassName("close")[0];

        span.onclick = function () {
            modal.style.display = "none";
        }
    </script>
@endsection
