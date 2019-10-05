<aside class="menu">
  <p class="menu-label">
    General
  </p>
  <ul class="menu-list">
    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
  </ul>
  <p class="menu-label">
    Administration
  </p>
  <ul class="menu-list">
    <li>
      <a class="">Manage Your Site</a>
      <ul>
        <li><a href="{{ route('dashboard.categories')}}">Categories</a></li>
        <li><a href="{{ route('dashboard.experiences')}}">Experiences</a></li>
        <li><a href="{{route('dashboard.fotogalerie')}}">Fotogalerie</a></li>
      </ul>
    </li>
  </ul>
</aside>