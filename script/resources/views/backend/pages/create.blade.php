@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{route('pages.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{__('Create New Page')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
      <div class="breadcrumb-item"><a href="{{route('pages.index')}}">{{__('Pages')}}</a></div>
      <div class="breadcrumb-item">{{__('Create New Page')}}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{__('Create New Page')}}</h2>
    <p class="section-lead">
      {{__('On this page you can create a new page and fill in all fields.')}}
    </p>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>{{__('Write Your Page')}}</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('pages.store')}}" method="POST" autocomplete="on" enctype="multipart/form-data">
              @csrf
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Title')}}</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" required placeholder="Titel">
                  @error('title')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Slug')}}</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    value="{{ old('slug') }}" required placeholder="Slug">
                  @error('slug')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Content')}}</label>
                <div class="col-sm-12 col-md-7">
                  <textarea id="summernote" name="content">{{ old('content') }}</textarea>
                  <div class="mb-3">
                    <input type="hidden" class="form-control @error('content') is-invalid @enderror">
                    @error('content')
                    <div class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Status')}}</label>
                <div class="col-sm-12 col-md-7">
                  <select class="form-control selectric" name="status">
                    <option value="1">{{__('Publish')}}</option>
                    <option value="0">{{__('Draft')}}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button class="btn btn-primary">{{__('Create Page')}}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
<link href="{{ asset('assets/css/selectric.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/summernote-bs4.css') }}" rel="stylesheet">
@endpush

@push('libraies')
<script src="{{ asset('assets/js/vendor/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/summernote-fontawesome.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.selectric.min.js') }}"></script>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/vendor/summernote.js') }}"></script>
<!--SET DYNAMIC VARIABLE IN SCRIPT -->
<script type="text/javascript">
  var checkslug_title = "{{route('pages.checkslug')}}";
  </script>
@endpush