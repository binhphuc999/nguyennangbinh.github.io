@extends('layouts.user')

@section('title', $tran['Contact Us'] . " | ")

@section('content')

@include('frontend.home')
<!-- Contact Us Section Start -->
<section class="view section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-12">
                {!!$setdata['left_ad']!!}
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="card mb-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-left">{{$tran['Contact Us']}} - {{$setdata['name']}}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="change_email">
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            <p>{!! $tran['Contact Description'] !!}</p>
                            @if (empty($setdata['MAIL_FROM_ADDRESS']))
                                <h3 class="text-center mt-5">{{__('We will add a contact from as soon as possible')}}</h3>
                            @else
                            <form action="{{route("contact.store")}}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Your Name"
                                                class="form-control  @error('name') is-invalid @enderror">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Your Email"
                                                class="form-control  @error('email') is-invalid @enderror">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="phone" placeholder="Your Phone"
                                                class="form-control  @error('phone') is-invalid @enderror">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="subject" placeholder="Subject"
                                                class="form-control  @error('subject') is-invalid @enderror">
                                            @error('subject')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea rows="5" name="message" placeholder="Your Message"
                                                class="form-control  @error('message') is-invalid @enderror"></textarea>
                                            @error('message')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-2">{{__('Send Message')}}</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
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
<!-- Contact Us End -->

@include('frontend.features')

@endsection