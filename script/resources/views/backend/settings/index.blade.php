@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{__('Settings')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item">{{__('Settings')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('Overview')}}</h2>
        <p class="section-lead">
            {{__('Organize and adjust all settings about this site.')}}
        </p>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{__('General')}}</h4>
                        <p>{{__('General settings such as, site title, logo , and advanced settings.')}}</p>
                        <a href="{{route('settings.general')}}" class="card-cta">{{__('Change Setting')}} <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{__('SEO')}}</h4>
                        <p>{{__('Search engine optimization settings, such as meta tags and social media.')}}</p>
                        <a href="{{route('settings.seo')}}" class="card-cta">{{__('Change Setting')}} <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-rss"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{__('Blog')}}</h4>
                        <p>{{__('Blog settings such as, enable blog, max mosts in page , and more.')}}</p>
                        <a href="{{route('settings.blog')}}" class="card-cta">{{__('Change Setting')}} <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{__('SMTP')}}</h4>
                        <p>{{__('Email SMTP settings, contact us and others related to email.')}}</p>
                        <a href="{{route('settings.smtp')}}" class="card-cta">{{__('Change Setting')}} <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-swatchbook"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{__('Frontend')}}</h4>
                        <p>{{__('Frontend settings such as edit all site headline , paragraph and texts.')}}</p>
                        <a href="{{route('settings.frontend')}}" class="card-cta">{{__('Change Setting')}} <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-body">
                        <h4>{{__('Ads')}}</h4>
                        <p>{{__('Manage all ads ,And earn money from advertising')}}</p>
                        <a href="{{route('settings.ads')}}" class="card-cta text-primary">{{__('Change Setting')}} <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection