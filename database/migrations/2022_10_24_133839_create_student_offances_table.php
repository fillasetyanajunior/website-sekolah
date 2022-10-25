<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentOffancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_offances', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('id_siswa');
            $table->integer('skor');
            $table->integer('jenis_pelanggaran');
            $table->string('pelapor');
            $table->enum('pembinaan', ['Lisan', 'Perjanjian 1', 'Perjanjian 2', 'Pangilan Orang Tua', 'Skor']);
            $table->enum('keterangan', ['Pantauan']);
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
        Schema::dropIfExists('student_offances');
    }
}
