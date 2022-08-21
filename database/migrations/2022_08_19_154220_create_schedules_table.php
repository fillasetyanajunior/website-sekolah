<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jum`at', 'sabtu']);
            $table->enum('jam', ['1 Jam', '2 Jam', '3 Jam']);
            $table->integer('matapelajaran');
            $table->integer('guru');
            $table->integer('tahun');
            $table->integer('jurusan');
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
        Schema::dropIfExists('schedules');
    }
}
