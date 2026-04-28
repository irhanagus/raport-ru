<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // FOTO
            $table->string('foto')->nullable();

            // WAJIB (STEP 1)
            $table->string('angkatan');
            $table->string('jenjang');
            $table->string('nis');
            $table->string('nisn');
            $table->string('name');
            $table->string('ket');

            // DATA TAMBAHAN (STEP 2)
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('jk')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_klrga')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('diterima_di_kelas')->nullable();
            $table->date('diterima_tgl')->nullable();

            // ORANG TUA
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->text('alamat_ortu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('telp_ortu')->nullable();

            // WALI
            $table->string('nama_wali')->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('telp_wali')->nullable();

            // STATUS
            $table->boolean('is_draft')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
