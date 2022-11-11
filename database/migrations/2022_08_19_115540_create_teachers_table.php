<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('id_guru');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('password_encrypted');
            $table->enum('role', ['Kepala Madrasah', 'Waka Humas', 'Waka Kurikulum', 'Waka Sapras', 'Waka Kesiswaan', 'Kepala Tata Usaha', 'Tata Usaha', 'Bendahara', 'Guru Mapel', 'Guru BK', 'Tenaga Keamanan', 'Petugas Kebersihan', 'Operator Data', 'Lainnya', 'Wali Kelas']);
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
        Schema::dropIfExists('teachers');
    }
}
