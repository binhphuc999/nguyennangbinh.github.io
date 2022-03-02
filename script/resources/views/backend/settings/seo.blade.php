@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{route('settings')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{__('Seo Settings')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
      <div class="breadcrumb-item active"><a href="{{route('settings')}}">{{__('Settings')}}</a></div>
      <div class="breadcrumb-item">{{__('Seo Settings')}}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{__('All About Seo Settings')}}</h2>
    <p class="section-lead">
      {{__('You can adjust all seo settings here')}}
    </p>

    <div id="output-status"></div>
    <div class="row">
      @include('layouts.setting')
      <div class="col-md-8">
        <form action="{{ route('settings.seo.update')}}" method="POST" autocomplete="on" enctype="multipart/form-data">
          <div class="card" id="settings-card">
            @csrf
            <div class="card-header">
              <h4>{{__('Seo Settings')}}</h4>
            </div>
            <div class="card-body">
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Description')}}</label>
                <div class="col-sm-6 col-md-9">
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    placeholder="Description">{{$setting['description']}}</textarea>
                  @error('description')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Keywords')}}</label>
                <div class="col-sm-6 col-md-9">
                  <textarea rows="5" class="form-control @error('keywords') is-invalid @enderror" name="keywords"
                    placeholder="Keywords">{{$setting['keywords']}}</textarea>
                  @error('keywords')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Google Analytics Code')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" name="google_analytics_code"
                    class="form-control @error('google_analytics_code') is-invalid @enderror"
                    value="{{$setting['google_analytics_code']}}" placeholder="UA-XXXXX-Y">
                  @error('google_analytics_code')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Facebook')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text" name="facebook"
                    class="p-1 form-control @error('facebook') is-invalid @enderror" value="{{$setting['facebook']}}">
                  @error('facebook')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Instagram')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text" name="instagram"
                    class="p-1 form-control @error('instagram') is-invalid @enderror" value="{{$setting['instagram']}}">
                  @error('instagram')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Twitter')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text" name="twitter"
                    class="p-1 form-control @error('twitter') is-invalid @enderror" value="{{$setting['twitter']}}">
                  @error('twitter')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Youtube')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text" name="youtube"
                    class="p-1 form-control @error('youtube') is-invalid @enderror" value="{{$setting['youtube']}}">
                  @error('youtube')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('App Store')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text"  name="appstore"
                    class="p-1 form-control @error('appstore') is-invalid @enderror" required
                    value="{{$setting['appstore']}}">
                  @error('appstore')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Play Store')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text"  name="playstore"
                    class="p-1 form-control @error('playstore') is-invalid @enderror" value="{{$setting['playstore']}}">
                  @error('playstore')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Chrome Extension')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text"  name="chrome_extensions"
                    class="p-1 form-control @error('chrome_extensions') is-invalid @enderror"
                    value="{{$setting['chrome_extensions']}}">
                  @error('chrome_extensions')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{__('Mozilla Extension')}}</label>
                <div class="col-sm-6 col-md-2">
                  <input type="text"  name="mozilla_extensions"
                    class="p-1 form-control @error('mozilla_extensions') is-invalid @enderror"
                    value="{{$setting['mozilla_extensions']}}">
                  @error('mozilla_extensions')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer bg-whitesmoke text-md-right">
              <button class="btn btn-primary" type="submit">{{__('Save Changes')}}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection