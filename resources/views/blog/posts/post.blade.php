@extends('layouts.blog_app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8">
            <div class="container">
                <div class="post-single">
                    <div class="post-thumbnail"><img src="{{asset('image/'.$post->image)}}" alt="..." class="img-fluid"></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="category">
                                @foreach ($post->categories as $category)
                                <a href="{{route('blog.posts.category', [$category->id])}}">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        <h1>{{$post->title}}<a href="{{ route('blog.posts.post', [$post->id]) }}"><i class="fa fa-bookmark-o"></i></a></h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{$post->user->firstname}}</span></div>
                            </a>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="date"><i class="icon-clock"></i>{{$post->created_at->diffForHumans()}}</div>
                                <!-- <div class="views"><i class="icon-eye"></i> 500</div> -->
                                <div class="comments meta-last"><i class="icon-comment"></i>{{count($post->comments)}}</div>
                            </div>
                        </div>
                        <div class="post-body">
                            {{$post->body}}
                        </div>
                        <div class="post-tags"><a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a><a href="#" class="tag">#Economy</a></div>
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row"><a href="#" class="prev-post text-left d-flex align-items-center">
                                <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                                <div class="text"><strong class="text-primary">Previous Post</strong>
                                    <h6>{{$previous->title}}</h6>
                                </div>
                            </a><a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                                <div class="text"><strong class="text-primary">Next Post </strong>
                                    <h6>{{$next->title}}</h6>
                                </div>
                                <div class="icon next"><i class="fa fa-angle-right"> </i></div>
                            </a></div>
                        <div class="post-comments">
                            <header>
                                <h3 class="h6">Post Comments<span class="no-of-comments">{{count($post->comments)}}</span></h3>
                            </header>
                            @foreach ($post->comments as $comment)
                            <div class="comment">
                                <div class="comment-header d-flex justify-content-between">
                                    <div class="user d-flex align-items-center">
                                        <div class="image"><img src="{{asset('img/free_profile.png')}}" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="title"><strong>{{$comment->name}}</strong><span class="date">{{date("F",strtotime($comment->created_at))}} | {{date("Y",strtotime($comment->created_at))}}</span></div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>{{$comment->comment}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="add-comment">
                            <header>
                                <h3 class="h6">Leave a reply</h3>
                            </header>
                            <form action="{{ route('comments.store') }}" class="commenting-form" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="text" name="post_id" value="{{$post->id}}" class="form-control" hidden>
                                    <div class="form-group col-md-6">
                                        <input type="text" name="name" id="username" placeholder="Name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" name="email" id="useremail" placeholder="Email Address (will not be published)" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="comment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-secondary">Submit Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                    <h3 class="h6">Latest Posts</h3>
                </header>
                <div class="blog-posts">
                    @foreach ($latest_posts as $post)
                    <a href="{{ route('blog.posts.post', [$post->id]) }}">
                        <div class="item d-flex align-items-center">
                            <div class="image"><img src="{{asset('img/featured-pic-1.jpeg')}}" alt="..." class="img-fluid"></div>
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
    </div>
</div>

@endsection