@extends('layouts.blog_app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8">
            <div class="container">
                <div class="post-single">
                    <div class="post-thumbnail"><img src="{{asset('image/'.$service->image)}}" alt="..." class="img-fluid"></div>
                    <div class="post-details">
                        <h1>{{$service->title}}<a href="{{ route('blog.services.service', [$service->id]) }}"><i class="fa fa-bookmark-o"></i></a></h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{$service->user->firstname}}</span></div>
                            </a>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="date"><i class="icon-clock"></i>{{$service->created_at->diffForHumans()}}</div>
                                <!-- <div class="views"><i class="icon-eye"></i> 500</div> -->
                            </div>
                        </div>
                        <div class="post-body">
                            {{$service->body}}
                        </div>
                        <div class="post-tags"><a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a><a href="#" class="tag">#Economy</a></div>
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row"><a href="#" class="prev-post text-left d-flex align-items-center">
                                <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                                <div class="text"><strong class="text-primary">Previous Service</strong>
                                    <h6>{{$previous->title}}</h6>
                                </div>
                            </a><a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                                <div class="text"><strong class="text-primary">Next Service </strong>
                                    <h6>{{$next->title}}</h6>
                                </div>
                                <div class="icon next"><i class="fa fa-angle-right"> </i></div>
                            </a></div>
                    </div>
                </div>
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
                            <div class="image"><img src="{{asset('img/featured-pic-1.jpeg')}}" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>{{$service->title}}</strong>

                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

        </aside>
    </div>
</div>

@endsection