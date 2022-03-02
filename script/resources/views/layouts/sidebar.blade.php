<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{route('admin')}}">{{$setdata['name']}}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{route('admin')}}">{{ Str::limit($setdata['name'], 2 , '') }}</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">{{request()->segment(2)}}</li>

      <li {{request()->segment(2) == "dashboard" ? 'class=active' : ""}}>
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-fire"></i> <span>{{__('Dashboard')}}</span>
        </a>
      </li>

      <li {{request()->segment(2) == "categories" ? 'class=active' : ""}}>
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="fas fa-pencil-ruler"></i><span>{{__('Categories')}}</span>
        </a>
      </li>

      <li {{request()->segment(2) == "posts" ? 'class=active' : ""}}>
        <a class="nav-link" href="{{ route('posts.index') }}">
          <i class="fas fa-newspaper"></i> <span>{{__('Posts')}}</span>
        </a>
      </li>

      <li {{request()->segment(2) == "pages" ? 'class=active' : ""}}>
        <a class="nav-link" href="{{ route('pages.index') }}">
          <i class="fas fa-file-alt"></i><span>{{__('Pages')}}</span>
        </a>
      </li>

      <li {{request()->segment(2) == "features" ? 'class=active' : ""}}>
        <a class="nav-link" href="{{ route('features.index') }}">
          <i class="fas fa-paint-brush"></i><span>{{__('Features')}}</span>
        </a>
      </li>

      <li {{request()->segment(2) == "settings" ? 'class=active' : ""}}>
        <a class="nav-link" href="{{ route('settings') }}">
          <i class="fas fa-cog"></i> <span>{{__('Settings')}}</span>
        </a>
      </li>

    </ul>
  </aside>
</div>