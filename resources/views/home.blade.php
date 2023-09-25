@extends('website.layouts.master')
@section('title','Home')

@section('content')
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>

            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            {{-- <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2023</div>
                    <h2 class="card-title">Featured Post Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a class="btn btn-primary" href="#!">Read more →</a>
                </div>
            </div> --}}
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-6">
                        <!-- Blog post-->
                        <div class="card mb-4 ">
                            <a href="#!"><img class="card-img-top" src="{{asset($post->image_path)}}" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted">{{$post->created_at->diffforhumans()}}</div>
                                <h2 class="card-title h4">{{$post->title}}</h2>
                                <p class="card-text">{{substr($post->content ,0, 20 )}} </br>  <small> created by : {{$post->user->name}} </small></p>

                                <a class="btn btn-primary" href="{{route('posts.show',["$post->id"]) }}">Read more →</a>
                            </div>
                        </div>
                    </div>

                @endforeach



            </div>
            <!-- Pagination-->

            {{$posts->links('website.layouts.pagination')}}
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <form method="get" action="{{route('posts.index') }}">
                            <input class="form-control" type="text" placeholder="Enter search term..."
                                   aria-label="Enter search term..." aria-describedby="button-search" name="search"
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary" id="button-search" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    @foreach ($post->categories as $category)
                        <ul class="list-unstyled mb-0">
                            <li> <a type="button" href=" ">{{$category->name}}</a></li>
                        </ul>

                    @endforeach
                    </div>
                </div>
            </div>
            {{-- <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div> --}}
        </div>
    </div>
@endsection
