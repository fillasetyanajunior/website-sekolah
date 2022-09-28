@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-learning></x-sliderbar-learning>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Home
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        @foreach ($class as $showclass)
                            <div class="col-sm-6 col-lg-6 text-center">
                                <div class="card">
                                    <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url(./static/photos/9f36332564ca271d.jpg)"></div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="{{route('learning.student.' . Str::lower($showclass->nama),Crypt::encrypt($showclass->id))}}">{{$showclass->nama}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
