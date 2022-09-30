@extends('layouts.base_home',['title' => $title])
@section('title',$title)
@section('content')
    <div class="all-title-box">
        <div class="container text-center">
            <h1>{{$news->title}}</h1>
        </div>
    </div>
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 blog-post-single">
                    <div class="blog-item">
                        <div class="image-blog">
                            <img src="{{Storage::url($news->thumnail)}}" alt="" class="img-fluid">
                        </div>
                        <div class="post-content">
                            <div class="post-date">
                                <span class="day">{{date('d',strtotime($news->created_at))}}</span>
                                <span class="month">{{date('M',strtotime($news->created_at))}}</span>
                            </div>
                            <div class="meta-info-blog">
                                <span><i class="fa fa-calendar"></i> <a href="#">{{date('M d, Y',strtotime($news->created_at))}}</a> </span>
                                <span><i class="fa fa-tag"></i> <a href="#">{{$news->choices}}</a> </span>
                            </div>
                            <div class="blog-title">
                                <h2><a href="#" title="">{{$news->title}}</a></h2>
                            </div>
                            <div class="blog-desc">
                                <p class="text-justify">{!!nl2br(str_replace("{}", " \n", $news->description))!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
