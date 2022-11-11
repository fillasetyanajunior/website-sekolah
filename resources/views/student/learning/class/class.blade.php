@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-learning></x-sliderbar-learning>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Classroom
                            </div>
                            <h2 class="page-title">
                                {{ $title }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row row-deck row-cards">
                        @foreach ($content as $showcontent)
                            <a href="{{route('learning.student.content',Crypt::encrypt($showcontent->id))}}" class="col-sm-12 col-lg-12 text-data" style="text-decoration: none;">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                                                <line x1="9" y1="7" x2="15" y2="7"></line>
                                                <line x1="9" y1="11" x2="15" y2="11"></line>
                                                <line x1="9" y1="15" x2="13" y2="15"></line>
                                            </svg>
                                            &nbsp;
                                            {{$showcontent->judul}}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            if ($('body').is(".theme-dark")) {
                $(".text-data").addClass("text-white");
            } else if ($("body").is(".theme-light")) {
                $(".text-data").addClass("text-black");
            }
        });
    </script>
@endpush
