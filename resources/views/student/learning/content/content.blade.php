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
                                                {{Str::before(Str::after($showfile->path, 'classroom/'),'.' . $showfile->extension )}}
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
                                                @if ($assigment != null)
                                                    @if ($assigment->choices == 'Submit')
                                                        <p class="badge bg-indigo">Submitted</p>
                                                    @else
                                                        @if (date('H:i:s') > date('Y-m-d, H:i:s',strtotime($content->dateline)))
                                                            <p class="badge bg-red">Submitted in Late</p>
                                                        @else
                                                            <p class="badge bg-green">Assigned</p>
                                                        @endif
                                                    @endif
                                                @else
                                                    @if (date('H:i:s') > date('Y-m-d, H:i:s',strtotime($content->dateline)))
                                                        <p class="badge bg-red">Submitted in Late</p>
                                                    @else
                                                        <p class="badge bg-green">Assigned</p>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            @if ($assigment != null)
                                                @php
                                                    $file2 = App\Models\FileAssigment::where('id_assigment',$assigment->id)->get();
                                                @endphp
                                                <div class="btn-list col-lg-12">
                                                    @foreach ($file2 as $showfile2)
                                                        <a class="btn {{$assigment != null ? $assigment->choices == 'Submit' ? 'col-lg-12' : 'col-lg-10' : 'col-lg-10'}}" target="_blank" href="{{Storage::url($showfile2->path)}}">
                                                            @if ($showfile2->extension == 'xls' || $showfile2->extension == 'xlsx')
                                                                <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/excel.png')}})"></span>
                                                            @elseif ($showfile2->extension == 'doc' || $showfile2->extension == 'docx')
                                                                <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/word.png')}})"></span>
                                                            @elseif ($showfile2->extension == 'ppt' || $showfile2->extension == 'pptx')
                                                                <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/ppt.png')}})"></span>
                                                            @elseif ($showfile2->extension == 'rar')
                                                                <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/rar.png')}})"></span>
                                                            @elseif ($showfile2->extension == 'pdf')
                                                                <span class="avatar" style="background-image: url({{url('assets/dashboard/dist/img/pdf.png')}})"></span>
                                                            @endif
                                                            @php
                                                                $title = Str::before(Str::after($showfile2->path, 'assigment/'),'.' . $showfile2->extension);
                                                            @endphp
                                                            @if (strlen($title) > 20)
                                                                {{substr($title,0, 20)}}
                                                            @else
                                                                {{$title}}
                                                            @endif
                                                        </a>
                                                        @if ($assigment != null)
                                                            @if ($assigment->choices == 'Submit')
                                                            @else
                                                                <form action="{{route('learning.student.content.destroy',Crypt::encrypt($title .  '.' . $showfile2->extension))}}"
                                                                    method="post" class="col-lg-1">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <form action="{{route('learning.student.content.destroy',Crypt::encrypt($title .  '.' . $showfile2->extension))}}" method="post" class="col-lg-1">
                                                                @csrf
                                                                <button type="submit" class="btn btn-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24"
                                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <form action="{{$assigment != null ? $assigment->choices == 'Submit' ? route('learning.student.content.unsubmit',Crypt::encrypt($content->id)) : route('learning.student.content.submit',Crypt::encrypt($content->id)) : route('learning.student.content.submit',Crypt::encrypt($content->id))}}" method="post">
                                            @csrf
                                            @if ($assigment != null)
                                                @if ($assigment->choices == 'Submit')
                                                @else
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-primary col-lg-12" id="fileassigment" data-bs-target="#AssigmentModal" data-bs-toggle="modal">Upload</button>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-primary col-lg-12" id="fileassigment" data-bs-target="#AssigmentModal" data-bs-toggle="modal">Upload</button>
                                                </div>
                                            @endif
                                            @if ($assigment != null)
                                                @if ($assigment->choices == 'Submit')
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-dark col-lg-12">Unsubmit</button>
                                                    </div>
                                                @else
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-dark col-lg-12">Submit</button>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-dark col-lg-12">Submit</button>
                                                </div>
                                            @endif
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
<div class="modal modal-blur fade" id="AssigmentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body-file">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_content" value="{{$content->id}}">
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" name="file[]" id="file" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#fileassigment').click(function () {
                $('.modal-title').text('Upload File');
                $('.body-file form').attr('action', '{{route("learning.student.content.store")}}');
                $('.body-file button[type="submit"]').text('Submit');
            });
        });
    </script>
@endpush
