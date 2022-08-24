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
            $table->time('jam_start', $precision = 0);
            $table->time('jam_end', $precision = 0);
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
