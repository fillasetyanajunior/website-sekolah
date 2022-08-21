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
            $table->string('user_id');
            $table->string('nama');
            $table->string('nuptk');
            $table->string('alamat');
            $table->string('nomer');
            $table->string('email');
            $table->string('lulusan');
            $table->string('mapel');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('kelas_mengajar');
            $table->string('status');
            $table->string('foto')->nullable();
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
