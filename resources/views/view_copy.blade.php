@extends('layouts.app')

@section('content')

<head>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <?php

      $pictures = $user->pictures()->get(); // Fetch user's pictures

      if ($pictures->isNotEmpty()) {

         $anotherPic = ''; // Default value

         foreach ($pictures as $picture) {

            if ($picture->picture_location != $user->profile_picture) {

               $anotherPic = $picture->picture_location; // Assign alternative picture

               break; // Stop after finding the first alternative picture

            }

         }

      

         // If no alternative picture was found, use profile picture

         if (empty($anotherPic)) {

               $anotherPic = $user->profile_picture ?? '';

         }

      } else {

         $anotherPic = ''; 

      }

      ?>

   <style>

      

      body {

        background: url('{{ asset('pictures/ChatGPT Image.png') }}') no-repeat center center;

         background-size: cover;

         background-attachment: fixed;

      }

      main {

         margin-top: 0px !important;

         padding-top: 0px !important;

      }

      .py-4{

      padding-top:0px !important;

      padding-bottom:0px !important;

      }

      .item-header-content {

      width: 100%;

      margin: 0 auto;

      }

      .item-user-profile-cover-img {

      height: 100px;

      width: 100%;

      object-fit: cover;

      }

      .item-hdr-v1 .item-cover-content .item-inner-content {

      z-index: 9;

      width: 100%;

      bottom: 30px;

      position: absolute;

      }

      .item-hdr-v1 .item-profile-photo {

      position: relative;

      z-index: 999999;

      height: 160px;

      width: 160px;

      float: left;

      }

      .item-photo-border {

      background: transparent !important;

      }

      .item-photo-circle img {

      -webkit-border-radius: 100%;

      -moz-border-radius: 100%;

      -ms-border-radius: 100%;

      -o-border-radius: 100%;

      border-radius: 100%;

      }

      .item-user-statistics {

      top: 50%;

      z-index: 9998;

      position: absolute;

      -webkit-transform: translateY(-50%);

      transform: translateY(-50%);

      }

      .item-head-content {

      float: left;

      margin-left: 15px;

      margin-top: 128px;

      }

      .item-cover-content{

      width: 100%;

      margin: 0 auto;

      }

      .lazyloaded {

      opacity: 1;

      transition: opacity .3s;

      }

      .item-header-cover {

      position: relative;

      background-position: center;

      }

      .item-header-overlay .item-header-cover:before {

      opacity: .8;

      z-index: 5;

      }

      .item-header-cover:after, .item-header-cover:before {

      top: 0;

      left: 0;

      z-index: 0;

      content: "";

      width: 100%;

      height: 100%;

      position: absolute;

      } 

      .item-hdr-v1 .item-header-cover, .item-hdr-v2 .item-header-cover {

      font-size: 22px;

      color: #fff;

      }

      .item-user-ratings-details {

      z-index: 9;

      margin-top: 15px;

      position: relative;

      }

      .item-user-ratings-details .item-separator, .item-user-ratings-details .item-user-rating-stars, .item-user-ratings-details .item-user-ratings-rate, .item-user-ratings-details .item-user-ratings-total {

      vertical-align: middle;

      display: inline-block;

      }

      .item-hdr-v1 .item-user-statistics {

      right: 0;

      }

      .item-profile-header .item-user-statistics li {

      min-width: 65px;

      }

      .item-user-statistics li {

      color: #fff;

      padding: 0 20px;

      text-align: center;

      display: inline-block;

      text-transform: uppercase;

      }

      .item-hdr-v1 .item-cover-content .item-head-content, .item-hdr-v1 .item-user-statistics {

      top: 50%;

      z-index: 9998;

      position: absolute;

      -webkit-transform: translateY(-50%);

      transform: translateY(-50%);

      }

      .item-hdr-v1 .item-cover-content .item-head-content {

      /* float: left; */

      margin-left: 185px;

      }

      .item-user-statistics ul {

      margin: 0;

      }

      .youzify li, .youzify ul {

      margin: 0;

      padding: 0;

      list-style: none;

      }

      .item-user-statistics li a{

      color: #fff;

      padding: 0 20px;

      text-align: center;

      display: inline-block;

      text-transform: uppercase;

      }

      .item-usermeta ul{

      padding-left: 0px;

      }

      .item-usermeta li{

      list-style:none;

      }

      .item-account-verified{

      border: 3px solid #56f756;

      border-radius: 50%;

      font-size: 15px;

      margin: 6px;

      color: #56f756;

      padding: 2px 2px;

      }

      #item-profile-navmenu {

      z-index: 1;

      height: initial;

      line-height: initial;

      position: relative;

      background-color: var(--yzfy-card-bg-color);

      }

      #item-profile-navmenu .item-inner-content{

      width: 100%;

      margin: 0 auto;

      display: table;

      position: relative;

      }

      .fadeIn {

      -webkit-animation-name: fadeIn;

      animation-name: fadeIn;

      }

      .bounceInLeft, .bounceInRight, .fadeIn, .fadeInDown, .fadeInLeft, .fadeInRight, .fadeInUp, .fadeInUpDelay {

      visibility: visible;

      }

      article, aside, details, figcaption, figure, footer, header, main, menu, nav, section, summary {

      display: block;

      }

      .item-profile-navmenu {

      margin: 0 auto;

      position: relative;

      display: -webkit-flex;

      display: flex;

      -webkit-flex-wrap: wrap;

      flex-wrap: wrap;

      float: right;

      }

      .item-profile-navmenu > ul {

      list-style: none;

      }

      .item-profile-navmenu > li {

      margin: 0;

      float: left;

      text-align: center;

      position: relative;

      margin: 0;

      padding: 0;

      list-style: none;

      font-weight: 300;

      font-size: 17px;

      }

      .item-navbar-item a {

      color: #848b92;

      cursor: pointer;

      font-weight: 600;

      line-height: 22px;

      font-size: 16px;

      padding: 26px 25px;

      display: inline-block;

      text-transform: uppercase;

      -webkit-user-select: none;

      -moz-user-select: none;

      -ms-user-select: none;

      user-select: none;

      -webkit-touch-callout: none;

      -khtml-user-select: none;

      -webkit-tap-highlight-color: transparent;

      min-width: 130px;

      }

      li a:hover {

      color: #ff3535 !important;

      }

      .item-navbar-item a i {

      margin: 0 10px 0 0;

      color: 14px;

      font-weight: 700;

      }

      .item-navbar-item.item-active-menu {

      border-color: #ff3535 !important;

      border-bottom: 4px solid;

      }

      .item-page-main-content {

      margin: auto;

      padding: 0 0 0px;

      /* max-width: 1170px; */

      max-width: 1050px;

      position: relative;

      }

      .item-right-sidebar-layout {

      grid-template-columns: calc(72% - 35px) 28%;

      }

      .item-left-sidebar-layout, .item-right-sidebar-layout {

      display: grid

      ;

      grid-gap: 35px;

      }

      .item-white-bg{

      box-shadow: 0 0 20px rgb(0 0 0 / 10%);

      -webkit-box-shadow: 0 0 20px rgb(0 0 0 / 10%);

      }

      .item-widget .item-widget-main-content {

      width: 100%;

      z-index: 9999;

      color: #8d8c8c;

      }

      .item-widget .item-widget-head {

      border-bottom: 1px solid #dddcdc;

      }

      .item-widget .item-widget-title {

      margin: 0;

      color: #333;

      font-size: 18px;

      font-weight: bold;

      line-height: 35px;

      padding: 15px 35px;

      margin-bottom: 0px !important;

      }

      .item-wg-title-icon-bg .item-widget-title i {

      width: 35px;

      height: 35px;

      line-height: 35px;

      margin-right: 10px;

      text-align: center;

      background-color: #ff3131;

      color: #ffffff;

      border-radius: 100%;

      }

      .item-infos-content{

      padding: 400px 240px 500px;

      }

      .item-infos-content .item-infos-item {

      padding-bottom: 0px;

      display:flex;

      }

      .item-infos-content .item-info-label {

      color: #000;

      font-size: 14px;

      font-weight: 600;

      min-width: 160px;

      margin-right: 1rem;

      }

      .item-infos-content .item-info-data {

      text-align: left;

      line-height: 22px;

      vertical-align: top;

      /* width: calc(100% - 180px); */

      }

      .item-user-img img {

      width: 180px;

      height: 200px;

      margin: 12px 35px;

      }

      .item-default-content{

      padding:35px;

      }

      .item-profile-sidebar .item-aboutme-container {

      text-align: center;

      }

      .item-navbar-item.item-active-menu a{

      color: #ff3535 !important;

      }

      .item-aboutme-name {

      color: #000;

      font-size: 18px;

      font-weight: bold;

      line-height: 24px;

      letter-spacing: .02em;

      text-transform: uppercase;

      }

      .item-aboutme-description{

      font-size: 13px;

      }

      .item-aboutme-head:after {

      margin: 23px auto 23px;

      content: "";

      width: 50px;

      height: 4px;

      display: block;

      margin-top: 24px;

      background-color: #f0f0f0;

      }

      .item-widget {

      position: relative;

      margin-bottom: 35px;

      }

      .item-media-box {

      padding-top: 5px;

      background-color: #f4f4f4;

      display: block !important;

      }

      .item-media-filter {

      padding: 0 5px;

      overflow: hidden;

      background: #f4f4f4;

      }

      .item-media-filter .item-filter-item {

      width: 20%;

      float: left;

      display: block;

      padding: 4px;

      }

      .item-filter-content{

      background-color: #ff3535 !important;

      color: #ffffff !important;

      width: 100%;

      padding: 12px 5px;

      color: #898989;

      cursor: pointer;

      text-align: center;

      border-radius: 3px;

      }

      .item-filter-item .item-filter-content i {

      font-size: 15px;

      margin-bottom: 8px;

      display: block;

      }

      .item-media-widget .item-media-group-photos .item-media-item, .item-media-widget .item-media-group-videos .item-media-item {

      /* width: calc(33.33% - 6.66px); */

      /* margin: 5px 10px 5px 0; */

      }

      .item-media-widget .item-media-item {

      margin: 0;

      float: left;

      /* width: 33.33%; */

      text-align: left;

      position: relative;

      border: 3px solid #fff;

      }

      .item-media-item .item-media-item-img img, .item-media-item-video video {

      top: 0;

      bottom: 0;

      left: 0;

      right: 0;

      width: 96px;

      height: 95px;

      object-fit: cover;

      object-position: center;

      display: flex

      ;

      flex-wrap: wrap;

      }

      .item-media-item .item-media-item-tools {

      text-align: center;

      top: calc(50% - 10px);

      z-index: 9;

      cursor: pointer;

      position: absolute;

      top: calc(50% - 22px);

      left: 0;

      right: 0;

      }

      .item-media-widget-content{

      padding: 0 10px 5px;

      overflow: hidden;

      }

      .item-media-view-all {

      color: #898989;

      display: block;

      font-size: 13px;

      font-weight: 600;

      background: #fff;

      padding: 20px 0;

      text-align: center;

      }

      .item-media-item-tools{

      position: absolute;

      top: 2rem;

      left: 1rem;

      }

      .item-media-post-link{

      color: #fff;

      width: 45px;

      height: 45px;

      margin: auto;

      line-height: 45px;

      text-align: center;

      border-radius: 100%;

      background: rgba(0, 0, 0, .3);

      }

      .tab-content-data {

      display: none;

      }

      .tab-content-data.active {

      display: block;

      }

      .item-media-head{

      background: url(https://qiupid.modeltheme.com/wp-content/plugins/youzify/includes/public/assets/images/pattern.svg), linear-gradient(to right, #ff3131, #ff3131);

      }

      .item-media-title{

      color: #fff;

      padding: 10px !important;

      }

      .item-media-title .fontview{

      background: #514A9D;

      }

      .item-media-group-content .item-media-item {

      width: calc(25% - 10px);

      margin-right: 13px;

      margin-bottom: 12.5px;

      border: 6px solid #fff;

      }

      .item-media-item-img-data{

      position:absolute;

      }

      .item-media-item-tools-data {

      position: relative;

      top: -7rem;

      left: 6rem;

      }

      .item-media-group, .item-media-4columns .item-media-group {

      margin-bottom: 22.5px;

      }

      .media-content .item-media-item .item-media-item-img img {

      top: 0;

      bottom: 0;

      left: 0;

      right: 0;

      width: 100%;

      height: 100%;

      object-fit: cover;

      position: absolute;

      object-position: center;

      }

      .media-content .item-media-item .item-media-item-img .item-media-item-tools {

      z-index: 9;

      cursor: pointer;

      text-align: center;

      top: calc(50% - 10px);

      z-index: 9;

      cursor: pointer;

      position: absolute;

      top: calc(50% - 22px);

      left: 0;

      right: 0;

      }

      .media-content .item-media-item .item-media-item-tools {

      text-align: center;

      top: calc(50% - 10px);

      z-index: 9;

      cursor: pointer;

      position: absolute;

      top: calc(50% - 22px);

      left: 0;

      right: 0;

      }

      .media-content .item-media-item {

      width: calc(25% - 0px);

      margin-right: 0px;

      margin-bottom: 12.5px;

      border: 6px solid #fff;

      display: block;

      float: left;

      position: relative;

      }

      .media-content .item-media-item-img {

      position: relative;

      padding-top: 100%;

      display: block;

      }

      .item-media-item {

      position: relative;

      display: inline-block;

      }

      .item-media-item-img {

      display: block;

      width: 100%;

      }

      .item-media-post-link {

      position: absolute;

      bottom: 0px;

      left: 0px;

      background-color: rgba(0, 0, 0, 0.7);

      color: white;

      padding: 0px 10px;

      text-decoration: none;

      font-size: 14px;

      transition: opacity 0.3s ease;

      right: 0px;

      top: 15px;

      opacity: 0;

      }

      .item-media-item:hover .item-media-post-link  {

      opacity: 1;

      }

      .iteminnercontent 

      {

      position: absolute;

      top: -120px;

      left: 12px;

      z-index: 9;

      }

      .youzify-name h2 

      {

      font-weight: bolder;

      margin: 0px;

      font-size: 24px;

      text-transform: uppercase;

      }

     

      .heading{

      background: #e7e7e7;

      padding-right: 5rem ;

      padding-top: 10px !important;

      padding-bottom: 10px !important;

      padding-left: 5px !important;

      }

      .heading-span{

      font-size: 18px;

      }

      .item-meta-item {

      color: #898989;

      display: block;

      font-size: var(--yzfy-big-font-size);

      margin-top: 10px;

      }

      .item-user-statistics {

      padding: 0 0px;

      margin-bottom: 25px;

      display:inline-flex;

      }

      .item-user-statistics .item-data-item:nth-child(1) span {

      background-color: #ffc107;

      }

      .item-data-item span {

      color: #fff;

      width: 35px;

      margin: 3px;

      height: 35px;

      display: block;

      font-size: 20px;

      line-height: 35px;

      text-align: center;

      background-color: #eee;

      border-radius: 5px;

      }

      .page-img-bottom {

      position: absolute;

      bottom: 0px;

      height: 475px;

      width: auto !important;

      right: 0px;

      }

      .page-img-top1 {

      /* height: 240px; */

      position: absolute;

      top: 0px;

      left:0px;

      width: 18%;

      }

      .page-img-top {

      height: 240px;

      position: absolute;

      top: 0px;

      left:0px;

      /* width: 50%; */

      }

      #page-31,#page-32

      {

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      min-height: 1500px;

      }

     

      #page-31 h2, #page-31 p,#page-32 h2

      {

      color: #fff;

      font-size: 6rem;

      font-family: "AvenirNext", sans-serif;

      }

      #page-31 .page-img-logo 

      {

      position: absolute;

      width: 69px;

      background: #a3d2f7;

      padding: 60px 0px;

      top: 0px;

      }

      #page-31 .page-img-logo1 

      {

      position: absolute;

      top: 0px;

      }

      #page-32 h1 {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 98px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }

      #page-32

      {

      background: #000000ba;

      height: 1650px;

      background-size: 100% 100%;

      display: flex;

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      }

      #page-32 h2 b {

      font-size: 70px;

      font-family: 'CambriaItalic', serif;

         letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-32 .title-32  {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      font-style:normal;

      line-height: 1;

      }

      #page-32 p strong   {

      font-size: 30px;

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      line-height: 1.1;

      }

      #page-33

      {

      background: url('{{ $user->profile_picture ? url('storage/' . $user->profile_picture) : ($user->avatar ?: url('pictures/default.png')) }}');

      height: 1650px;

      background-size: cover;

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      min-height: 1500px;

      background-position: center;

      }

      #page-33::before 

      {

      content: "";

      height: 100%;

      width: 100%;

      background: #000000ba;

      position: absolute;

      z-index: 0;

      }

      #page-33 h1 {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 72px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }    

      #page-33 h2 b {

      color:#fff;

      font-size: 70px;

      font-family: 'CambriaItalic', serif;

      letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-33 .title-32  {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      font-style:normal;

      line-height: 1;

      }

      #page-33 p strong   {

      font-size: 30px;

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      line-height: 1.1;

      }

      #page-33 .item-infos-content {

      
      position: relative;

      }

      #page-34

      {

      background: url('{{ $user->profile_picture ? url('storage/' . $user->profile_picture) : ($user->avatar ?: url('pictures/default.png')) }}');

      height: 1650px;

      background-size: cover;

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      background-position: center;

      }

      #page-34::before 

      {

      content: "";

      height: 100%;

      width: 100%;

      background: #000000ba;

      position: absolute;

      z-index: 0;

      }

      #page-34 h1 {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 72px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }    

      #page-34 h2 b {

      color:#fff;

      font-size: 70px;

      font-family: 'CambriaItalic', serif;

      letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-34 .title-32  {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      font-style:normal;

      line-height: 1;

      }

      #page-34 p strong   {

      font-size: 30px;

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      line-height: 1.1;

      }

      #page-34 .item-infos-content {

      padding: 400px 240px 500px;

      position: relative;

      }

      #page-35

      {

      background: url('{{ $user->profile_picture ? url('storage/' . $user->profile_picture) : ($user->avatar ?: url('pictures/default.png')) }}');

      height: 1650px;

      background-size: cover;

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      min-height: 1500px;

      background-position: center;

      }

      #page-35::before 

      {

      content: "";

      height: 100%;

      width: 100%;

      background: #000000ba;

      position: absolute;

      z-index: 0;

      }

      #page-35 h1 {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 72px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }    

      #page-35 h2 b {

      color:#fff;

      font-size: 70px;

      font-family: 'CambriaItalic', serif;

      letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-35 .title-32  {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      font-style:normal;

      line-height: 1;

      }

      #page-35 p strong   {

      font-size: 30px;

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      line-height: 1.1;

      }

      #page-35 .item-infos-content {

      padding: 400px 240px 500px;

      position: relative;

      }

      #page-36

      {

      background: url('{{ $user->profile_picture ? url('storage/' . $user->profile_picture) : ($user->avatar ?: url('pictures/default.png')) }}');

      background-size: cover;

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      min-height: 1500px;

      background-position: center;

      }

      #page-36 h1 {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 72px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }    

      #page-36 h2 b {

      color:#fff;

      font-size: 70px;

      font-family: 'CambriaItalic', serif;

      letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-36 .title-32  {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      

      font-style:normal;

      line-height: 1;

      }

      #page-36 p strong   {

      font-size: 30px;

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      line-height: 1.1;

      }

      #page-36 .item-infos-content {

      padding: 500px 240px 800px;

      position: relative;

      }

      #page-37

      {

      /* background: url('{{ $user->profile_picture ? url('storage/' . $user->profile_picture) : ($user->avatar ?: url('pictures/default.png')) }}');*/

      background: url('{{ url('feedback_Icons/feedback-background-img.png') }}');

      height: 1650px;

      background-size: cover;

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      min-height: 1500px;

      background-position: center;

      }

      #page-37::before 

      {

      content: "";

      height: 100%;

      width: 100%;

      background: #000000b5;

      position: absolute;

      z-index: 0;

      }

      #page-37 h1 {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 72px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }    

      #page-37 h2 b {

      font-size: 70px;

      font-family: 'AvenirNext', serif;

      color: #ffffff66;

      letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-37 .title-32  {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      line-height: 1;

      font-style:normal;

      }

      #page-37 p strong   {

      font-size: 30px;

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      line-height: 1.1;

      }

      #page-37 .item-infos-content {

      padding: 250px 70px 750px;

      position: relative;

      }

      #page-37 .sub-title-37 {

      color: #cccccc9c;

      font-size: 30px;

      line-height: 0.2;

      padding-bottom: 5rem;

      font-family: 'AvenirNext', sans-serif;

      }

      #page-37 i {

      font-size: 50px;

      color: #fff;

      text-align: center;

      }

      #page-37 .feedback-img {

         width: 47px;

         height: 47px;

         color: #fff;

         text-align: center;

      }

      #page-37 .tl-37

      {

         font-size: 32px;

         font-weight: 100;

         font-family: 'AvenirNext', sans-serif;

         font-style: normal;

         color: #666666;

         margin-bottom: 0px;

         line-height: 1;

      }

      #page-37 .sub-37

      {

      font-size: 20px;

      color: #fff;

      line-height:1;

      margin-bottom: 30px;

      font-family: 'FutureBTBook', sans-serif;

      }

      #page-37 .box-imge {

     

      }

      #page-38

      {

      background: url('{{ $anotherPic ? url('storage/' . $anotherPic) : ($user->avatar ?: url('pictures/default.png')) }}');

      background-size: cover;

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      min-height: auto;

      background-position: center;

      }

      #page-38::before 

      {

      content: "";

      height: 100%;

      width: 100%;

      background: #0000008c;

      position: absolute;

      z-index: 0;

      }

      #page-38 h1 

      {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 72px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }    

      #page-38 h2 b 

      {

      color:#fff;

      font-size: 70px;

      font-family: 'CambriaItalic', serif;

      letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-38 .title-32  

      {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      font-style:normal;

      line-height: 1;

      }

      #page-38 p strong   

      {

      font-size: 30px;

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      line-height: 1.1;

      }

      #page-38 .item-infos-content 

      {

      padding: 300px 0px 800px;

      position: relative;

      margin-left: 5rem;

      }

      #page-38 .box-imge {

      width: 100px;

      height: 100px;

      margin-bottom: 30px;

      display: flex;

      justify-content: center;

      align-items: center;

      border-radius: 10px;

      margin: 30px;

      }

      #page-38 i 

      {

      font-size: 20rem;

      color: #fff;

      text-align: center;

      cursor: pointer;

      }

      #page-39

      {

      background: url('{{ $anotherPic ? url('storage/' . $anotherPic) : url('pictures/default.png') }}');

      background-size: cover;

      /* display: flex; */

      justify-content: center;

      align-items: center;

      text-align: center;

      position: relative;

      min-height: auto;

      background-position: center;

      }

      #page-39 h1 {

      color:#fff;

      position: absolute;

      top: 35px;

      left: 72px;

      font-size: 70px;

      font-weight: 100;

      font-family: system-ui;

      }    

      #page-39 h2 b {

      color:#fff;

      font-size: 70px;

      font-family: 'CambriaItalic', serif;

      letter-spacing: -2.8px;

         word-spacing: 0.2em;

      }

      #page-39 .title-32  {

      font-size: 35px;

      margin: 0px;

      color: #fff;

      font-family: 'AvenirLight', sans-serif;

      line-height: 1;

      font-style:normal;

      }

      #page-39 p strong   {

      font-size: 30px;

      

      color: #ffffff66;

      font-family: 'AvenirNext', sans-serif;

      font-style:normal;

      line-height: 1.1;

      }

      #page-39 .item-infos-content {

      padding: 500px 240px 800px;

      position: relative;

      }

      .m2{

      margin-bottom: 1.8rem !important;

      line-height: 0.9;

      margin-top: 0.4rem;

      font-style: italic;

      }

      .mr2{

      margin-right: 4rem;

      }

      .mb6{

      margin-bottom: 3rem;

      }

      .text-pink {

      color: #EF2B7C !important;

      }

      .text-custom-primary{

         color: rgb(51, 255, 255) !important;

      }

      .profile-res{

      font-size: 30px;

      font-family: 'FutureBTBook', serif;

      padding-left: 20px;

      padding-right: 20px;

      }

      .icon-container {

      position: relative;

      display: flex;

      justify-content: center;

      align-items: center;

      width: 100px; /* Adjust size as needed */

      height: 80px;

      }

      .thumbs-up {

      background-color: black; /* Circle background */

      color: white; /* Icon color */

      width: 70px;

      height: 70px;

      border-radius: 50%;

      display: flex;

      justify-content: center;

      align-items: center;

      font-size: 40px;

      }

      .stars {

      position: absolute;

      top: -15px; /* Adjust to position above the circle */

      width: 100%;

      display: flex;

      justify-content: center;

      gap: 6px;

      }

      .star {

      color: black;

      font-size: 18px;

      }

      .left-star { transform: translateY(5px) rotate(-15deg); }

      .center-star { transform: translateY(0); }

      .right-star { transform: translateY(5px) rotate(15deg); }

      .step { display: none !important;}

      .step-active { display: flex !important; }

      .buttons { margin-top: 20px; }

      .hidden { display: none !important; }

      .back-btn{ 

      position: absolute;

      top: 0%;

      left: 3rem;

      font-size: 18px;

      font-family: 'AvenirNext', sans-serif !important;

      cursor:pointer;

      height: 100%;

      }

      .next-btn {

         position: absolute;

         top: 0%;

         right: 3rem;

         font-size: 18px;

         font-family: 'AvenirNext', sans-serif !important;

         cursor: pointer;

         height: 100%;

      }

      .next-btn img,.back-btn img{

         width: 5rem !important;

         height: 5rem !important;

         opacity: 0.3;

         /* top: 50%; */

         position: absolute;

         top: 45%;

         right: 0rem;

      }

      .next-btn img:hover,.back-btn img:hover{

      opacity: 1;

      }

      .timer{ 

      position: absolute;

      top: 43%;

      right: 3rem;

      font-size: 5rem;

      color: #fff;

      font-family: 'AvenirNext', sans-serif;

      }

      main

      {

      margin-top: 20px;

      } 



      .buttonload .fa-spinner {

      margin-left: unset !important;

      margin-top: unset !important;

      }

      .comment-checkbox {

      transform: scale(1.5); 

      margin-right: 8px;

      }

      .comment-section{

      color:#fff;

      }

      .comment-section .comment-profile {

      margin-bottom: 0px;

      font-size: 24px;

      border-bottom: 1px solid #fff;

      margin-bottom: 10px;

      }

      .comment-section .comment-description 

      {

      font-size: 16px;

      margin-bottom: 0px;

      font-weight: bold;

      color: #ffffff;

      }

      .comment-section .comment-comments 

      {

      font-size: 16px;

      color: #f1f1f1;

      font-weight: 400 !important;

      }

      .box-2345 

      {

      border: 1px solid #ccc;

      padding: 20px;

      margin-bottom: 20px;

      border-radius: 10px;

      font-family: 'FutureBTBook', sans-serif;

      }

      .comment-section .comment-profile span 

      {

      float: right;

      font-size: 16px;

      font-weight: bold;

      color: #00ff6c;

      text-transform: uppercase;

      font-family: 'FutureBTBook', sans-serif;

      }

      /* b{

         font-weight: 100;

      } */

      .buttonActivity{

         margin-left: 2rem;

         margin-right: 2rem;

      }

      footer{

         display:block !important;

      }

      
      #page-31,#page-32,#page-33,#page-34,#page-35,#page-36,#page-37,#page-38,#page-39{

         min-height:1650px !important;

      }

         #data-refresh1 .buttonActivity img
      {
          width:500px;
      }
      

      @media(max-width: 786px)

      {

         

         .item-widget-content-h1{

            top:1% !important;

            left:19% !important;

         }

         #page-32 h1,#page-33 h1,#page-34 h1,#page-35 h1,#page-36 h1,#page-37 h1,#page-38 h1,#page-39 h1 {

            font-size: 40px;

            top: 35px;

            left: 50px;

         }

         .page-img-top1 {

            position: absolute;

            top: 0px;

            left:0px;

            width: 18%;

         }



         #page-31 .item-infos-content 

         {

             /* position: absolute;

            top: 8rem; */

         }

         .page-img-bottom{

            height: auto;

            width: 100% !important;

         }

         

      }

      item-widget-main-content img{

         width:100%;

      }
      .master-img-200
      {
         width:500px;
      }

      @media(min-width: 787px)

      {

         .item-widget-content-h1{

            top:50px !important;

            left:12rem !important;

         }

         .page-img-top {

            height: 20%;

            left: 0rem;

         }

         #page-32 h1,#page-33 h1,#page-34 h1,#page-35 h1,#page-36 h1,#page-37 h1,#page-38 h1,#page-39 h1 {

            top: 35px !important;

            left: 12rem !important;

            font-size: 70px !important;

         }

         .page-img-top1 {

            position: absolute;

            top: 0px;

            left:0px;

            width: 18%;

         }

         .page-img-bottom{

            /* height: 100vh; */

            /* height: 144px; */

               height: auto;

               width: 100% !important;

         }

         

      }

      @media (max-width: 585px)

      {
          .master-img-200 {
    width: 100%;
}

         .page-img-bottom{

            height: auto;

            width: 100% !important;

         }

         .page-img-top {

            height: 20%;

         }

         #page-32 h1,#page-33 h1,#page-34 h1,#page-35 h1,#page-36 h1,#page-37 h1,#page-38 h1,#page-39 h1 {

            font-size: 30px;

         }



         .feedback-main .feedback-b{

            font-size: 36px;

         }

         .feedback-main .feedback-p{

            font-size: 26px;

         }

         #page-37 .feedback-img {

            width: 40px;

            height: 40px;

         }

         #page-37 .tl-37

         {

            font-size: 18px;

         }

         #page-37 .sub-37

         {

            font-size: 16px;

         }

         #page-37 .sub-title-37 {

         padding-bottom: 2rem;

         }

         .mb6 {

            margin-bottom: 1rem;

         }

      }

       @media(max-width : 768px)

      {

      #item-profile-navmenu .item-inner-content 

      {

      padding-top: 16%;

      }

      .item-left-sidebar-layout, .item-right-sidebar-layout

      {

      display: inherit;

      grid-gap: 0px;

      }

      .media-content .item-media-item 

      {

      display: inline-flex;

      float: inherit;

      }

      }
            
        @media (max-width: 768px)

        {

      .item-infos-content 
      {

      padding: 100px 40px 30px !important;
        overflow: auto;
        height: 700px;
        width: 100%;

      }
        .footer-display 
        {
        padding-bottom: 153px !important;
        }
        
          #page-31 h2 {
       
        margin-top: 218px;
    }

      #page-37 .box-imge {

      width: inherit;

      height: inherit;

      text-align: center;

      }

      #page-37 .col-md-8

      {

      text-align:center !important;

      }

      /*#page-38 .row*/

      /*{*/

      /*flex-wrap: nowrap;*/

      /*}*/
      
      #data-refresh1 .buttonActivity img
      {
          width:100px;
      }

      .heading 

      {

      padding-right: 0rem !important;

      width:100%;

      }

      .heading-span 

      {

      font-size: 16px;

      }

      .item-account-verified {

      border: 3px solid #ff3131;

      border-radius: 50%;

      font-size: 10px;

      margin: 6px;

      color: #ff3131;

      padding: 2px 3px;

      }

      .item-infos-content .item-infos-item {

      padding-bottom: 0px;

      display: inherit;

      }

      .back-btn{ 

      font-size: 14px;

      left: 1rem;

      }

      .next-btn{ 

      font-size: 14px;

      right: 1rem;

      }

      .next-btn img,.back-btn img{

      width: 3rem !important;

      height: 3rem !important;

      }

      .timer{ 

      right: 1rem;

      font-size: 3rem;

      }

      .text-left{

      text-align:center !important;

      }

      .sub-title-37{

      line-height: 0.9 !important;

      }

      .mb6{

      margin-bottom: 2rem;

      }

      #page-31 h2, #page-31 p, #page-32 h2 {

      font-size: 2rem !important;

      }

      main

      {

      margin-top: 0px;

      min-height: auto;

      }

      #page-37,#page-36

      {

      min-height: 700px !important;
        height: 700px;

      }

      #page-39,#page-38,#page-31,#page-36

      {

      min-height: auto !important;

      height: auto;

      } 

      #page-37 .offset-1

      {

      margin-left: 0px !important;

      }

      #page-37 .sub-37 {

      font-size: 24px;

      }

      #page-37

      {

      min-height: 100%;

      height: 100%;

      }

      #page-37 h2 b 

      {

      font-size: 40px;

      }

      #page-38 i 

      {

      font-size: 4rem;

      }

      #page-38 .item-infos-content

      {

      margin-left: 0rem; 

      }

      .profile-res {

      font-size: 16px;

      }


      #page-32 h2 b,#page-33 h2 b,#page-34 h2 b,#page-35 h2 b,#page-36 h2 b  
      {
      font-size: 40px !important;

      }
#page-32 .title-32,#page-33 .title-32,#page-34 .title-32,#page-35 .title-32,#page-36 .title-32       {
    font-size: 20px;
}

#page-32 p strong,#page-33 p strong,#page-34 p strong,#page-35 p strong,#page-36 p strong,#page-37 p strong {
    font-size: 16px;
}
 #page-32, #page-33, #page-34, #page-35, #page-37
{
              min-height: auto !important;
        height: auto;
}

.page-img-bottom  {
      position: fixed;
      bottom: 0px;
    }

      }

   </style>

</head>

<div class="" id="main-div">

   <div id="sub-div">

         <?php

            use \Carbon\Carbon;

            $Auth_User_Data = auth()->user();

            $emailMatchData1 = getMatchProfileStatus($user->id)['emailMatch'] ?? null;

            

            $isUserAboveAge =0;

            $timer = 1;

            

            if(auth()->user()->id == $user->id){

               $timer = 0;

               $lastId = ($user->match_user_id) ? $user->match_user_id[array_key_last($user->match_user_id)] : 0;

               $comments = getUserComment(auth()->user()->id, $lastId)['dataWithoutApproved'];

               $isShowComment = $comments->isEmpty() ? 'd-none' : '';

            }else{

               $comments = getUserComment($user->id,auth()->user()->id)['dataWithApproved'];

               $isShowComment = $comments->isEmpty() ? 'd-none' : '';

            }

            

            if(auth()->user()->id != $user->id &&  $emailMatchData1->is_profile_view == 1){

               $timer = 0;

            }



            if ($Auth_User_Data->interested_in === 'Female') {

               $age = Carbon::parse($Auth_User_Data->birthday)->age;



               if ($age >= 40) {

                  $suggestedMin = $age - 10;

                  $suggestedMax = $age - 2;

                  $minAge = is_numeric($Auth_User_Data->interested_min_age_range) ? (int) $Auth_User_Data->interested_min_age_range : 0;



                  $maxAge = is_numeric($Auth_User_Data->interested_max_age_range) ? (int) $Auth_User_Data->interested_max_age_range : 0;



                  if($minAge ==$suggestedMin  && $maxAge ==$suggestedMax){

                        $isUserAboveAge = 1;

                  }

               }

            }

            $currentLocale = Auth::user()->locale ?? app()->getLocale();

            ?>

      @if ($emailMatchData1 && $emailMatchData1->affection === "exit") {

      <script>

         window.location.href = "{{ url('/profile') }}";

      </script>

      @endif

      <input type="hidden" id="timerId" value="{{$timer}}">

   </div>

   <main class="item-page-main-content">

      <div id="info" class="grid-column tab-content-data active">

         <div class="item-widget fadeIn mb-0" data-effect="fadeIn">

            <div class="item-widget-main-content">

               <div class="item-widget-content dataflow step step-active" id="page-31" style="background: #00000094;">

                  @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-logo1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-logo1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif

                  @else

                  <img class="page-img-logo" src="{{asset('pictures/ISO%20G.png') }}"  />

                  @endif

                  <div class="item-infos-content">

                     <h2>@lang('messages.view_profile_1') {{ucfirst($Auth_User_Data->like_to_be_called)}}</h2>

                     @if(auth()->user()->id != $user->id)

                     <p>@lang('messages.view_profile_2')</p>

                     <p>{{ $user->like_to_be_called}}</p>

                     @endif

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  />

                  <div class="buttons">

                     <span class="col-1 next-btn" data-step="1" data-id="32"><img src="{{asset('/icon-img/forward--v1.png') }}" /></span>

                  </div>

               </div>

               <div class="item-widget-content dataflow step" id="page-32" style="background:#00000094;">

                  @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-top1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-top1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif



                     @if(auth()->user()->id != $user->id)

                     <h1  class="item-widget-content-h1">{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1 class="item-widget-content-h1">{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @else

                     <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                     @if(auth()->user()->id != $user->id)

                     <h1>{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1>{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @endif

                  

                  <div class="item-infos-content">

                     <h2 class="m2"><b>@lang('messages.view_profile_3')</b></h2>

                     <p class="title-32 pt-4">@lang('messages.view_profile_4')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->academic_level }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_5')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->industry_you_work }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_6')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->about_your_job }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_7')</p>

                     <p class="m2"><strong>{{ $user->country_of_birth }}</strong></p>

                     @if($user->other_nationality == "Dual")

                     <p class="title-32">@lang('messages.view_profile_7_15')</p>

                     <p class="m2"><strong>{{ ($user->other_nationality_country) ? $user->other_nationality_country:'' }}</strong></p>

                     @endif

                     <p class="title-32">@lang('messages.view_profile_8')</p>

                     <p class="m2"><strong>

                        @php

                           $languages = json_decode($user->languages, true);

                           $languageList = is_array($languages) ? implode(', ', $languages) : ($languages ?? '');

                        @endphp



                        @if($languageList && $user->other_languages)

                           {{ $languageList }}, {{ $user->other_languages }}

                        @elseif($languageList)

                           {{ $languageList }}

                        @elseif($user->other_languages)

                           {{ $user->other_languages }}

                        @endif

                        </strong>

                     </p>

                     <p class="title-32">@lang('messages.view_profile_9')</p>

                     @if($user->res_city != null && $user->res_state != null && $user->res_country != null)

                     <p class="m2"><strong>{{ optional($user)->res_city }}{{ ($user->res_state) ? ', '.$user->res_state:''}}{{ ($user->res_country) ? ', '.$user->res_country:''}}</strong></p>

                     @elseif($user->city == null && $user->res_state != null && $user->country != null)

                     <p class="m2"><strong>>{{ optional($user)->res_state }}{{ ($user->res_country) ? ', '.$user->res_country:''}}</strong></p>

                     @else

                     <p class="m2"><strong>{{ optional($user)->res_country ?? '' }}</strong></p>

                     @endif

                     <p class="title-32">@lang('messages.view_profile_10')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $travelFrecuencyData[$user->travel_frecuency] ?? '' }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_11')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->social_cause }}</strong></p>

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  /> 

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="2" data-id="31"><img  src="{{asset('/icon-img/back--v1.png') }}" /></span>

                     <span class="col-1 next-btn" data-step="2" id="next-2" data-id="33"><img  src="{{asset('/icon-img/forward--v1.png') }}" /></span>

                     <p class="timer hidden" id="timer2"><span id="countdown2">3</span></p>

                  </div>

               </div>

               <div class="item-widget-content dataflow step" id="page-33"  >

                  @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-top1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-top1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif



                     @if(auth()->user()->id != $user->id)

                     <h1 class="item-widget-content-h1">{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1 class="item-widget-content-h1">{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @else

                     <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                     @if(auth()->user()->id != $user->id)

                     <h1>{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1>{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @endif

                  <div class="item-infos-content">

                     <h2 class="m2"><b>@lang('messages.view_profile_12')</b></h2>

                     <p class="title-32 pt-4">Current stage of life:</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->life_in_general }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_13')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->what_qualities }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_14')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->what_relaxes_you }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_15')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->conversational_style }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_16')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->you_laugh }}</strong></p>

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  />  

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="3" data-id="32"><img  src="{{asset('/icon-img/back--v1.png') }}" /></span>

                     <span class="col-1 next-btn" data-step="3" id="next-3" data-id="34"><img  src="{{asset('/icon-img/forward--v1.png') }}" /></span>

                     <p class="timer hidden" id="timer3" ><span id="countdown3"></span></p>

                  </div>

               </div>

               <div class="item-widget-content dataflow step" id="page-34"  >

                  @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-top1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-top1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif



                     @if(auth()->user()->id != $user->id)

                     <h1 class="item-widget-content-h1">{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1 class="item-widget-content-h1">{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @else

                     <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                     @if(auth()->user()->id != $user->id)

                     <h1>{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1>{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @endif

                  

                  <div class="item-infos-content">

                     <h2 class="m2"><b>@lang('messages.view_profile_18')</b></h2>

                     <p class="title-32 pt-4">@lang('messages.view_profile_19')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $childrenData[$user->children] ?? '' }}</strong></p>

                     @if ($user->children == "1")

                     <p class="title-32">@lang('messages.view_profile_20')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->children_age }}</strong></p>

                     @endif

                     @if ($user->children == "2")

                     <p class="title-32">@lang('messages.view_profile_21')</p>

                     <p class="m2 {{ $user->children_have_many == "1" ? '' : 'd-none' }}"><strong>@lang('messages.view_profile_22')</strong></p>

                     <p class="m2 {{ $user->children_have_many == "2" ? '' : 'd-none' }}"><strong>@lang('messages.view_profile_23')</strong></p>

                     <p class="m2 {{ $user->children_have_many == "3" ? '' : 'd-none' }}"><strong>@lang('messages.view_profile_24')</strong></p>

                     <p class="m2 {{ $user->children_have_many == "4" ? '' : 'd-none' }}"><strong>@lang('messages.view_profile_25')</strong></p>

                     @endif

                     <p class="title-32">@lang('messages.view_profile_26')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $petsData[$user->pets] ?? '' }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_27')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->preferences }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_28')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->follow_any_religion }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_29')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $workoutData[$user->work_out] ?? '' }}</strong></p>

                     @if($workoutData[$user->work_out] !='I never workout')

                     <p class="title-32">@lang('messages.view_profile_29_1')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->comment_workout }}</strong></p>

                     @endif

                     <p class="title-32">@lang('messages.view_profile_29_14')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->usually_eat ?? '' }}</strong></p>

                     <!-- <p class="title-32">Comments</p>

                        <p class="m2"><strong>I prefer taking care thru food</strong></p> -->

                     <p class="title-32">@lang('messages.view_profile_30')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->describe_your_lifestyle }}</strong></p>

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  />  

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="4" data-id="33"><img  src="{{asset('/icon-img/back--v1.png') }}" /></span>

                     <span class="col-1 next-btn" data-step="4" id="next-4" data-id="35"><img  src="{{asset('/icon-img/forward--v1.png') }}" /></span>

                     <p class="timer hidden" id="timer4" ><span id="countdown4"></span></p>

                  </div>

               </div>

               <div class="item-widget-content dataflow step" id="page-35"  >

                  @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-top1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-top1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif



                     @if(auth()->user()->id != $user->id)

                     <h1 class="item-widget-content-h1">{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1 class="item-widget-content-h1">{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @else

                     <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                     @if(auth()->user()->id != $user->id)

                     <h1>{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1>{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @endif

                  

                  <div class="item-infos-content">

                     <h2 class="m2"><b>@lang('messages.view_profile_31_1')</b><br><b style="line-height: 0.5;font-size: 65px;">@lang('messages.view_profile_31_2')</b></h2>

                     <p class="title-32 pt-4">@lang('messages.view_profile_32')</p>

                     <p class="m2"><strong>{{ \Carbon\Carbon::parse($user->birthday)->age }} </strong></p>

                     <p class="title-32">@lang('messages.view_profile_33')</p>

                     @php 

                     if (auth()->user()->description == "CM") {

                     if ($user->description != "CM") {

                     $feet = intval($user->feet);

                     $inches = intval($user->inches); 

                     $totalInches = ($feet * 12) + $inches;

                     $heightInCm = $totalInches * 2.54;

                     $height = number_format($heightInCm, 2) . " CMS";

                     } else {

                     $height = "{$user->height} CMS";

                     }

                     } else {

                     if ($user->description != "Feet") {

                     $heightInCm = $user->height; 

                     $heightInFeet = intval($heightInCm / 30.48); 

                     $heightInInches = intval(($heightInCm / 2.54) % 12); 

                     $height = "{$heightInFeet} Feet {$heightInInches} Inches";

                     } else {

                     $height = "{$user->feet} Feet {$user->inches} Inches"; 

                     }

                     }

                     @endphp

                     <p class="m2"><strong>{{ $user->height }} cms / {{$user->feet}}' {{$user->inches}}"</strong></p>

                     <?php

                        $user_height = $height; 

                        $auth_height = auth()->user()->height;

                        

                        if ($user_height > $auth_height) {

                              $heightInterest=__('messages.view_profile_34'); //" Taller than me";

                        }elseif ($user_height < $auth_height) {

                           $heightInterest=__('messages.view_profile_35'); //"Shorter than me";

                        }elseif ($user_height >= $auth_height) {

                              $heightInterest= __('messages.view_profile_36'); //"Taller or equal than me";

                        }elseif ($user_height <= $auth_height) {

                           $heightInterest= __('messages.view_profile_37'); //"Shorter or equal than me";

                        }else{

                           $heightInterest= "";

                        }

                           

                        ?>

                     @if(auth()->user()->id != $user->id)

                     <!-- <p class="title-32">Height Interest</p>

                        <p class="m2"><strong>{{  $heightInterest }}</strong></p> -->

                     @endif

                     <p class="title-32">@lang('messages.view_profile_38')</p>

                     <p class="m2"><strong>{{ $alcoholData[$user->alcohol] ?? '' }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_39')</p>

                     <p class="m2"><strong>{{ $smokeData[$user->smoke] ?? '' }}</strong></p>

                     @if($workoutData[$user->work_out] !='I never smoke')

                     <p class="title-32">@lang('messages.view_profile_39_1')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->comment_smoke ?? '' }}</strong></p>

                     @endif

                     <p class="title-32">@lang('messages.view_profile_40')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->music_genres }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_41')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->find_internally_attractive }}</strong></p>

                     <p class="title-32">@lang('messages.view_profile_42')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $interestInData[$user->interested_in] ?? '' }}</strong></p>

                     @if($user->interested_in =='Male-Male')

                     <p class="title-32">@lang('messages.view_profile_42_1')</p>

                     <p class="m2" style="word-break: break-word;"><strong>{{ $user->interested_preference ?? '' }}</strong></p>

                     @endif

                     <!-- <p class="title-32">Profile Cteated</p>

                        <p class="m2"><strong>{{ $user->created_at->format('Y-m-d') ?? '' }}</strong></p> -->

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  /> 

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="5" data-id="34"><img  src="{{asset('/icon-img/back--v1.png') }}" /></span>

                     <span class="col-1 next-btn" data-step="5" id="next-5" data-id="36"><img  src="{{asset('/icon-img/forward--v1.png') }}" /></span>

                     <p class="timer hidden" id="timer5"><span id="countdown5"></span></p>

                  </div>

               </div>

               <div class="item-widget-content dataflow step" id="page-36"  >

                  @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-top1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-top1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif



                     @if(auth()->user()->id != $user->id)

                     <h1 class="item-widget-content-h1">{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1 class="item-widget-content-h1">{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @else

                     <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                     @if(auth()->user()->id != $user->id)

                     <h1>{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1>{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @endif

                  

                  <div class="item-infos-content">

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  />   

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="6" data-id="35"><img  src="{{asset('/icon-img/back--v1.png') }}" style="opacity: 1 !important;"/></span>

                     <span class="col-1 next-btn" data-step="6" id="next-6" data-id="37"><img  src="{{asset('/icon-img/forward--v1.png') }}" style="opacity: 1 !important;"/></span>

                     <p class="timer hidden" id="timer6"><span id="countdown6"></span></p>

                  </div>

               </div>

               <div class="item-widget-content dataflow step" id="page-37"  >

                  @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-top1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-top1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif



                     @if(auth()->user()->id != $user->id)

                     <h1 class="item-widget-content-h1">{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1 class="item-widget-content-h1">{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @else

                     <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                     @if(auth()->user()->id != $user->id)

                     <h1>{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1>{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @endif

                  

                  <?php

                     $feedbackData = getUserFeedback($user->id);

                     

                     $photogenic_avg = 0;

                     $expressiveness_avg = 0;

                     $attention_avg = 0;

                     $manners_avg = 0;

                     $opinions_ideas_avg = 0;

                     $sense_humer_avg = 0;

                     $energy_avg = 0;

                     $willingness_avg = 0;

                     

                     if (auth()->user()->id != $user->id) {

                           $photogenic_avg = ($feedbackData['feedbackAverages']['photogenic_avg'] >= 3) ? $feedbackData['feedbackAverages']['photogenic_avg'] : 0;

                           $expressiveness_avg = ($feedbackData['feedbackAverages']['expressiveness_avg'] >= 3) ? $feedbackData['feedbackAverages']['expressiveness_avg'] : 0;

                           $attention_avg = ($feedbackData['feedbackAverages']['attention_avg'] >= 3) ? $feedbackData['feedbackAverages']['attention_avg'] : 0;

                           $manners_avg = ($feedbackData['feedbackAverages']['manners_avg'] >= 3) ? $feedbackData['feedbackAverages']['manners_avg'] : 0;

                           $opinions_ideas_avg = ($feedbackData['feedbackAverages']['opinions_ideas_avg'] >= 3) ? $feedbackData['feedbackAverages']['opinions_ideas_avg'] : 0;

                           $sense_humer_avg = ($feedbackData['feedbackAverages']['sense_humer_avg'] >= 3) ? $feedbackData['feedbackAverages']['sense_humer_avg'] : 0;

                           $energy_avg = ($feedbackData['feedbackAverages']['energy_avg'] >= 3) ? $feedbackData['feedbackAverages']['energy_avg'] : 0;

                           $willingness_avg = ($feedbackData['feedbackAverages']['willingness_avg'] >= 3) ? $feedbackData['feedbackAverages']['willingness_avg'] : 0;

                           echo '<style>#page-37{ min-height:2200px !important} #page-37 .item-infos-content { padding: 400px 70px; position: relative; } </style>';
                           

                     } else {
                          
                            echo '<style>#page-37{ min-height:2200px !important} #page-37 .item-infos-content { padding: 400px 70px; position: relative; } </style>';
                           // $photogenic_avg = $feedbackData['feedbackAverages']['photogenic_avg'];

                           // $expressiveness_avg = $feedbackData['feedbackAverages']['expressiveness_avg'];

                           // $attention_avg = $feedbackData['feedbackAverages']['attention_avg'];

                           // $manners_avg = $feedbackData['feedbackAverages']['manners_avg'];

                           // $opinions_ideas_avg = $feedbackData['feedbackAverages']['opinions_ideas_avg'];

                           // $sense_humer_avg = $feedbackData['feedbackAverages']['sense_humer_avg'];

                           // $energy_avg = $feedbackData['feedbackAverages']['energy_avg'];

                           // $willingness_avg = $feedbackData['feedbackAverages']['willingness_avg'];

                           $photogenic_avg = ($feedbackData['feedbackAverages']['photogenic_avg'] >= 3) ? $feedbackData['feedbackAverages']['photogenic_avg'] : 0;

                           $expressiveness_avg = ($feedbackData['feedbackAverages']['expressiveness_avg'] >= 3) ? $feedbackData['feedbackAverages']['expressiveness_avg'] : 0;

                           $attention_avg = ($feedbackData['feedbackAverages']['attention_avg'] >= 3) ? $feedbackData['feedbackAverages']['attention_avg'] : 0;

                           $manners_avg = ($feedbackData['feedbackAverages']['manners_avg'] >= 3) ? $feedbackData['feedbackAverages']['manners_avg'] : 0;

                           $opinions_ideas_avg = ($feedbackData['feedbackAverages']['opinions_ideas_avg'] >= 3) ? $feedbackData['feedbackAverages']['opinions_ideas_avg'] : 0;

                           $sense_humer_avg = ($feedbackData['feedbackAverages']['sense_humer_avg'] >= 3) ? $feedbackData['feedbackAverages']['sense_humer_avg'] : 0;

                           $energy_avg = ($feedbackData['feedbackAverages']['energy_avg'] >= 3) ? $feedbackData['feedbackAverages']['energy_avg'] : 0;

                           $willingness_avg = ($feedbackData['feedbackAverages']['willingness_avg'] >= 3) ? $feedbackData['feedbackAverages']['willingness_avg'] : 0;

                          

                     }

                     

                     ?>

                     

                  <div class="item-infos-content feedback-main">

                     <h2><b style="font-family: 'AvenirNext', sans-serif;font-weight: 100;color: #666666;" class="text-uppercase feedback-b">@lang('messages.view_profile_43')</b></h2>

                     <p class="sub-title-37 mb-0 text-center feedback-p" style="text-align: left;font-family: 'FutureBTBook', sans-serif;color: #b5b5b5;">@lang('messages.view_profile_44')</p>

                     <div class="row mx-2 py-3">

                        @if($photogenic_avg >= 3)
                        

                        <div class="col-md-1 offset-1  mb-3 text-right">

                           <div class="box-imge feedback-box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/photo_icon.png') }}"></div>

                        </div>

                        <div class="col-md-10 mb6 text-left">

                           <h4 class="tl-37"> @lang('messages.view_profile_45')</h4>

                           <p class="sub-37 {{ $photogenic_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_46')</p>

                           <p class="sub-37 {{ $photogenic_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_47')</p>

                           <p class="sub-37 {{ $photogenic_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_48')</p>

                           <p class="sub-37 {{ $photogenic_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_49')</p>

                           <p class="sub-37 {{ $photogenic_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_50')</p>

                        </div>

                        @endif

                        @if($expressiveness_avg >= 3)

                        <div class="col-md-1 offset-1  mb6">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/expresiveness_icon.png') }}"></div>

                        </div>

                        <div class="col-md-9 text-left mb6">

                           <h4 class="tl-37"> @lang('messages.view_profile_51')</h4>

                           <p class="sub-37 {{ $expressiveness_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_52')</p>

                           <p class="sub-37 {{ $expressiveness_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_53')</p>

                           <p class="sub-37 {{ $expressiveness_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_54')</p>

                           <p class="sub-37 {{ $expressiveness_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_55')</p>

                           <p class="sub-37 {{ $expressiveness_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_56')</p>

                        </div>

                        @endif

                        @if($attention_avg >= 3)

                        <div class="col-md-1 offset-1  mb6">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/attention_icon.png') }}"></div>

                        </div>

                        <div class="col-md-9 text-left mb6">

                           <h4 class="tl-37"> @lang('messages.view_profile_57')</h4>

                           <p class="sub-37 {{ $attention_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_58')</p>

                           <p class="sub-37 {{ $attention_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_59')</p>

                           <p class="sub-37 {{ $attention_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_60')</p>

                           <p class="sub-37 {{ $attention_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_61')</p>

                           <p class="sub-37 {{ $attention_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_62')</p>

                        </div>

                        @endif

                        @if($manners_avg >= 3)

                        <div class="col-md-1 offset-1  mb6">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/manners_icon.png') }}"></div>

                        </div>

                        <div class="col-md-9 text-left mb6">

                           <h4 class="tl-37">@lang('messages.view_profile_63') </h4>

                           <p class="sub-37 {{ $manners_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_64').</p>

                           <p class="sub-37 {{ $manners_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_65')</p>

                           <p class="sub-37 {{ $manners_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_66')</p>

                           <p class="sub-37 {{ $manners_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_67')</p>

                           <p class="sub-37 {{ $manners_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_68')</p>

                        </div>

                        @endif

                        @if($opinions_ideas_avg >= 3)

                        <div class="col-md-1 offset-1  mb6">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/opinions_icon.png') }}"></div>

                        </div>

                        <div class="col-md-9 text-left mb6">

                           <h4 class="tl-37">@lang('messages.view_profile_69')</h4>

                           <p class="sub-37 {{ $opinions_ideas_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_70')</p>

                           <p class="sub-37 {{ $opinions_ideas_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_71')</p>

                           <p class="sub-37 {{ $opinions_ideas_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_72')</p>

                           <p class="sub-37 {{ $opinions_ideas_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_73')</p>

                           <p class="sub-37 {{ $opinions_ideas_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_74')</p>

                        </div>

                        @endif

                        @if($sense_humer_avg >= 3)

                        <div class="col-md-1 offset-1  mb6">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/comments_icon.png') }}"></div>

                        </div>

                        <div class="col-md-9 text-left mb6">

                           <h4 class="tl-37">@lang('messages.view_profile_75')</h4>

                           <p class="sub-37 {{ $sense_humer_avg == 1 ? '' : 'd-none' }}"> @lang('messages.view_profile_76')</p>

                           <p class="sub-37 {{ $sense_humer_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_77')

                           </p>

                           <p class="sub-37 {{ $sense_humer_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_78')</p>

                           <p class="sub-37 {{ $sense_humer_avg == 4 ? '' : 'd-none' }}"> @lang('messages.view_profile_79')</p>

                           <p class="sub-37 {{ $sense_humer_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_80')</p>

                        </div>

                        @endif

                        @if($energy_avg >= 3)

                        <div class="col-md-1 offset-1  mb6">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/energy_icon.png') }}"></div>

                        </div>

                        <div class="col-md-9 text-left mb6">

                           <h4 class="tl-37">@lang('messages.view_profile_81')</h4>

                           <p class="sub-37 {{ $energy_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_82')</p>

                           <p class="sub-37 {{ $energy_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_83')</p>

                           <p class="sub-37 {{ $energy_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_84')</p>

                           <p class="sub-37 {{ $energy_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_85')</p>

                           <p class="sub-37 {{ $energy_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_86')</p>

                        </div>

                        @endif

                        @if($willingness_avg >= 3)

                        <div class="col-md-1 offset-1  mb6">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/willingness_icon.png') }}"></div>

                        </div>

                        <div class="col-md-9 text-left mb6">

                           <h4 class="tl-37">@lang('messages.view_profile_87') </h4>

                           <p class="sub-37 {{ $willingness_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_88')</p>

                           <p class="sub-37 {{ $willingness_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_89')</p>

                           <p class="sub-37 {{ $willingness_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_90')</p>

                           <p class="sub-37 {{ $willingness_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_91')</p>

                           <p class="sub-37 {{ $willingness_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_93')</p>

                        </div>

                        @endif

                        @if($photogenic_avg == 0 && $expressiveness_avg == 0 && $attention_avg ==0 && $manners_avg == 0 && $opinions_ideas_avg == 0 && $sense_humer_avg == 0 && $energy_avg == 0 && $willingness_avg == 0)
                        <style>#page-37{ min-height:1650px !important;} #page-37 .item-infos-content { padding: 250px 70px 750px; position: relative; } </style>
                        <div class="col-md-2 offset-1 mb-3">

                           <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/comments_icon.png') }}"></div>

                        </div>

                        <div class="col-md-8 text-left">

                           <p class="sub-37" style="font-size: 30px !important;">@lang('messages.view_profile_94').</p>

                        </div>

                        @endif

                        @if($comments)
                        

                        <div class="col-md-1 offset-1  mb6 {{ $isShowComment }}">

                           <div class="box-imge">

                              <img class="feedback-img mt-1" src="{{ asset('feedback_Icons/comments_icon.png') }}">

                           </div>

                        </div>

                        <div class="col-md-9 text-left mb6 {{ $isShowComment }}">

                           <h4 class="tl-37">@lang('messages.view_profile_95')</h4>

                           @foreach($comments as $comment)

                           <div class="border-white mb-2 mt-0" style="border-bottom: 1px solid #322020;margin-top: 22px;">

                              <p class="sub-37 mb-2">

                                 <!-- {{ optional($comment)->comments }} -->

                                 @if(optional($comment)->serious_relationship =="Yes")

                                 {{ optional($comment)->connect_person }}

                                 @else

                                 {{ optional($comment)->compliment }}

                                 @endif

                              </p>

                              <div class="btn-group mt-3" role="group" aria-label="Publish Comment Option">

                                 @if(auth()->user()->id == $user->id)

                                 <label>@lang('messages.view_profile_96')</label><br>

                                 <div class="btn-group " role="group">

                                    <button type="button"

                                       class="btn btn-outline-success publish-comment-btn mx-2 mb-3

                                       @if($comment->is_publish_comments == 1) active @endif"

                                       data-status="1"

                                       data-user-id="{{ $comment->like_user_id }}"

                                       data-liked-user-id="{{ $comment->user_id }}"

                                       data-comment-id="{{ $comment->id }}" 

                                       style="padding: 1px 5px 5px 5px;height: 25px; border-radius:0;">

                                       @lang('messages.view_profile_97')

                                    </button>

                                    <button type="button"

                                       class="btn btn-outline-danger publish-comment-btn mx-2 mb-3

                                       @if($comment->is_publish_comments == 0) active @endif"

                                       data-status="0"

                                       data-user-id="{{ $comment->like_user_id }}"

                                       data-liked-user-id="{{ $comment->user_id }}"

                                       data-comment-id="{{ $comment->id }}" 

                                       style="padding: 1px 5px 5px 5px;height: 25px; border-radius:0;">

                                       @lang('messages.view_profile_98')

                                    </button>

                                 </div>

                                 @endif

                              </div>

                              

                           </div>

                           <div class="text-center mx-4" id="publish-activity">

                        

                              </div>

                           @endforeach

                        </div>

                        @endif

                     </div>

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  />  

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="7" data-id="36"><img  src="{{asset('/icon-img/back--v1.png') }}" /></span>

                     <span class="col-1 next-btn" data-step="7" id="next-7" data-id="39"><img  src="{{asset('/icon-img/forward--v1.png') }}" /></span>

                     <p class="timer hidden" id="timer7"><span id="countdown7"></span></p>

                  </div>

               </div>

               

               @php 

               $emailMatchData = getMatchProfileStatus($user->id)['emailMatch'] ?? null; 

               $MatchUserData = getMatchProfileStatus($user->id)['matchesData'] ?? 0; 

               $acceptInvite = getAcceptInvite();

               @endphp

               <div class="item-widget-content dataflow step" id="page-39">

                 @if($isUserAboveAge == 1)

                     @if($currentLocale =='es')

                     <img class="page-img-top1" src="{{asset('pictures/badges1.png') }}"  />

                     @else

                     <img class="page-img-top1" src="{{asset('pictures/badges2.png') }}"  />

                     @endif



                     @if(auth()->user()->id != $user->id)

                     <h1 class="item-widget-content-h1">{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1 class="item-widget-content-h1">{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @else

                     <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                     @if(auth()->user()->id != $user->id)

                     <h1>{{ $user->like_to_be_called}}</h1>

                     @else

                     <h1>{{ucfirst($Auth_User_Data->like_to_be_called)}}</h1>

                     @endif

                  @endif

                  <div class="item-infos-content">

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  /> 

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="8" data-id="37"><img  src="{{asset('/icon-img/back--v1.png') }}" /></span>

                     @if(auth()->user()->id != $user->id)

                     <span class="col-1 next-btn" data-step="8" id="next-8" data-id="38"><img  src="{{asset('/icon-img/forward--v1.png') }}" style="opacity: 1 !important;"/></span>

                     <p class="timer hidden" id="timer8" ><span id="countdown8"></span></p>

                     @endif

                  </div>

               </div>

               @if(auth()->user()->id != $user->id)

               @if(is_object($emailMatchData))

               @php 

               

                  $userId = getMatchProfile();

                  $user = getUserDetails($userId);

                  $emailMatchData = getMatchProfileStatus($user->id)['emailMatch'] ?? null;

                  $secondMatchData = getMatchProfileStatus($user->id)['secondEmailMatch'] ?? null;

                  $affectin_is_connect = 0;



                  if($emailMatchData->affection == "accept" && $secondMatchData->affection == "accept"){

                     $affectin_is_connect = 1;

                  }



               @endphp

               <div class="item-widget-content dataflow step" id="page-38">

                  <img class="page-img-top" src="{{asset('/pictures/profile-frame-top.png') }}" />

                  <h1>{{ $user->like_to_be_called}}</h1>

                  <div class="item-infos-content" id="data-refresh1">

                     <div class="row" id="data-refresh2">

                        @if($emailMatchData->affection != "exit" && $emailMatchData->is_mastering == 1)

                        <h2 class="col-12 text-center"><img src="{{asset('/pictures/mastering-logo-whi.png') }}" class="master-img-200"  /></h2>

                        <h2 class="col-12 text-center my-3" style="font-family: 'AvenirNext', sans-serif;font-size: 2.4rem; cursor: pointer;" onclick="triggerMasteringSwal({{$user->id}})">@lang('messages.view_profile_99-12') </h2>

                        <h2 class="col-12 text-center" style="font-family: 'AvenirNext', sans-serif;font-size: 2.4rem;">@lang('messages.view_profile_99-1'):</h2>

                        @endif

                        @if($emailMatchData->affection == "email" && $emailMatchData->is_mastering == 0)

                        <a href="javascript:;" class="item-data-item item-data-vues  m-1 " data-item-tooltip="1 View" onclick="rejectInviteMain({{getMatchProfile()}}, this, {{$affectin_is_connect}})">

                           <div class="buttonload" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>

                           <div class="buttonActivity" style="display: block;">

                              <img src="{{asset('/icon-img/image18.png') }}" width="110">

                              <!-- <i class="fa-solid fa-xmark text-pink" title="REJECT PROFILE"></i> -->

                              <p class="text-pink profile-res w-100">@lang('messages.view_profile_100')</p>

                           </div>

                        </a>

                        <a href="javascript:;" style=" border-left: 3px solid #fff; " class="item-data-item item-data-comments  m-1" data-item-tooltip="0 Comments" onclick="acceptInvite({{getMatchProfile()}},this,'{{ $user->like_to_be_called }}')">

                           <div class="buttonload" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>

                           <div class="buttonActivity" style="display: block;">

                               <img src="{{asset('/icon-img/image27.png') }}" width="150">

                              <!-- <i class="fa-solid fa-check text-custom-primary" title="Accept Invitation"></i> -->

                              <p class="text-custom-primary profile-res w-100">@lang('messages.view_profile_101')</p>

                           </div>

                        </a>

                        @endif

                        @if($emailMatchData->affection == "accept" && $acceptInvite ==0 && $emailMatchData->is_mastering == 0)

                        <a href="#"  class="item-data-item item-data-comments  m-5 pr-2 pl-2 " data-item-tooltip="0 Comments">

                           <p class="text-white profile-res w-100" style="margin-top:25rem;">@lang('messages.view_profile_102_1') {{ $user->like_to_be_called}}. @lang('messages.view_profile_102_2').</p>

                        </a>

                        @endif

                        @if($emailMatchData->affection == "reject" && $emailMatchData->is_mastering == 0 )

                        <a href="#"  class="item-data-item item-data-comments  m-5 pr-2 pl-2 " data-item-tooltip="0 Comments">

                           <p class="text-white profile-res w-100" style="margin-top:25rem;">@lang('messages.view_profile_103').</p>

                        </a>

                        @endif

                        @if($emailMatchData->affection == "accept" && $acceptInvite !=0 && $emailMatchData->is_mastering == 0)

                        <div class="col-md-12" >

                        <a href="#"  class="item-data-item item-data-comments  m-5 pr-2 pl-2 " data-item-tooltip="0 Comments">

                           <p class="text-white profile-res w-100" style="margin-top:25rem;">@lang('messages.view_profile_104_1') {{ $user->like_to_be_called}} @lang('messages.view_profile_104_2').</p>

                        </a>

                        <br>

                        <a href="{{ route('user.chat',$acceptInvite)}}"  class="item-data-item item-data-comments  col-12 m-1 text-center" data-item-tooltip="0 Comments">

                           <img src="{{asset('/pictures//Chat Icon.png')}}" alt="" class="logo-bg" >

                           <p class="text-light profile-res w-100">@lang('messages.view_profile_105')</p>

                        </a>

                        </div>

                        @endif

               

                        @if($emailMatchData->is_mastering == 1)

                        <div class="col-md-12 d-flex justify-content-center" style="">

                           <a href="javascript:;"  class="item-data-item item-data-comments  m-1" onclick="masteringResponse(0,{{$user->id}},this)">

                              <div class="buttonload" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>

                              <div class="buttonActivity" style="display: block;">

                                 <img src="{{asset('/icon-img/image27.png') }}" width="200">

                                 <!-- <i class="fa-solid fa-check text-custom-primary" title="Yes"></i> -->

                                 <p class="text-custom-primary profile-res w-100">@lang('messages.view_profile_106')</p>

                              </div>

                           </a>

                           <a href="javascript:;" style=" border-left: 3px solid #fff; " class="item-data-item item-data-vues  m-1 " data-item-tooltip="1 View" onclick="masteringResponseMain(1,{{$user->id}},this)">

                              <div class="buttonload" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>

                              <div class="buttonActivity" style="display: block;">

                                 <img src="{{asset('/icon-img/image18.png') }}" width="150">

                                 <!-- <i class="fa-solid fa-xmark text-pink" title="No"></i> -->

                                 <p class="text-pink profile-res w-100"> @lang('messages.view_profile_107')</p>

                              </div>

                           </a>

                        </div>

                        @endif

                     </div>

                  </div>

                  <img class="page-img-bottom " id="logoImage" src="{{asset('/pictures/profile-frame-bottom.png') }}"  />

                  <div class="buttons">

                     <span class="col-1 back-btn" data-step="9" data-id="39"><img  src="{{asset('/icon-img/back--v1.png') }}" style="opacity: 1 !important;"/></span>

                  </div>

               </div>

               @endif

               @endif

            </div>

         </div>

      </div>

   </main>

   <!-- Modal structure -->

   <div class="modal" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">

      <div class="modal-dialog">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title" id="modalLabel">Why didn't you want to connect?</h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>

            </div>

            <div class="modal-body">

               <p>Please select a reason:</p>

               <div class="mt-3">

                  <label class="form-label" for="reasonPicture">Picture</label>

                  <select class="form-control" id="reasonPicture" name="reasonPicture">

                     <option value="">Select</option>

                     <option value="one">One</option>

                     <option value="two">Two</option>

                     <option value="both">Both</option>

                  </select>

               </div>

               <div class="mt-3">

                  <label class="form-check-label" for="reasonDescription">Description</label>

                  <textarea class="form-control" name="reasonDescription" id="reasonDescription" rows="2" placeholder="Enter your Description..."></textarea>

               </div>

               <div class="mt-3">

                  <label for="comments" class="form-label">Additional Comments:</label>

                  <textarea class="form-control" id="comments" rows="3" placeholder="Enter your comments..."></textarea>

               </div>

            </div>

            <div class="modal-footer">

               <button type="button" class="btn btn-primary" id="submitFeedback" onclick="masteringResponse(1,{{$user->id}},this)">Submit</button>

            </div>

         </div>

      </div>

   </div>

</div>

<script>

   let currentStep = 1;

   let totalSteps = $(".step").length;

   

   function showStep(step, divId) {

         $(".step").removeClass("step-active");

         $("#page-" + divId).addClass("step-active");

   }

   

   function startCountdown(step, divId) {

         let IsActiveTimer = $('#timerId').val();

         let likedUserId = "{{$emailMatchData->liked_user_id ?? 0}}";

         currentStep = step + 1;

   

         $(".step").removeClass("step-active");

         $("#page-" + divId).addClass("step-active");

   

         if(IsActiveTimer > 0){

            let timerId = "timer" + currentStep;

            let countdownId = "countdown" + currentStep;

   

            $("#" + timerId).removeClass("hidden");

            $("#next-" + currentStep).addClass("d-none");

            let timeLeft = 3;

   

            let timer = setInterval(function () {

               $("#" + countdownId).text(timeLeft);

               timeLeft--;

   

               if (timeLeft < 0) {

                  clearInterval(timer);

                  $("#" + timerId).addClass("hidden");

                  $("#next-" + currentStep).removeClass("d-none");

                  

               }

            }, 1000);

         }

   

         if(divId == 38){

            $.ajax({

                  url: '/profile-preview-complete',

                  type: 'POST', 

                  data: {

                     _token: $('meta[name="csrf-token"]').attr('content'),

                     id: likedUserId,

                  },

                  success: function(response) {

                  // $('#main-div').load(' #sub-div');

                     $('#timerId').val(0);

                     $('#refreshData1').load(' #refreshData2');

                  }

            });

         }

   }

   

   $(".next-btn").on("click", function () {

         let step = parseInt($(this).data("step"));

         let divId = parseInt($(this).data("id"));

         startCountdown(step, divId);

   });

   

   $(".back-btn").on("click", function () {

         let step = parseInt($(this).data("step"));

         let divId = parseInt($(this).data("id"));

         if (step > 1) {

            currentStep = step - 1;

            showStep(currentStep, divId);

         }

   });

   

   $(document).ready(function () {

      if (window.location.hash == "#affinity") {

         const element = document.querySelector(window.location.hash);

         if (element) {

            let step = 8;

            let divId = 38;

            startCountdown(step, divId);

         }

      }

   });

</script>

<script>

   const navbarItems = document.querySelectorAll('.item-navbar-item');

   const tabContents = document.querySelectorAll('.tab-content-data');

   const viewAllPhotosLink = document.getElementById('view-all-photos-link');

   const mediaTab = document.querySelector('.item-navbar-item[data-target="media"]');

   

   navbarItems.forEach(item => {

       item.addEventListener('click', () => {

           // Remove active class from all nav items

           navbarItems.forEach(nav => nav.classList.remove('item-active-menu'));

   

           // Remove active class from all tab contents

           tabContents.forEach(content => content.classList.remove('active'));

   

           // Add active class to clicked nav item

           item.classList.add('item-active-menu');

   

           // Get target tab ID from data-target

           const targetId = item.getAttribute('data-target');

           const targetContent = document.getElementById(targetId);

   

           // Show the associated tab content

           if (targetContent) {

               targetContent.classList.add('active');

           }

       });

   });

   viewAllPhotosLink.addEventListener('click', (event) => {

       event.preventDefault();

   

       mediaTab.click();

   });

   

</script>

<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">

<!-- Lightbox2 JS -->

<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNlIby3pLN2YsnmPyeSFA0rxn6LP9oTPg&callback=initMap&&libraries=places&callback=initAutocomplete"  async  defer> </script>

<script>

   // Submit Like Action

   function acceptInvite(userId , element,username) {

       

       Swal.fire({

           title: '{{ __('messages.acceptInviteMain-title') }}',

           text: `{!! __('messages.acceptInviteMain-html-first') !!} ${username}. {!! __('messages.acceptInviteMain-html-second') !!}`,

           showCancelButton: true,

           confirmButtonColor: '#38c172',

           cancelButtonColor: '#e3342f',

           confirmButtonText: '{{ __('messages.acceptInviteMain-confirmButtonText') }}',

           cancelButtonText: '{{ __('messages.acceptInviteMain-cancelButtonText') }}',

       }).then((result) => {

           if (result.isConfirmed) {

               Swal.fire({

                  title: "{{ __('messages.acceptInviteMain-syncing-title') }}",

                  html: `{{ __('messages.acceptInviteMain-syncing-html-first') }}<br><br>

                           <span style="color: #f59800; padding: 2px 5px; font-weight: bold;">

                           {{ __('messages.acceptInviteMain-syncing-html-second') }}

                           </span>`,

                  allowOutsideClick: false,

                  didOpen: () => {

                     Swal.showLoading();

                  }

               });

   

               $.ajax({

                   url: '/accept-action-url',

                   type: 'POST', 

                   data: {

                       _token: $('meta[name="csrf-token"]').attr('content'),

                       accept_user_id: userId,

                   },

                   success: function(response) {

                    

                       if (response.success) {

                         $('#data-refresh1').load(' #data-refresh2');

                         if (response.isChatActivated) {

                           Swal.fire({

                              title: '{{ __('messages.acceptInviteMain-official-title') }}',

                              html: `{{ __('messages.acceptInviteMain-official-html-first') }}`,

                        

                              confirmButtonText: '{{ __('messages.acceptInviteMain-official-confirmButtonText') }}'

                           }).then((result) => {

                              if (result.isConfirmed) {

                                 window.location.href = `/messenger/${userId}`; 

                              }

                           });

                        }else{

                           Swal.fire(

                              '{{ __('messages.acceptInviteMain-spark-title') }}',

                              `{{ __('messages.acceptInviteMain-spark-html-first') }} ${response.nickname} {{ __('messages.acceptInviteMain-spark-html-second') }}`,

                             

                           );

                           $('#data-refresh1').load(' #data-refresh2');

                        }

                       }else if(response.subscription){

                           Swal.fire(

                               '{{ __('messages.swal-error-title') }}',

                               response.message

                           );

                           

                       } else {

                           Swal.fire(

                               '{{ __('messages.swal-error-title') }}',

                               '{{ __('messages.sixth-swal-error-message') }}'

                               

                           );

                       }

                   },

                   error: function(xhr, status, error) {

                       Swal.fire(

                           '{{ __('messages.swal-error-title') }}',

                           '{{ __('messages.sixth-swal-error-message') }}'

                       );

                   }

               });

           } else {

               Swal.fire(

                   '{{ __('messages.seventh-swal-error-title') }}',

                   '{{ __('messages.seventh-swal-error-message') }}'

               );

           }

       });

   }

   

   // Submit Dislike Action

   function rejectInvite(userId, element) {

       // Prevent default action (e.g., form submission)

       

       Swal.fire({

           title: '{{ __('messages.rejectInviteMain-title') }}',

           text: '{{ __('messages.rejectInviteMain-html-first') }}',

           icon: 'warning',

           showCancelButton: true,

           confirmButtonColor: '#38c172',

           cancelButtonColor: '#e3342f',

           confirmButtonText: '{{ __('messages.rejectInviteMain-confirmButtonText') }}',

           cancelButtonText: '{{ __('messages.rejectInviteMain-cancelButtonText') }}',

       }).then((result) => {

           if (result.isConfirmed) {

            

            Swal.fire({

                title: "{{ __('messages.rejectInviteMain-syncing-title') }}",

                html: `{{ __('messages.rejectInviteMain-syncing-html-first') }}<br><br>

                           <span style="color: #f59800; padding: 2px 5px; font-weight: bold;">

                           {{ __('messages.rejectInviteMain-syncing-html-second') }}

                           </span>`,

                allowOutsideClick: false,

                didOpen: () => {

                    Swal.showLoading(); 

                }

            });

               $.ajax({

                   url: '/reject-action-url', 

                   type: 'POST', 

                   data: {

                       _token: $('meta[name="csrf-token"]').attr('content'), 

                       reject_user_id: userId, 

                   },

                   success: function(response) {

                       if (response.success) {

                           Swal.fire(

                               '{{ __('messages.rejectInviteMain-hold—for-title') }}',

                               '{{ __('messages.rejectInviteMain-hold—for-html-first') }}',

                               'success'

                           );

                           if (response.message && response.message.trim() !== "") {

                              $('#data-refresh1').html(response.message);

                           } else {

                              $('#data-refresh1').load(' #data-refresh2');

                           }

                       } else {

                           Swal.fire(

                               '{{ __('messages.rejectInviteMain-fifth-swal-error-title') }}',

                               '{{ __('messages.rejectInviteMain-fifth-swal-error-message') }}',

                               'error'

                           );

                       }

                   },

                   error: function(xhr, status, error) {

                       Swal.fire(

                           '{{ __('messages.rejectInviteMain-fifth-swal-error-title') }}',

                           '{{ __('messages.rejectInviteMain-fifth-swal-error-message') }}',

                           'error'

                       );

                   }

               });

           } else {

               Swal.fire(

                   '{{ __('messages.rejectInviteMain-sixth-swal-cancel-title') }}',

                   '{{ __('messages.rejectInviteMain-sixth-swal-cancel-message') }}',

                   'error'

               );

           }

       });

   }

   

   // Submit Like Action

   function masteringResponse(status,userId , element) {

      if(status == 0){

         Swal.fire({

            title: '{{ __('messages.masteringResponseMain-title') }}',

            text: '{{ __('messages.masteringResponseMain-html-first') }}',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#38c172',

            cancelButtonColor: '#e3342f',

            confirmButtonText: '{{ __('messages.masteringResponseMain-confirmButtonText') }}',

            cancelButtonText: '{{ __('messages.masteringResponseMain-cancelButtonText') }}'

         }).then((result) => {

            if (result.isConfirmed) {

               Swal.fire({

                  title: "{{ __('messages.masteringResponseMain-syncing-title') }}",

                  html: `{{ __('messages.masteringResponseMain-syncing-html-first') }}<br><br>

                           <span style="color: #f59800; padding: 2px 5px; font-weight: bold;">

                           {{ __('messages.masteringResponseMain-syncing-html-second') }}

                           </span>`,

                  allowOutsideClick: false,

                  didOpen: () => {

                     Swal.showLoading(); 

                  }

               });

               

               $.ajax({

                  url: '/mastering-response-url',

                  type: 'POST', 

                  data: {

                     _token: $('meta[name="csrf-token"]').attr('content'),

                     accept_user_id: userId,

                     status: status,

                  },

                  success: function(response) {

                     if (response.success) {

                        $('#data-refresh1').load(' #data-refresh2');

                        if (response.isChatActivated) {

                           Swal.fire({

                              title: '{{ __('messages.masteringResponseMain-perfect-moment-title') }}',

                              text: "{{ __('messages.masteringResponseMain-perfect-moment-html-first') }}",

                              icon: 'success',

                              confirmButtonText: '{{ __('messages.masteringResponseMain-perfect-moment-confirmButtonText') }}'

                           }).then((result) => {

                              if (result.isConfirmed) {

                                 window.location.href = `/messenger/${userId}`; 

                              }

                              $('#data-refresh1').load(' #data-refresh2');

                           });

                        }else{

                           Swal.fire({

                              title: '{{ __('messages.masteringResponseMain-almost-title') }}',

                              text: "{{ __('messages.masteringResponseMain-almost-html-first') }}",

                              icon: 'success'

                           });

                           $('#data-refresh1').load(' #data-refresh2');

                        }

                     } else {

                           Swal.fire(

                              '{{ __('messages.masteringResponseMain-fifth-swal-error-title') }}',

                              '{{ __('messages.masteringResponseMain-fifth-swal-error-message') }}',

                              'error'

                           );

                     }

                  },

                  error: function(xhr, status, error) {

                     Swal.fire(

                           '{{ __('messages.masteringResponseMain-fifth-swal-error-title') }}',

                           '{{ __('messages.masteringResponseMain-fifth-swal-error-message') }}',

                           'error'

                     );

                  }

               });

            }

         });

      }else{

         const reasonPicture = $('#reasonPicture').val().trim();

         const reasonDescription = $('#reasonDescription').val().trim();

         const comments = $('#comments').val().trim();

   

   

         if (reasonPicture === '') {

            Swal.fire('Error!','Please select a reason for the picture.','error');

            return;

         }

   

         if (reasonDescription === '') {

            Swal.fire('Error!','Please enter description.','error');

            return;

         }

   

         $.ajax({

               url: '/mastering-response-url',

               type: 'POST', 

               data: {

                  _token: $('meta[name="csrf-token"]').attr('content'),

                  accept_user_id: userId,

                  reasonPicture: reasonPicture,

                  reasonDescription: reasonDescription,

                  comments: comments,

                  status: status,

               },

               success: function(response) {

                  if (response.success) {

                     const modal = document.getElementById("myModal");

                     modal.style.display = "none";

                     Swal.fire('Success!','Response submitted successfully!.','success');

                     

                     $('#data-refresh1').load(' #data-refresh2');

                  } else {

                     Swal.fire(

                           'Error!',

                           'There was a problem submit your response,try again.',

                           'error'

                     );

                  }

               },

               error: function(xhr, status, error) {

                  Swal.fire(

                     'Error!',

                     'Something went wrong while processing your request.',

                     'error'

                  );

               }

         });

      }

   }

</script>

<script>

   // Get modal and button elements

   const modal = document.getElementById("myModal");

   const openBtn = document.getElementById("openModal");

   const closeBtn = document.querySelector(".close");

   

   // Open modal when button is clicked

   openBtn.onclick = function () {

      modal.style.display = "block";

   };

   

   // Close modal when (x) is clicked

   closeBtn.onclick = function () {

      modal.style.display = "none";

   };

   

   // Close modal when clicking outside the modal

   window.onclick = function (event) {

      if (event.target === modal) {

            modal.style.display = "none";

      }

   };

</script>

<script>

   window.onload = function () {

       document.addEventListener('keydown', function (event) {

           // Prevent arrow key default scroll behavior

           if (["ArrowRight", "ArrowLeft"].includes(event.key)) {

               event.preventDefault();

           }

   

           if (event.key === 'ArrowRight') {

               const nextBtn = document.querySelector('.next-btn:is(:visible, .active)');

               if (nextBtn) {

                   nextBtn.click();

               } else {

                   // Fallback: click the first visible one

                   const visibleNext = Array.from(document.querySelectorAll('.next-btn'))

                       .find(btn => isVisible(btn));

                   visibleNext?.click();

               }

           }

   

           if (event.key === 'ArrowLeft') {

               const backBtn = document.querySelector('.back-btn:is(:visible, .active)');

               if (backBtn) {

                   backBtn.click();

               } else {

                   const visibleBack = Array.from(document.querySelectorAll('.back-btn'))

                       .find(btn => isVisible(btn));

                   visibleBack?.click();

               }

           }

       });

   

       function isVisible(el) {

           return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);

       }

   };

</script>

<script>

   // $(document).ready(function () {

   //    $('.comment-checkbox').change(function () {

   //       let checkbox = $(this);

   //       let isChecked = checkbox.is(':checked');

   //       let commentId = $(this).val();

   //       let userId = $(this).data('user-id');

   //       let likedUserId = $(this).data('liked-user-id');

   //       $.ajax({

   //          url: '/publish-comment',

   //          method: 'POST',

   //          data: {

   //                _token: $('meta[name="csrf-token"]').attr('content'),

   //                user_id: userId,

   //                liked_user_id: likedUserId,

   //                comment_id: commentId,

   //                status: isChecked ? 1 : 0

   //          },

   //          success: function (response) {

                  

   //          }

   //       });

   //    });

   // });

   

   // $(document).ready(function () {

   //    $('.publish-comment').change(function () {

   //       let selectedOption = $(this);

   //       let isChecked = selectedOption.val(); // "1" or "0"

   //       let commentId = selectedOption.data('comment-id');

   //       let userId = selectedOption.data('user-id');

   //       let likedUserId = selectedOption.data('liked-user-id');

   

   //       $.ajax({

   //             url: '/publish-comment',

   //             method: 'POST',

   //             data: {

   //                _token: $('meta[name="csrf-token"]').attr('content'),

   //                user_id: userId,

   //                liked_user_id: likedUserId,

   //                comment_id: commentId,

   //                status: isChecked

   //             },

   //             success: function (response) {

   //                // Optional: show a toast/alert here

   //             }

   //       });

   //    });

   // });

   $(document).ready(function () {

      $('.publish-comment-btn').click(function () {

         let button = $(this);

         let status = button.data('status');

         let commentId = button.data('comment-id');

         let userId = button.data('user-id');

         let likedUserId = button.data('liked-user-id');

   

         // Remove 'active' class from sibling buttons

         button.siblings().removeClass('active');

         // Add 'active' class to the clicked one

         button.addClass('active');

   

         $.ajax({

               url: '/publish-comment',

               method: 'POST',

               data: {

                  _token: $('meta[name="csrf-token"]').attr('content'),

                  user_id: userId,

                  liked_user_id: likedUserId,

                  comment_id: commentId,

                  status: status

               },

               success: function (response) {



               //    $('#publish-activity').html(`

               // <a href="/show-all/${userId}/view"

               //    class="btn btn-outline-secondary text-white"

               //    style="height: 40px;">

               //    Ok, thanks

               // </a>

               // `);

               Swal.fire({

                  title: 'Ok',

                  text: 'Thanks',

                  icon: 'success',

                  confirmButtonText: 'OK'

               }).then((result) => {

                  if (result.isConfirmed) {

                        window.location.href = `/show-all/${userId}/view`;

                  }

               });

               }

         });

      });

   });   

 
</script>

@endsection