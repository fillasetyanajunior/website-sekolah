$(document).ready(function () {

    let datas = $('#kabupaten').attr('datas')
    // ambil data kabupaten ketika data memilih provinsi
    $('#provinsi').on("change", function () {
        var id = $(this).val();
        let _url = '/kabupaten';
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url : _url,
            data: {
                id: id,
                _token: _token
            },
            success: function (hasil) {
                $("#kabupaten").removeAttr('disabled')
                $("#kabupaten").empty()
                $("#kabupaten").show();
                $.each(hasil.kota,function (index,kotas){
                    $("#kabupaten").append('<option value="' + kotas.id + '"' +  '>' + kotas.nama + '</option>');
                })
            }
        });
    });
    $('#kabupaten').on("change", function () {
        var id = $(this).val();
        let _url = '/kecamatan';
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url : _url,
            data: {
                id: id,
                _token: _token
            },
            success: function (hasil) {
                $("#kecamatan").removeAttr('disabled')
                $("#kecamatan").empty()
                $("#kecamatan").show();
                $.each(hasil.kecamatan,function (index,kecamatans){
                    $("#kecamatan").append('<option value="' + kecamatans.id + '"' +  '>' + kecamatans.nama + '</option>');
                })
            }
        });
    });
    
});