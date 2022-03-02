@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{route('posts.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{__('Edit Post')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
      <div class="breadcrumb-item"><a href="{{route('posts.index')}}">{{__('Posts')}}</a></div>
      <div class="breadcrumb-item">{{__('Edit Post')}}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{__('Edit Post')}}</h2>
    <p class="section-lead">
      {{__('On this page you can edit post and fill in all fields.')}}
    </p>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>{{__('Edit Your Post')}}</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('posts.update' , $post->id) }}" method="POST" autocomplete="on"
              enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Title')}}</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ $post->title }}" required placeholder="Titel">
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
                    value="{{ $post->slug }}" required placeholder="Slug">
                  @error('slug')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Description')}}</label>
                <div class="col-sm-12 col-md-7">
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" required
                    placeholder="Description">{{ $post->description }}</textarea>
                  @error('description')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Category')}}</label>
                <div class="col-sm-12 col-md-7">
                  <select class="form-control selectric" required name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                      {{$category->name}}
                    </option>
                    @endforeach
                  </select>
                  <div class="mb-3">
                    <input type="hidden" class="form-control @error('category_id') is-invalid @enderror">
                    @error('category_id')
                    <div class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Content')}}</label>
                <div class="col-sm-12 col-md-7">
                  <textarea id="summernote" name="content">{{ $post->content }}</textarea>
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
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Thumbnail')}}</label>
                <div class="col-sm-12 col-md-7">
                  <div id="image-preview" class="image-preview bg-preview">
                    <label for="image-upload" id="image-label">{{__('Change Thumbnail')}}</label>
                    <input type="file" name="thumbnail" id="image-upload" />
                  </div>
                  <div class="mb-3">
                    <input type="hidden" class="form-control @error('thumbnail') is-invalid @enderror">
                    @error('thumbnail')
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
                    <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>{{__('Publish')}}</option>
                    <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>{{__('Draft')}}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button class="btn btn-primary">{{__('Update')}}</button>
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
<!--SET DYNAMIC VARIABLE IN STYLE-->
<style>
  .bg-preview{
    background-image: url('{{ asset(url($post->image))}}');
  }
</style>
@endpush

@push('libraies')
<script src="{{ asset('assets/js/vendor/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/summernote-fontawesome.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.selectric.min.js') }}"></script>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/vendor/uploadPreview_custom.js') }}"></script>
<script src="{{ asset('assets/js/vendor/summernote.js') }}"></script>
@endpush