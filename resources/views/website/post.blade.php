@extends('website.layouts.master')
@section('title','Post')


<div class="col-6">
    <!-- Blog post-->
    <div class="card mb-4 ">
        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
        <div class="card-body">
            <div class="small text-muted">January 1, 2023</div>
            <h2 class="card-title h4">{{$post->title}}</h2>
            <p class="card-text">{{substr($post->content , 20 )}} </br>  <small> created by : {{$post->user->name}} </small></p>

            <a class="btn btn-primary" href="{{route('posts.show',["$post->id"]) }}">Read more →</a>
        </div>
    </div>
</div>
