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
                                Classroom
                            </div>
                            <h2 class="page-title">
                                {{ $title }}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#AssignmentModal" id="tambahassignment">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @php
                        $i = 1;
                    @endphp
                    @foreach($content as $showcontent)
                        <div class="accordion mb-2" id="accordion-example">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-1">
                                    <div class="row">
                                        <div class="col-lg-11">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$i}}" aria-expanded="true">
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
                                            </button>
                                        </div>
                                        <div class="col-lg-1 dropdown">
                                            <button class="accordion-button" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu ">
                                                <a class="dropdown-item" href="#" data-id="{{$showcontent->id}}" id="editassignment" data-bs-toggle="modal" data-bs-target="#AssignmentModal">
                                                    Edit
                                                </a>
                                                <form action="{{route('learning.teacher.content.destroy',$showcontent->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        Delete
                                                    </button>
                                                </form>
                                                <input type="text" name="url" style="display: none;" value="{{route('learning.teacher.content',Crypt::encrypt($showcontent->id))}}">
                                                <button type="submit" class="dropdown-item" onclick="copy()">
                                                    Copy Link
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </h2>
                                <div id="collapse-{{$i++}}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion-example">
                                    <div class="accordion-body pt-0">
                                        <div class="row">
                                            <div class="{{$showcontent->choices == 'Tugas' ? 'col-lg-10' : 'col-lg-12'}}">
                                                <p style="text-align: justify">{!!nl2br(str_replace("{}", " \n", $showcontent->description))!!}</p>
                                                @php
                                                    $file = App\Models\FileContent::where('id_content',$showcontent->id)->get();
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
                                            @if ($showcontent->choices == 'Tugas')
                                                <div class="col-lg-2 row">
                                                    <div class="col-lg-6">
                                                        <div class="row text-center">
                                                            <h3 class="col-lg-12">0</h3>
                                                            <p class="col-lg-12">Submit</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="row text-center">
                                                            <h3 class="col-lg-12">0</h3>
                                                            <p class="col-lg-12">Assigment</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{route('learning.teacher.content',Crypt::encrypt($showcontent->id))}}">View {{$showcontent->choices == 'Tugas' ? 'Assignment' : $showcontent->choices == 'Materi' ? 'Material' : Kuis}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="AssignmentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_assignment">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_classroom" value="{{$request->id}}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="Memehami Unsur Kimia">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="6"
                                placeholder="Content.."></textarea>
                        </div>
                        <div class="mb-3 choices">
                            <div class="form-label"></div>
                            <select class="form-select" name="choices">
                                <option value="">-- Pilihan --</option>
                                <option value="1">Materi</option>
                                <option value="2">Tugas</option>
                                <option value="3">Kuis</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">File (<small>Opsional</small>)</div>
                            <input type="file" class="form-control" name="file[]" multiple/>
                        </div>
                        <div class="mb-3 deteline">
                            <label class="form-label">Dateline</label>
                            <input type="date" class="form-control" name="dateline">
                        </div>
                        <div class="mb-3 file_kuis">
                            <div class="form-label">File Kuis</div>
                            <input type="file" class="form-control" name="file_kuis" />
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
        function copy() {
            var url = $('input[name="url"]*').select();
            document.execCommand('copy');
            alert('Link copied')
        };
        $(document).ready(function () {

            $('.deteline').hide();
            $('.file_kuis').hide();

            $('#tambahassignment').on('click', function () {
                $('.body_assignment button[type=submit]').text('Add');
                $('.modal-title').text('Tambah Content');
                $('.body_assignment form').attr('action', '{{route("learning.teacher.content.store")}}');
                $('.body_assignment form').attr('method', 'post');

                $('.choices').show();
                $('input[name="judul"]').val('');
                $('textarea[name="description"]').val('');
                $('select[name="choices"]').val('');
            });

            $('#showfile*').click(function () {
                let url = $(this).data('file');
                $('#file').attr('src', url);
            })

            $('select[name="choices"]').change(function () {
                let id = $(this).val();
                if (id == 1) {
                    $('.deteline').hide();
                    $('.file_kuis').hide();
                } else if (id == 2) {
                    $('.deteline').show();
                    $('.file_kuis').hide();
                } else {
                    $('.deteline').show();
                    $('.file_kuis').show();
                }
            });

            $('#editassignment*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("learning.teacher.content.edit",":id")}}'.replace(':id', id);

                $('.body_assignment button[type=submit]').text('Edit');
                $('.modal-title').text('Edit Content');
                $('.body_assignment form').attr('action', '{{route("learning.teacher.content.update",":id")}}'.replace(':id', id));
                $('.body_assignment form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('input[name="judul"]').val(hasil.judul);
                        $('textarea[name="description"]').val(hasil.description);
                        $('.choices').hide();
                    }
                });
            });

            if ($('body').is(".theme-dark")) {
                $(".text-data").addClass("text-white");
            } else if ($("body").is(".theme-light")) {
                $(".text-data").addClass("text-black");
            }
        });

    </script>
@endpush
