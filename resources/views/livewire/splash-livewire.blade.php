<div class="page page-center">
    <div class="container container-tight py-4" style="display: {{$display == 1 ? '' : 'none'}}">
        <div class="text-center mb-4">
            <img src="{{url('assets/auth/images/avatar-01.png')}}" height="36" alt="">
        </div>
        <div class="card">
            <div class="card-body text-center py-4 p-sm-5">
                <h1 class="mt-5">MAN Buleleng</h1>
            </div>
            <div class="hr-text hr-text-center hr-text-spaceless">your data</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <select class="form-select" wire:model="kelas" wire:change="jurusan_no_kelas">
                        <option value="">-- Pilih --</option>
                        @foreach ($allkelas as $showallkelas)
                            @php
                                $valikelas = null;
                            @endphp
                            @if ($showallkelas->kelas != $valikelas)
                                <option value="{{$showallkelas->kelas}}">{{$showallkelas->kelas}}</option>
                            @endif
                            @php
                                $valikelas = $showallkelas->kelas;
                            @endphp
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan/Bagian Kelas</label>
                    <select class="form-select" wire:model="jurusan_no_kelas" wire:change="matapelajaran">
                        <option value="">-- Pilih --</option>
                        @php
                            $validjurusan = null;
                            $validno_kelas = null;
                        @endphp
                        @foreach ($alljurusan_no_kelas as $showalljurusan_no_kelas)
                            @if ($kelas == 'X')
                                @if ($showalljurusan_no_kelas->no_kelas != $validno_kelas && $showalljurusan_no_kelas->no_kelas != null)
                                    <option value="{{$showalljurusan_no_kelas->no_kelas}}">{{$showalljurusan_no_kelas->no_kelas}}</option>
                                @endif
                                @php
                                    $validno_kelas = $showalljurusan_no_kelas->no_kelas;
                                @endphp
                            @else

                                @if ($showalljurusan_no_kelas->jurusan != $validjurusan && $showalljurusan_no_kelas->jurusan != null)
                                    <option value="{{App\Models\Department::find($showalljurusan_no_kelas->jurusan)->jurusan}}">{{App\Models\Department::find($showalljurusan_no_kelas->jurusan)->jurusan}}</option>
                                @endif
                                @php
                                    $validjurusan = $showalljurusan_no_kelas->jurusan;
                                @endphp
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <select class="form-select" wire:model="matapelajaran">
                        <option value="">-- Pilih --</option>
                        @foreach ($allmatapelajaran as $showallmatapelajaran)
                            <option value="{{App\Models\Subject::find($showallmatapelajaran->matapelajaran)->matapelajaran}}">{{App\Models\Subject::find($showallmatapelajaran->matapelajaran)->matapelajaran}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col-4">
                <div class="progress">
                    <div class="progress-bar" style="width: 50%" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                        aria-valuemax="100" aria-label="50% Complete">
                        <span class="visually-hidden">50% Complete</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="btn-list justify-content-end">
                    <button type="button" wire:click="next" class="btn btn-primary">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container container-tight py-4" style="display: {{$display == 2 ? '' : 'none'}}">
        <div class="text-center mb-4">
            <img src="{{url('assets/auth/images/avatar-01.png')}}" height="36" alt="">
        </div>
        <div class="card">
            <div class="card-body text-center py-4 p-sm-5">
                <h1 class="mt-5">MAN Buleleng</h1>
            </div>
            <div class="hr-text hr-text-center hr-text-spaceless">your data</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" wire:model="judul" id="judul" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea wire:model="description" id="description" rows="10" class="form-control"></textarea>
                </div>
                <div class="card" style="overflow: auto; white-space: nowrap; padding:10px; height:300px;">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($materi as $showmateri)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$showmateri->judul}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col-4">
                <div class="progress">
                    <div class="progress-bar" style="width: 100%" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                        aria-valuemax="100" aria-label="100% Complete">
                        <span class="visually-hidden">100% Complete</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="btn-list justify-content-end">
                    <button type="button" wire:click="back" class="btn btn-link link-secondary">
                       Back
                    </button>
                    <button type="button" wire:click="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
