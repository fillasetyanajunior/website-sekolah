<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->string('nis');
            $table->enum('kelas',['X','XI','XII']);
            $table->enum('keterangan', ['Hadir','Sakit', 'Izin', 'Tanpa Keterangan']);
            $table->enum('semester',['Ganjil','Genap']);
            $table->integer('matapelajaran');
            $table->integer('jurusan')->nullable();
            $table->char('no_kelas', 1)->nullable();
            $table->integer('guru');
            $table->string('tahun');
            $table->date('tanggal');
            $table->time('jam');
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
        Schema::dropIfExists('attendances');
    }
}
