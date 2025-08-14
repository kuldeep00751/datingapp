@extends('admin.layouts.master')
@section('content')
<style>
    .heading_title {
        background: rgba(0, 0, 0, 0.03);
        padding: 10px;
        font-size: 20px;
    }

    .info-header{
        border: 1px solid #e6e6e6;
        margin-bottom: 2rem;
        border-radius: 3px;
    }

    .padding-row-1{
        padding: 1rem;
    }
    .feedback-row .column-align{
        display: flex !important;
        justify-content: center !important;
    }
    
      .text-left{
      text-align:center !important;
      }
      .text-right{
      text-align:right !important;
      }
      .m2{
      margin-bottom: 5rem !important;
      line-height: 0.9;
      margin-top: 1rem;
      }
      .mb6{
      margin-bottom: 3rem;
      }
      .text-pink {
      color: #e596d0 !important;
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
      .feedback-img {
         width: 47px;
         height: 47px;
         color: #fff;
         text-align: center;
      }
      .tl-37
      {
         font-size: 32px;
         font-weight: 100;
         font-family: 'AvenirNext', sans-serif;
         font-style:normal;
         color:#666666;
      }
      .tl-37-1{
         margin-bottom: 0px;
         line-height: 0.8;
      }
      .sub-37 {
         font-size: 24px;
         font-family: 'FutureBTBook', sans-serif;
         color:#fff;
      }
      .feedback-title-comment{
      line-height: 16px !important; 
      font-size: 16px;
      margin-left: 45px;
      font-weight:100 !important;
      }
      .sub-title-37{
        font-size: 2.2rem;
        line-height: 0.5;
        font-family: 'FutureBTBook', sans-serif;
         color:#fff;
        
      }
      .item-infos-content{
        padding: 40px 80px;
        position: relative;
        color: white !important;
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
</style>
<div class="container-fluid py-4">
      <div class="card">
         <!-- Profile Header -->
         <div class="card-header p-3">
            <h5 class="mb-0 p-0"><strong>{{ ucfirst($content->type) }} ({{ $content->locale }})</strong></h5>
         </div>
         <div class="card-body pt-4 p-3">
            {!! $content->content !!}
         </div>
         
      </div>
      <a href="{{ route('legal-contents.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection