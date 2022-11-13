<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->string('nisn');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu']);
            $table->string('nomer_hp_siswa');
            $table->string('email');
            $table->string('nama_ibu');
            $table->string('nama_bapak');
            $table->integer('nik_ibu');
            $table->integer('pendidikan_ibu');
            $table->integer('nik_bapak');
            $table->integer('pendidikan_bapak');
            $table->integer('pekerjaan_ibu');
            $table->integer('pekerjaan_bapak');
            $table->integer('penghasilan_ibu');
            $table->integer('penghasilan_bapak');
            $table->string('nomer_hp_wali');
            $table->integer('pendidikan');
            $table->string('nama_sekolah');
            $table->string('provinsi_id');
            $table->string('kabupaten_id');
            $table->string('kecamatan_id');
            $table->string('desa_id');
            $table->string('dusun');
            $table->string('rw');
            $table->string('rt');
            $table->string('alamat');
            $table->string('kode_pos');
            // $table->integer('jurusan');
            $table->integer('jurusan')->nullable();
            $table->enum('kelas', ['X', 'XI', 'XII'])->default('X');
            $table->char('no_kelas', 1)->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_details');
    }
}
