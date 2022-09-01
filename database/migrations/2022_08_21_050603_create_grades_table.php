<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->integer('matapelajaran');
            $table->integer('guru');
            $table->integer('tahun');
            $table->enum('kelas', ['X', 'XI', 'XII']);
            $table->enum('semester',['Ganjil', 'Genap']);
            $table->integer('angka');
            $table->char('huruf', 1);
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
        Schema::dropIfExists('grades');
    }
}
