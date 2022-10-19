<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachings', function (Blueprint $table) {
            $table->integer('id_guru');
            $table->enum('kelas',['X', 'XI', 'XII']);
            $table->integer('jurusan')->nullable();
            $table->char('no_kelas', 1)->nullable();
            $table->integer('matapelajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachings');
    }
}
