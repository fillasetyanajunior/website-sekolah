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
            $table->string('nuptk')->nullable();
            $table->string('alamat');
            $table->string('nomer');
            $table->string('email');
            $table->string('lulusan');
            $table->enum('wali_kelas', ['X', 'XI', 'XII']);
            $table->integer('wali_jurusan')->nullable();
            $table->char('wali_no_kelas',1)->nullable();
            $table->enum('status', ['PNS', 'Non PNS']);
            $table->enum('jabatan', ['Kepala Sekolah', 'Waka Humas', 'Waka Kurikulum', 'Waka Sapras', 'Waka Kesiswaan', 'KTU', 'Pramubakti', 'Bendahara', 'Guru']);
            $table->string('avatar')->default('default.jpg');
            $table->string('sertifikat_pendidikan')->nullable();
            $table->string('izasah')->nullable();
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
