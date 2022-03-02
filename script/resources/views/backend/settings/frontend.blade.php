@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{route('settings')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{__('Frontend Settings')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
      <div class="breadcrumb-item active"><a href="{{route('settings')}}">{{__('Settings')}}</a></div>
      <div class="breadcrumb-item">{{__('Frontend Settings')}}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{__('All About Frontend Settings')}}</h2>
    <p class="section-lead">
      {{__('You can adjust all Frontend settings here')}}
    </p>

    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('settings.frontend.update')}}" method="POST" autocomplete="on"
          enctype="multipart/form-data">
          <div class="card" id="settings-card">
            @csrf
            <div class="card-header">
              <h4>{{__('Frontend Settings')}}</h4>
            </div>
            <div class="card-body">
              @foreach ($translation as $translate)
              <div class="row mb-2">
                <div class="col-sm-5">{{$translate->key}}</div>
                <div class="col-sm-7"><input type="text" name="values[{{$translate->id}}]" class="form-control"
                    value="{{$translate->value}}"></div>
              </div>
              @endforeach

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