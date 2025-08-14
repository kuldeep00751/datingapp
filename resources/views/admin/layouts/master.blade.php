<!DOCTYPE html>
<html lang="en" >
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
      <link rel="icon" type="image/png" href="">
      <title>
         Dating APP
      </title>
      <!--     Fonts and icons     -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
      <!-- Nucleo Icons -->
      <link href="{{ asset('css/nucleo-icons.css')}}" rel="stylesheet" />
      <link href="{{ asset('css/nucleo-svg.css')}}" rel="stylesheet" />
      <!-- Font Awesome Icons -->
      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
      <!-- CSS Files -->
      <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css')}}" rel="stylesheet" />
      <link id="pagestyle" href="{{ asset('css/app.css')}}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
      <link rel="stylesheet" href="sweetalert2.min.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- <link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
         <link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" /> -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
      <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR0ZD6kb3cYmfrfVAnwsaVMPofokb_MKY&libraries=places&callback=initialize" type="text/javascript"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <style type="text/css" id="notify-bootstrap">
         .notifyjs-bootstrap-base {
         font-weight: bold;
         padding: 8px 15px 8px 14px;
         text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
         background-color: #fcf8e3;
         border: 1px solid #fbeed5;
         -webkit-border-radius: 4px;
         -moz-border-radius: 4px;
         border-radius: 4px;
         white-space: nowrap;
         padding-left: 25px;
         background-repeat: no-repeat;
         background-position: 3px 7px;
         }
         .notifyjs-bootstrap-error {
         color: #B94A48;
         background-color: #F2DEDE;
         border-color: #EED3D7;
         background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=);
         }
         .notifyjs-bootstrap-success {
         color: #468847;
         background-color: #DFF0D8;
         border-color: #D6E9C6;
         background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==);
         }
         .notifyjs-bootstrap-info {
         color: #3A87AD;
         background-color: #D9EDF7;
         border-color: #BCE8F1;
         background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=);
         }
         .notifyjs-bootstrap-warn {
         color: #C09853;
         background-color: #FCF8E3;
         border-color: #FBEED5;
         background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC);
         }
      </style>
      <style type="text/css" id="core-notify">
         .notifyjs-corner {
         position: fixed;
         margin: 5px;
         z-index: 1050;
         }
         .notifyjs-corner .notifyjs-wrapper,
         .notifyjs-corner .notifyjs-container {
         position: relative;
         display: block;
         height: inherit;
         width: inherit;
         margin: 3px;
         }
         .notifyjs-wrapper {
         z-index: 1;
         position: absolute;
         display: inline-block;
         height: 0;
         width: 0;
         }
         .notifyjs-container {
         display: none;
         z-index: 1;
         position: absolute;
         }
         .notifyjs-hidable {
         cursor: pointer;
         }
         [data-notify-text],[data-notify-html] {
         position: relative;
         }
         .notifyjs-arrow {
         position: absolute;
         z-index: 2;
         width: 0;
         height: 0;
         }
         .table-responsive {
         overflow-y: hidden;
         }
         @media (max-width: 768px)
         {
         .navbar-collapse .navbar-nav .nav-item.dropdown .dropdown-menu
         {
         position: absolute;
         top: 26px;
         background: #fff;
         }
         }
         @media (min-width: 1200px) {
         .sidenav.fixed-start+.main-content {
         margin-left: 15.7rem;
         margin-top: 0px !important;
         }
         }
         .nav-item .badgetoggle {
         position: absolute !important;
         top: -8px !important;
         right: 0px !important;
         background-color: #ff0a0ad1;
         color: white;
         padding: 5px 0px;
         font-size: 10px;
         font-weight: bold;
         border-radius: 50%;
         line-height: 1;
         display: inline-block;
         width: 20px;
         height: 20px;
         }
      </style>
   </head>
   <body class="g-sidenav-show  bg-gray-100" id="app">
      <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0  fixed-start " style="background-color: #0c213a !important;" id="sidenav-main">
         <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="align-items-center m-0 navbar-brand text-wrap text-dark" href="{{ route('home')}}">
               <h4 class="text-light text-center text-bloder"><img class="text-center" src="https://datingapp.ciws.in/pictures/ISO G.png" width="100"></h4>
            </a>
         </div>
         <hr class="horizontal dark mt-0">
         <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/dashboard')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                           <title>shop </title>
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                 <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                       <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                       <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                    </g>
                                 </g>
                              </g>
                           </g>
                        </svg>
                     </div>
                     <span class="nav-link-text ms-1">Dashboard</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/user-list')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users"></i>
                     </div>
                     <span class="nav-link-text ms-1">User List</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/user-subscription')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users"></i>
                     </div>
                     <span class="nav-link-text ms-1">User Membership</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/review-feedback-list')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users"></i>
                     </div>
                     <span class="nav-link-text ms-1">Review Feedback</span>
                  </a>
               </li>
               <li class="nav-item mt-3">
                  <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Subscription Management</h6>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/subscription-plan')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-star"></i>
                     </div>
                     <span class="nav-link-text ms-1">Plan</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/promocode')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-list"></i>
                     </div>
                     <span class="nav-link-text ms-1">Promo Code</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/legal-contents')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-list"></i>
                     </div>
                     <span class="nav-link-text ms-1">Legal Content</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/quotes')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-list"></i>
                     </div>
                     <span class="nav-link-text ms-1">Menu Quote</span>
                  </a>
               </li>
               <!-- <li class="nav-item">
                  <a class="nav-link active" href="{{url('admin/features')}}">
                     <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="fa-solid fa-list"></i>
                     </div>
                     <span class="nav-link-text ms-1">Features</span>
                  </a>
                  </li> -->
            </ul>
         </div>
         <div class="sidenav-footer mx-3 ">
         </div>
         </div>
      </aside>
      <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
         <!-- Navbar -->
         <nav class="navbar navbar-main navbar-expand-lg  shadow-none " id="navbarBlur" navbar-scroll="true" style="border-bottom: 1px solid #ccc;">
            <div class="container-fluid py-1 px-3">
               <nav aria-label="breadcrumb">
                  <h6 class="font-weight-bolder mb-0 text-capitalize">
                     @php
                     echo (isset($page_title) && $page_title != '') ? $page_title : '';
                     @endphp
                  </h6>
               </nav>
               <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
                  <ul class="navbar-nav  justify-content-end">
                     <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                           <div class="sidenav-toggler-inner">
                              <i class="sidenav-toggler-line"></i>
                              <i class="sidenav-toggler-line"></i>
                              <i class="sidenav-toggler-line"></i>
                           </div>
                        </a>
                     </li>
                     <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('img/pexels-bokeh.jpeg') }}" class="avatar avatar-sm me-3">
                        <span class="d-sm-inline d-none">{{auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                           <li class="mb-2">
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                                 <div class="d-flex py-1">
                                    <div class="my-auto">
                                       <!-- <img src="{{asset('img/pexels-bokeh.jpeg')}}" class="avatar avatar-sm  me-3 "> -->
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                       <h6 class="text-sm font-weight-normal mb-1">
                                          <span class="font-weight-bold">{{Auth::guard('admin')->user()->first_name}}</span>
                                       </h6>
                                       <p class="text-xs text-secondary mb-2">
                                          <!-- <p class="text-xs text-secondary mb-0">
                                             <i class="fa fa-clock me-1"></i>
                                             
                                             13 minutes ago
                                             
                                             </p> -->
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="mb-2">
                              <a class="dropdown-item border-radius-md" href="{{url('admin/profile')}}">
                                 <div class="d-flex py-1">
                                    <!-- <div class="my-auto">
                                       <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                       
                                             <title>Edit profile</title>
                                       
                                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       
                                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                       
                                                   <g transform="translate(1716.000000, 291.000000)">
                                       
                                                      <g transform="translate(1.000000, 0.000000)">
                                       
                                                         <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                       
                                                         <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                       
                                                         <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                       
                                                      </g>
                                       
                                                   </g>
                                       
                                                </g>
                                       
                                             </g>
                                       
                                          </svg>
                                       
                                       </div> -->
                                    <div class="d-flex flex-column justify-content-center">
                                       <h6 class="text-sm font-weight-normal mb-1">
                                          <span class="font-weight-bold">Edit Profile
                                       </h6>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item border-radius-md" href="{{ route('admin.logout') }}">
                                 <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                       <svg
                                          width="12px"
                                          height="12px"
                                          viewBox="0 0 43 36"
                                          version="1.1"
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          >
                                          <title>logout</title>
                                          <!-- Your credit card icon path (assuming it's the same) -->
                                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                             <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                   <g transform="translate(453.000000, 454.000000)">
                                                      <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                      <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                                   </g>
                                                </g>
                                             </g>
                                          </g>
                                          <!-- Logout icon path -->
                                          <g transform="translate(0, 36)">
                                             <path d="M6 0C2.7 0 0 2.7 0 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zM8 4H2.7L4.4 2.3 3 1l-5 5 5 5 1.4-1.4L2.7 6H8V4z"></path>
                                          </g>
                                       </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                       <h6 class="text-sm font-weight-normal mb-1">
                                          Sign Out
                                       </h6>
                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                          @csrf
                                       </form>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0 mt-2" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" onclick="loadNotifications()">
                        <i class="fa fa-bell cursor-pointer" style="font-size:24px !important;"></i><span class="badge badgetoggle" id="notificationBadge" class="badge">{{ getAdminUnseenNotification() }}</span>
                        </a>
                        <ul id="Admin-notification" class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4 Admin-notification" aria-labelledby="dropdownMenuButton" style="overflow-y: auto;height: 300px; width:22rem;">
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
         <!-- End Navbar -->                
         @yield('content')
      </main>
      @extends('admin.layouts.pageFooter')
      @extends('admin.layouts.footer')
      <script>
         const userloginId = {{ auth()->guard('admin')->user()->id }};
         
         // Initialize Laravel Echo
         window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ config('broadcasting.connections.pusher.key') }}',
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            forceTLS: true
         });
         
         // Listen for 'UnseenMessagesUpdated' event
         // window.Echo.channel('UnseenMessage')
         // .listen('UnseenMessagesUpdated', (event) => {
         //    const badge = document.getElementById('unseen-count');
         //    const unseenData = event.unseenCount;
         //    const senderId = event.userId;
            
         //    if (badge && unseenData !== '' && senderId == userloginId) {
         //       badge.textContent = unseenData;
         //    }
         // });
         
         // // Listen for 'UnseenMessagesUpdated' event
         // window.Echo.channel('UnseenNotification')
         // .listen('NotificationEvent', (event) => {
           
         //    const notification = document.getElementById('notificationBadge');
         //    const unseenNotification = event.unseenNotiCount;
         //    const senderUserId = event.userId;
            
         //    if (notification && unseenNotification !== '' && senderUserId == userloginId) {
         //       notification.textContent = unseenNotification;
         //    }
         // });
         
         function loadNotifications() {
            $.ajax({
                  url: '{{ route("admin.notifications.fetch") }}',
                  type: 'GET',
                  success: function(response) {
         
                     let notificationcount = 0;
                     if (response.notifications.length > 0) {
                        let notificationHtml = '';
                        const notificationcount = response.notifications.length;
                        response.notifications.forEach(function(notification) {
                           let imageUrl = notification.profile_picture 
                                          ? '{{ asset('storage') }}' + '/' + notification.profile_picture 
                                          : (notification.avatar || '{{ url('pictures/default.png') }}');
                           const userProfileRoute = "";
                           let profileUrl = userProfileRoute.replace(':id', notification.id);
                           let links = notification.link;
                         
                           let messageRead = "Unread message";
         
                           if (notification.read === 1) {
                              messageRead = "Read message"; 
                           }
                              notificationHtml += `
                                 <li class="mb-2">
                                 <a class="dropdown-item border-radius-md" href="javascript:;" onclick="return allReadAndRedirect('${notification.id}','${profileUrl}','${links}')" style="cursor: pointer;padding: 0.2rem 0.5rem !important;">
                                 <div class="d-flex py-1">
                                    <div class="my-auto">
                                       <img src="${imageUrl}" class="avatar avatar-sm  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                       <h6 class="text-sm font-weight-normal mb-1" style="word-wrap: break-word;overflow-wrap: break-word;white-space: normal;">
                                          <span class="font-weight-bold">${notification.message}</span>
                                       </h6>
                                       <p class="text-xs text-secondary mb-0">
                                          <span class="float-left"><i class="fa fa-clock me-1"></i>${timeAgo(notification.senddate)} </span><span class="float-right">${messageRead}</span>
                                       </p>
                                    </div>
                                 </div>
                              </a>
                                   
                           </li>
                           <hr>`;
                        });
                        $('.Admin-notification').html(notificationHtml);
                        $('.notificationcount').html(notificationcount);
                     } else {
                        $('.Admin-notification').html('<li class="p-2" style="text-align:center;margin-left: 2rem;margin-right: 2rem;">No new notifications</li>');
                        $('.notificationcount').html(notificationcount);
                     }
                  },
                  error: function(xhr, status, error) {
                     console.error(error);
                  }
            });
         }
         
         function allReadAndRedirect(notificationId, profileUrl, links) {
            $.ajax({
               url: '{{ route("admin.notifications.markAsRead") }}',
               type: 'POST',
               data: {
                     _token: '{{ csrf_token() }}',
                     user_id:notificationId
               },
               success: function(response) {
                
                  if (links && links !== 'null') {
                     window.location.href = links;
                  } else {
                     window.location.href = profileUrl;
                  }
               },
               error: function(xhr, status, error) {
                     console.error(error);
               }
            });
         };
         
         function timeAgo(dateString) {
            
            const now = new Date();
            const then = new Date(dateString);
            
            const seconds = Math.floor((now - then) / 1000);
         
            const intervals = [
               { label: 'year', seconds: 31536000 },
               { label: 'month', seconds: 2592000 },
               { label: 'day', seconds: 86400 },
               { label: 'hour', seconds: 3600 },
               { label: 'minute', seconds: 60 },
               { label: 'second', seconds: 1 }
            ];
         
            for (let i = 0; i < intervals.length; i++) {
               const interval = intervals[i];
               if (seconds >= interval.seconds) {
                     const amount = Math.floor(seconds / interval.seconds);
                     return `${amount} ${interval.label}${amount !== 1 ? 's' : ''} ago`;
               }
            }
         
            return "just now";
         }
      </script>
   </body>
</html>