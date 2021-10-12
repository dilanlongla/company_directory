<li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}"><a href="{{ route('blog.posts.index') }}" class="nav-link ">Home</a>
</li>
<li class="nav-item {{ Request::is('services*') ? 'active' : '' }}"><a href="{{ route('blog.services.index') }}" class="nav-link ">Services</a>
</li>
<li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}"><a href="{{ route('register') }}" class="nav-link ">Get known</a>
</li>
<li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}"><a href="{{ route('posts.index') }}" class="nav-link ">Login</a>
</li>