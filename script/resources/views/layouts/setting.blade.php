<div class="col-md-4">
    <div class="card">
        <div class="card-header">
        <h4>{{__('Jump To')}}</h4>
        </div>
        <div class="card-body">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item"><a href="{{route('settings.general')}}" class="nav-link {{ Request()->segment(3) == "general" ? "active" : '' }}">{{__('General Settings')}}</a></li>
            <li class="nav-item"><a href="{{route('settings.seo')}}" class="nav-link {{ Request()->segment(3) == "seo" ? "active" : '' }}">{{__('SEO')}}</a></li>
            <li class="nav-item"><a href="{{route('settings.ads')}}" class="nav-link {{ Request()->segment(3) == "ads" ? "active" : '' }}">{{__('Ads')}}</a></li>
            <li class="nav-item"><a href="{{route('settings.blog')}}" class="nav-link {{ Request()->segment(3) == "blog" ? "active" : '' }}">{{__('Blog Settings')}}</a></li>
            <li class="nav-item"><a href="{{route('settings.smtp')}}" class="nav-link {{ Request()->segment(3) == "smtp" ? "active" : '' }}">{{__('SMTP')}}</a></li>
            <li class="nav-item"><a href="{{route('settings.frontend')}}" class="nav-link {{ Request()->segment(3) == "frontend" ? "active" : '' }}">{{__('Frontend Settings')}}</a></li>
        </ul>
        
        </div>
    </div>
</div>