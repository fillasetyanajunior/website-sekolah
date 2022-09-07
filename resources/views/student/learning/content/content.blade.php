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
                                {{$class}}
                            </div>
                            <h2 class="page-title">
                                {{ $title }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="{{$content->choices == 'Tugas' ? 'col-lg-9' : 'col-lg-12'}}">
                            <div class="card">
                                <div class="card-body">
                                    <p style="text-align: justify">{!!nl2br(str_replace("{}", "\n",$content->description))!!}</p>
                                    @php
                                        $file = App\Models\FileContent::where('id_content',$content->id)->get();
                                    @endphp
                                    <div class="btn-list">
                                        @foreach ($file as $showfile)
                                        <a class="btn" target="_blank" href="{{Storage::url($showfile->path)}}">
                                            @if ($showfile->extension == 'xls' || $showfile->extension == 'xlsx')
                                            <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/excel.png')}})"></span>
                                            @elseif ($showfile->extension == 'doc' || $showfile->extension == 'docx')
                                            <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/word.png')}})"></span>
                                            @elseif ($showfile->extension == 'ppt' || $showfile->extension == 'pptx')
                                            <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/ppt.png')}})"></span>
                                            @elseif ($showfile->extension == 'rar')
                                            <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/rar.png')}})"></span>
                                            @elseif ($showfile->extension == 'pdf')
                                            <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/pdf.png')}})"></span>
                                            @endif
                                            {{Str::before(Str::after($showfile->path, 'classroom/'),'.' .
                                            $showfile->extension )}}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($content->choices == 'Tugas')
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div>
                                                <h3>Work</h3>
                                            </div>
                                            <div class="ms-auto">
                                                {{$assigments}}
                                            </div>
                                        </div>
                                        <form action="" method="post">
                                            <button type="submit" class="btn btn-dark col-lg-12">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
