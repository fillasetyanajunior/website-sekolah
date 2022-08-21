$(document).ready(function () {
    $('#tambahmateri').on('click', function () {
        $('.footer_materi button[type=submit]').html('Add');
        $('#ModalMateriLabel').html('Tambah Materi');
        $('.body_materi form').attr('action', '/materi/store');
        $('.body_materi form').attr('method', 'post');

        $("#mapel").val('');
        $("#judul").val('');
        $("#kelas").val('');
    });
    $('#editmateri*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_materi* button[type=submit]').html('Edit');
        $('#ModalMateriLabel*').html('Edit Materi');
        $('.body_materi form*').attr('action', '/materi/update/' + id);
        $('.body_materi form*').attr('method', 'post');

        let _url = '/materi/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#mapel').val(hasil.material.mapel)
                $('#judul').val(hasil.material.judul)
                $('#kelas').val(hasil.material.kelas)
            }
        });
    });

    $('#tambahjadwal').on('click', function () {
        $('.footer_jadwal button[type=submit]').html('Add');
        $('#ModalJadwalLabel').html('Tambah Jadwal Pelajaran');
        $('.body_jadwal form').attr('action', '/jadwal/store');
        $('.body_jadwal form').attr('method', 'post');

        $("#hari").val('');
        $("#jam").val('');
        $("#matapelajaran").val('');
        $("#guru").val('');
        $("#tahun").val('');
        $("#jurusan").val('');
        $("#kelas").val('');
    });
    $('#editjadwal*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_jadwal* button[type=submit]').html('Edit');
        $('#ModalJadwalLabel*').html('Edit Jadwal Pelajaran');
        $('.body_jadwal form*').attr('action', '/jadwal/update/' + id);
        $('.body_jadwal form*').attr('method', 'post');

        let _url = '/jadwal/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#hari').val(hasil.schedule.hari)
                $('#jam').val(hasil.schedule.jam)
                $('#matapelajaran').val(hasil.schedule.matapelajaran)
                $('#guru').val(hasil.schedule.guru)
                $('#tahun').val(hasil.schedule.tahun)
                $('#jurusan').val(hasil.schedule.jurusan)
                $('#kelas').val(hasil.schedule.kelas)
            }
        });
    });

    $('#tambahulangan10').on('click', function () {
        $('.footer_ulangan10 button[type=submit]').html('Add');
        $('#ModalUlangan10Label').html('Tambah Jadwal Ulangan');
        $('.body_ulangan10 form').attr('action', '/ulangan10/store');
        $('.body_ulangan10 form').attr('method', 'post');

        $("#tanggal").val('');
        $("#jam").val('');
        $("#matapelajaran").val('');
        $("#tahun").val('');
        $("#jurusan").val('');
        $("#kursi").val('');
        $("#kelas").val('');
    });
    $('#editulangan*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_ulangan* button[type=submit]').html('Edit');
        $('#ModalUlanganLabel*').html('Edit Jadwal Ulangan');
        $('.body_ulangan form*').attr('action', '/ulangan/update/' + id);
        $('.body_ulangan form*').attr('method', 'post');

        let _url = '/ulangan/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#tanggal').val(hasil.deuteronomi.tanggal)
                $('#jam').val(hasil.deuteronomi.jam)
                $('#matapelajaran').val(hasil.deuteronomi.matapelajaran)
                $('#tahun').val(hasil.deuteronomi.tahun)
                $('#jurusan').val(hasil.deuteronomi.jurusan)
                $('#kursi').val(hasil.deuteronomi.kursi)
                $('#kelas').val(hasil.deuteronomi.kelas)
            }
        });
    });

    $('#tambahtahun').on('click', function () {
        $('.footer_tahun button[type=submit]').html('Add');
        $('#ModalTahunLabel').html('Tambah Tahun Ajaran');
        $('.body_tahun form').attr('action', '/tahun/store');
        $('.body_tahun form').attr('method', 'post');

        $("#tahun").val('');
    });
    $('#edittahun*').on('click', function () {
        $('.footer_tahun* button[type=submit]').html('Edit');
        $('#ModalTahunLabel*').html('Edit Tahun Ajaran');
        const id = $(this).data('id');
        $('.body_tahun form*').attr('action', '/tahun/update/' + id);
        $('.body_tahun form*').attr('method', 'post');

        let _url = '/tahun/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#tahun').val(hasil.tahun.tahun)
            }
        });
    });

    $('#tambahmatapelajaran').on('click', function () {
        $('.footer_matapelajaran button[type=submit]').html('Add');
        $('#ModalMatapelajaranLabel').html('Tambah Matapelajaran');
        $('.body_matapelajaran form').attr('action', '/matapelajaran/store');
        $('.body_matapelajaran form').attr('method', 'post');

        $("#matapelajaran").val('');
    });
    $('#editmatapelajaran*').on('click', function () {
        $('.footer_matapelajaran* button[type=submit]').html('Edit');
        $('#ModalMatapelajaranLabel*').html('Edit Matapelajaran');
        const id = $(this).data('id');
        $('.body_matapelajaran form*').attr('action', '/matapelajaran/update/' + id);
        $('.body_matapelajaran form*').attr('method', 'post');

        let _url = '/matapelajaran/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#matapelajaran').val(hasil.subject.matapelajaran)
            }
        });
    });

    $('#tambahjurusan').on('click', function () {
        $('.footer_jurusan button[type=submit]').html('Add');
        $('#ModalJurusanLabel').html('Tambah Jurusan');
        $('.body_jurusan form').attr('action', '/jurusan/store');
        $('.body_jurusan form').attr('method', 'post');

        $("#jurusan").val('');
    });
    $('#editjurusan*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_jurusan* button[type=submit]').html('Edit');
        $('#ModalJurusanLabel*').html('Edit Jurusan');
        $('.body_jurusan form*').attr('action', '/jurusan/update/' + id);
        $('.body_jurusan form*').attr('method', 'post');

        let _url = '/jurusan/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#jurusan').val(hasil.department.jurusan)
            }
        });
    });

    $('#tambahuser').on('click', function () {
        $('.footer_user button[type=submit]').html('Add');
        $('#ModalUserLabel').html('Tambah User');
        $('.body_user form').attr('action', '/user/store');
        $('.body_user form').attr('method', 'post');

        $('#name').val('')
        $('.username').hide()
        $('.password').hide()
        $('#role').val('3')
    });
    $('#edituser*').on('click', function () {
        $('.footer_user* button[type=submit]').html('Edit');
        $('#ModalUserLabel*').html('Edit User');
        const id = $(this).data('id');
        $('.body_user form*').attr('action', '/user/update/' + id);
        $('.body_user form*').attr('method', 'post');

        $('.username').show()
        $('.password').show()

        let _url = '/user/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {

                $('#name').val(hasil.user.name)
                $('#username').val(hasil.user.username)
                $('#password').val(hasil.password1)
                if (hasil.user.role == 'admin') {
                    $('#role').val(1)
                } else if (hasil.user.role == 'guru') {
                    $('#role').val(2)
                } else if (hasil.user.role == 'siswa') {
                    $('#role').val(3)
                } else {
                    $('#role').val(4)
                }
            }
        });
    });

    $('#tambahguru').on('click', function () {
        $('.footer_guru button[type=submit]').html('Add');
        $('#ModalGuruLabel').html('Tambah User Guru');
        $('.body_guru form').attr('action', '/user/store');
        $('.body_guru form').attr('method', 'post');

        $('#names').val('')
        $('.usernames').hide()
        $('.passwords').hide()
        $('#roles').val('')
    });
    $('#editguru*').on('click', function () {
        $('.footer_guru* button[type=submit]').html('Edit');
        $('#ModalGuruLabel*').html('Edit User Guru');
        const id = $(this).data('id');
        $('.body_guru form*').attr('action', '/user/update/' + id);
        $('.body_guru form*').attr('method', 'post');

        $('.usernames').show()
        $('.passwords').show()

        let _url = '/user/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#names').val(hasil.user.name)
                $('#usernames').val(hasil.user.username)
                $('#passwords').val(hasil.password1)
                 if (hasil.user.role == 'admin') {
                    $('#roles').val(1)
                 } else if (hasil.user.role == 'guru') {
                    $('#roles').val(2)
                 } else if (hasil.user.role == 'siswa') {
                    $('#roles').val(3)
                 } else {
                    $('#roles').val(4)
                 }
            }
        });
    });

    $('#editpendaftaran*').on('click', function () {
        $('.footer_pendaftaran* button[type=submit]').html('Edit');
        $('#ModalPendaftaranLabel*').html('Edit Pendaftaran');
        const id = $(this).data('id');
        $('.body_pendaftaran form*').attr('action', '/pendaftaran/update/' + id);
        $('.body_pendaftaran form*').attr('method', 'post');

        let _url = '/pendaftaran/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#name').val(hasil.data.nama)
                $('#nisn').val(hasil.data.nisn)
                $('#kode').val(hasil.data.kode)
                $('#active').val(hasil.data.is_active)
            }
        });
    });

    $('#tambahnilai').on('click', function () {
        $('.footer_nilai button[type=submit]').html('Add');
        $('#ModalNilaiLabel').html('Tambah Nilai');
        $('.body_nilai form').attr('action', '/inputnilai');
        $('.body_nilai form').attr('method', 'post');

        $('.angka').hide()
        $('.huruf').hide()
        $('.import_excel').show()
    });
    $('#editnilai*').on('click', function () {
        $('.footer_nilai* button[type=submit]').html('Edit');
        $('#ModalNilaiLabel*').html('Edit Nilai');
        const id = $(this).data('id');
        $('.body_nilai form*').attr('action', '/inputnilai/update/' + id);
        $('.body_nilai form*').attr('method', 'post');

        $('.angka').show()
        $('.huruf').show()
        $('.import_excel').hide()

        let _url = '/inputnilai/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#angka').val(hasil.grade.angka)
                $('#huruf').val(hasil.grade.huruf)
            }
        });
    });

    $('#tambahinformasi').on('click', function () {
        $('.footer_informasi button[type=submit]').html('Upload');
        $('#InformasiModalLabel').html('Upload Berita');
        $('.body_informasi form').attr('action', '/informasi');
        $('.body_informasi form').attr('method', 'post');

        $('.title').val('')
        $('.description').val('')
        $('.thumnail').val('')
    });
    $('#editinformasi*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_informasi* button[type=submit]').html('Edit');
        $('#InformasiModalLabel*').html('Edit Berita');
        $('.body_informasi form*').attr('action', '/informasi/update/' + id);
        $('.body_informasi form*').attr('method', 'post');

        let _url = '/informasi/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $('#title').val(hasil.information.title)
                $('#description').val(hasil.information.description)
            }
        });
    });

})
