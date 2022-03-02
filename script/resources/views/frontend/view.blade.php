@extends('layouts.user')


@section('title',$message['subject'] . " | ")


@section('content')
@include('frontend.home')

<!-- View Section Start -->
<section class="view section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-12 mb-3">
        {!!$setdata['left_ad']!!}
      </div>
      <div class="col-md-8 col-sm-12">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-6 text-left"><a href="{{route('home') }}">{{$tran['Back To List']}}</a></div>
              <div class="col-6 text-right">
                @if (count($message['attachments']))
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <span class="d_show_line"><i class="fas fa-paperclip"></i></span><span class="d_hide">{{$tran['Attachments']}}</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  @foreach ($message['attachments'] as $item)
                  <a class="dropdown-item" href="{{$item['url']}}">{{$item['file']}}</a>
                  @endforeach
                </div>
                @endif
                <a href="{{route('delete.message' ,$message['id'] ) }}">{{$tran['Delete']}}</a>
              </div>
            </div>

          </div>
          <div class="card-body">
            <div class="info">
              <div class="row">
                <div class="col-6 ov-h from">{{$message['from']}}<span>{{$message['from_email']}}</span></div>
                <div class="col-6 text-right ov-h from">{{__('Date')}}:<span>{{$message['receivedAt']}}</span></div>
              </div>
            </div>
            <div class="info">
              <div class="row">
                <div class="col-12 ov-h subject">{{__('Subject')}} :<span>{{$message['subject']}}</span></div>
              </div>
            </div>
            <div class="content"><iframe frameborder="0" scrolling="no" width="100%" src="{{route('message' , $message['id'])}}" id="myIframe"></iframe></div>
          </div>
        </div>
        {!!$setdata['bottom_ad']!!}
      </div>
      <div class="col-md-2  col-sm-12">
        {!!$setdata['right_ad']!!}
      </div>
    </div>
  </div>
</section>
<!-- View Section End -->
@include('frontend.features')

@endsection