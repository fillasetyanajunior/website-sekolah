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
                <div class="container-fluid">
                    <div class="row row-deck row-cards">
                        @if ($content->choices == 'Materi')
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p style="text-align: justify">{!!nl2br(str_replace("{}", " \n",$content->description))!!}</p>
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
                                                    <span class="avatar"style="background-image: url({{url('assets/dashboard/dist/img/pdf.png')}})"></span>
                                                @endif
                                                {{Str::before(Str::after($showfile->path, 'classroom/'),'.' . $showfile->extension )}}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <p style="text-align: justify">{!!nl2br(str_replace("{}", " \n",$content->description))!!}</p>
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
                                                        <span class="avatar"style="background-image: url({{url('assets/dashboard/dist/img/pdf.png')}})"></span>
                                                    @endif
                                                    {{Str::before(Str::after($showfile->path, 'classroom/'),'.' . $showfile->extension )}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="list-group card-list-group">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($assigment as $showassigment)
                                            <div class="list-group-item">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-auto ms-3">
                                                        {{$i++}}
                                                    </div>
                                                    <div class="col-auto">
                                                        <img src="{{App\Models\StudentDetail::find($showassigment->id_siswa)->foto == null ? url('assets/dashboard/dist/img/default.png') : Storage::url(App\Models\StudentDetail::find($showassigment->id_siswa)->foto)}}" class="rounded"
                                                            alt="{{App\Models\StudentDetail::find($showassigment->id_siswa)->nama}}" width="40" height="40">
                                                    </div>
                                                    <div class="col ms-3">
                                                        {{App\Models\StudentDetail::find($showassigment->id_siswa)->nama}}
                                                        <div class="text-muted mt-2">
                                                            @php
                                                                $file = App\Models\FileAssigment::where('id_assigment',$showassigment->id)->get();
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
                                                                        {{Str::before(Str::after($showfile->path, 'assigment/'),'.' . $showfile->extension )}}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
