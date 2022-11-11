<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nuptk');
            $table->string('nip');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nomor_hp');
            $table->string('email');
            $table->enum('wali_kelas', ['X', 'XI', 'XII'])->nullable();
            $table->integer('wali_jurusan')->nullable();
            $table->char('wali_no_kelas', 1)->nullable();
            $table->enum('status_pegawai', ['PNS', 'Non PNS']);
            $table->enum('jabatan', ['Kepala Madrasah', 'Waka Humas', 'Waka Kurikulum', 'Waka Sapras', 'Waka Kesiswaan', 'Kepala Tata Usaha', 'Tata Usaha', 'Bendahara', 'Guru Mapel', 'Guru BK', 'Tenaga Keamanan', 'Petugas Kebersihan', 'Operator Data', 'Lainnya']);
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
        Schema::dropIfExists('teacher_details');
    }
}
