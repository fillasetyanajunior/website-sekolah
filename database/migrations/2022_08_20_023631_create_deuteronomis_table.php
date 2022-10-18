<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeuteronomisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deuteronomis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->date('tanggal');
            $table->string('jam');
            $table->integer('matapelajaran');
            $table->integer('tahun');
            $table->integer('jurusan')->nullable();
            $table->char('no_kelas', 1)->nullable();
            $table->integer('kursi');
            $table->integer('ruangan');
            $table->enum('kelas', ['X', 'XI', 'XII']);
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
        Schema::dropIfExists('deuteronomis');
    }
}
