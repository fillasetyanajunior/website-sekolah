@extends('layouts.base_home',['title' => $title])
@section('title',$title)
@section('content')
    <div class="all-title-box">
		<div class="container text-center">
			<h1>{{$title}}</h1>
		</div>
	</div>
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="row">
                @foreach ($magazine as $showmagazine)
                    <a href="#" target="_blank">
                        <div class="col-lg-3 col-md-6 col-12 my-2">
                            <div class="course-item">
                                <div class="image-blog">
                                    <img src="{{Storage::url($showmagazine->thumnail)}}" alt="" class="img-fluid">
                                </div>
                                <div class="course-br">
                                    <div class="course-title">
                                        <h2><a href="#" title="">{{$showmagazine->title}}</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
