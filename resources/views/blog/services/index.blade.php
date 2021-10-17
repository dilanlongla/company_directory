@extends('layouts.blog_app')

@section('content')
<!-- Latest Posts -->
<main class="posts-listing col-lg-8">
    <div class="container">
        <div class="row">
            <!-- posts -->
            @foreach ( $services as $service)
            <!-- posts -->
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    <a href="{{ route('blog.services.service', [$service->id]) }}">
                        <img src="{{asset('image/'.$service->image)}}" alt="..." class="img-fluid">
                    </a>
                </div>
                <div class="post-details">
                    <div class="post-meta d-flex justify-content-between">
                        <div class="date meta-last">{{date("F",strtotime($service->created_at))}} | {{date("Y",strtotime($service->created_at))}}</div>

                    </div><a href="{{ route('blog.services.service', [$service->id]) }}">
                        <h3 class="h4">{{$service->title}}</h3>
                    </a>
                    <p class="text-muted">{{$service->body}}</p>
                    <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                            <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><span>{{$service->user->firstname}}</span></div>
                        </a>
                        <div class="date"><i class="icon-clock"></i>{{$service->created_at->diffForHumans()}}</div>
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
            <h3 class="h6">Search the blog</h3>
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
            <h3 class="h6">Latest Services</h3>
        </header>
        <div class="blog-posts">
            @foreach ($latest_services as $service)
            <a href="{{ route('blog.services.service', [$service->id]) }}">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="{{asset('image/'.$service->image)}}" alt="..." class="img-fluid"></div>
                    <div class="title"><strong>{{$service->title}}</strong>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</aside>
@endsection