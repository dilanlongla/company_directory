@extends('layouts.blog_app')

@section('content')
<!-- Latest Posts -->
<main class="posts-listing col-lg-8">
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
            <!-- post -->
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    <a href="{{ route('blog.posts.post', [$post->id]) }}">
                        <img src="{{asset('image/'.$post->image)}}" alt="..." class="img-fluid">
                    </a>
                </div>
                <div class="post-details">
                    <div class="post-meta d-flex justify-content-between">
                        <div class="date meta-last">{{date("F",strtotime($post->created_at))}} | {{date("Y",strtotime($post->created_at))}}</div>
                        <div class="category">
                            @foreach ($post->categories as $category)
                            <a href="{{route('blog.posts.category', [$category->id])}}">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div><a href="{{ route('blog.posts.post', [$post->id]) }}">
                        <h3 class="h4">{{$post->title}}</h3>
                    </a>
                    <p class="text-muted">{{$post->body}}</p>
                    <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                            <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><span>{{$post->user->firstname}}</span></div>
                        </a>
                        <div class="date"><i class="icon-clock"></i>{{$post->created_at->diffForHumans()}}</div>
                        <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                    </footer>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-template d-flex justify-content-center">
                <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
                <li class="page-item"><a href="#" class="page-link active">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
            </ul>
        </nav>
    </div>
</main>
<aside class="col-lg-4">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
        <header>
            <h3 class="h6">Search for a service</h3>
        </header>
        <form action="#" class="search-form">
            <div class="form-group">
                <input type="search" placeholder="What are you looking for?">
                <button type="submit" class="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">Latest Posts</h3>
        </header>
        <div class="blog-posts">
            @foreach ($latest_posts as $post)
            <a href="{{ route('blog.posts.post', [$post->id]) }}">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="{{asset('image/'.$post->image)}}" alt="..." class="img-fluid"></div>
                    <div class="title"><strong>{{$post->title}}</strong>
                        <div class="d-flex align-items-center">
                            <div class="comments"><i class="icon-comment"></i>{{count($post->comments)}}</div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
        <header>
            <h3 class="h6">Categories</h3>
        </header>
        @foreach ($categories as $category)
        <div class="item d-flex justify-content-between"><a href="{{route('blog.posts.category', [$category->id])}}">{{$category->name}}</a><span>{{count($category->posts)}}</span></div>
        @endforeach
    </div>
</aside>
@endsection