@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
    <div class="page">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-4">
                        <div class="col-3">
                            <div>
                                <div class="list-group list-group-transparent mb-3">
                                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ModalAbsenManual">Absen Manual</button>
                                    <button type="button" class="btn btn-primary mb-5" id="absenqr" data-bs-toggle="modal" data-bs-target="#ModalAbsenQR">Absen QR</button>
                                    <button type="button" class="btn btn-primary mb-3" href="#">Logout</button>
                                </div>
                                <div class="list-group list-group-transparent mb-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="" value="{{$hari[date('N')] . date(' ,d F Y')}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="lama_sesi" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="" value="{{$jam_end}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="jam_end" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="" value="{{$studentcount}}" readonly>
                                    </div>
                                </div>
                                <div class="list-group list-group-transparent mb-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control text-center" id="status" style="height: 200px; font-size:20pt;" readonly >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                           <div class="card bg-red mb-5">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="text" id="matapelajaran" class="form-control text-center" value="{{App\Models\TeacherDetail::find($material->guru)->nama}}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" id="kelas" class="form-control text-center" value="{{$material->kelas == 'X' ? $material->kelas . ' ' . $material->no_kelas . ' ' . App\Models\Subject::find($material->matapelajaran)->matapelajaran : $material->kelas . ' ' . App\Models\Department::find($material->jurusan)->jurusan . ' ' . App\Models\Subject::find($material->matapelajaran)->matapelajaran}}">
                                    </div>
                                </div>
                           </div>
                           @livewire('attandance-dashboard-livewire', ['kelas' => $material->kelas, 'matapelajaran' => $material->matapelajaran, 'no_kelas' => $material->no_kelas, 'jurusan' => $material->jurusan])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="ModalAbsenQR" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" id="kode_qr" class="form-control mb-3 text-center" value="" readonly>
                            <div id="qr" class="text-center"></div>
                        </div>
                        <div class="col-lg-6" style="overflow: auto; white-space: nowrap; padding:10px; height:300px;">
                            <div class="table-responsive">
                                @livewire('attandance-livewire', ['kelas' => $material->kelas, 'matapelajaran' => $material->matapelajaran, 'no_kelas' => $material->no_kelas, 'jurusan' => $material->jurusan])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="selesai">Selesai</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="ModalAbsenManual" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" id="tahun" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" id="jurusan" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" id="random" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#tahun").keydown(function () {
                var value = $(this).val()
                if (value.length >= 2) {
                    $('#jurusan').focus();
                }
            });

            $("#jurusan").keydown(function () {
                var value = $(this).val()
                if (value.length >= 2) {
                    $('#random').focus();
                }
            });

            $('#submit').click(function () {
                var tahun   = $('#tahun').val();
                var jurusan = $('#jurusan').val();
                var random  = $('#random').val();

                $('#tahun').val('');
                $('#jurusan').val('');
                $('#random').val('');
                $.ajax({
                    type: 'POST',
                    url: "{{route('attandance.attandance.store')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        nis : tahun + jurusan + random,
                        matapelajaran : "{{$material->matapelajaran}}",
                    },
                    success: function (hasil) {
                        if (hasil.status_code == 200) {
                            startTimer()
                           startTimer(10, "Absen Berhasil", "#00ff1a");
                        }else if(hasil.status_code){
                           startTimer(10, "Anda Sudah Absen", "#e5ff00");
                        }
                    }
                });
            });

            function startTimer(duration, text, color) {
                $('#status').val(text);
                $('#status').css("background-color", color);
                var timer = duration, minutes, seconds;
                var datatime = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    if ((timer % 2) == 0) {
                        $('#status').css("background-color", '#FFFFFF');
                    } else {
                        $('#status').css("background-color", color);
                    }

                    if (--timer < 0) {
                        $('#status').val("");
                        $('#status').css("background-color", '#FFFFFF');
                        timer = duration;
                        clearInterval(datatime);
                    }
                }, 500);
            }

            $('#absenqr').click(function () {
                var kode = $('#kode_qr').val();
                if (kode == '') {
                    $.ajax({
                        type: 'POST',
                        url: "{{route('attandance.qrcode.store')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            matapelajaran : "{{$material->matapelajaran}}",
                            jurusan : "{{$material->jurusan}}",
                            no_kelas : "{{$material->no_kelas}}",
                            kelas : "{{$material->kelas}}",
                        },
                        success: function (hasil) {
                            if (hasil.status_code == 200) {
                                $('#kode_qr').val(hasil.kode);
                                $('#qr').html('<img src="' + hasil.qr + '">');
                                data();
                            }
                        }
                    });
                }
            });

            var qr = null;
            function data() {
                qr = setInterval(function () {
                    var kode = $('#kode_qr').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('attandance.qrcode.update')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            kode : kode,
                        },
                        success: function (hasil) {
                            if (hasil.status_code == 200) {
                                $('#kode_qr').val(hasil.kode);
                                $('#qr').html('<img src="' + hasil.qr + '">');
                            }
                        }
                    });
                },5000);
            }

            $('#selesai').click(function () {
                clearInterval(qr);
                var kode = $('#kode_qr').val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('attandance.qrcode.destroy')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        kode : kode,
                    },
                    success: function (hasil) {
                        if (hasil.status_code == 200) {
                            $('#kode_qr').val('');
                            $('#qr').html('');
                        }
                    }
                });
            })

            var countDownDate   = new Date("{{date('M d, Y ') . $jam_end}}").getTime(); // Set the date we're counting down to
            var now2            = new Date("{{date('M d, Y ') . $jam_start}}").getTime(); // Get today's date and time
            var distance2       = countDownDate - now2; // Find the distance between now2 and the count down date

            // Time calculations for days, hours, minutes and seconds
            var hours2      = Math.floor((distance2 % (1000 * 60 * 60 *24)) / (1000 * 60 * 60));
            var minutes2    = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
            var seconds2    = Math.floor((distance2 % (1000 * 60)) / 1000);

            hours2      = hours2 < 10 ? "0" + hours2 : hours2;
            minutes2    = minutes2 < 10 ? "0" + minutes2 : minutes2;
            seconds2    = seconds2 < 10 ? "0" + seconds2 : seconds2;

            $('#lama_sesi').val(hours2 + ":" + minutes2 + ":" + seconds2); // Display the result in the element with id="demo"

            // Update the count down every 1 second
            var x = setInterval(function () {

                var now = new Date().getTime(); // Get today's date and time
                var distance = countDownDate - now; // Find the distance between now and the count down date

                // Time calculations for days, hours, minutes and seconds
                var hours   = Math.floor((distance % (1000 * 60 * 60 *24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                hours   = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                $('#jam_end').val(hours + ":" + minutes + ":" + seconds); // Display the result in the element with id="demo"

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                }
            },
            1000);
        });
    </script>
@endpush