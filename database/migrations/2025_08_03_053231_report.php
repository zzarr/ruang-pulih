<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       

        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelapor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('media_pengaduan')->nullable();
            $table->date('tanggal_pelaporan')->nullable();
            $table->date('tanggal_kejadian')->nullable();
            $table->string('tempat_kejadian')->nullable();
            $table->string('alamat_kejadian')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa_kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->boolean('difabel')->default(false);
            $table->boolean('kdrt')->default(false);
            $table->boolean('tppo')->default(false);
            $table->json('jenis_kasus')->nullable();
            $table->text('kronologi')->nullable();
            $table->string('bukti_path')->nullable();
            $table->enum('status', ['pending', 'valid', 'invalid', 'proses', 'selesai'])->default('pending');
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 5. Pelapor
        Schema::create('pelapor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
            $table->string('nama_lengkap', 150)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('usia')->nullable();
            $table->text('alamat')->nullable();
            $table->string('desa_kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kota_kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Budha', 'Konghucu'])->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('jenis_pekerjaan', 50)->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai'])->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->timestamps();
        });

        // 6. Terlapor
        Schema::create('terlapor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
            $table->string('nama_lengkap', 150)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('usia')->nullable();
            $table->text('alamat')->nullable();
            $table->string('desa_kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kota_kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Budha', 'Konghucu'])->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('jenis_pekerjaan', 50)->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai'])->nullable();
            $table->enum('kebangsaan', ['WNI', 'WNA'])->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->timestamps();
        });

        // 7. Korban
        Schema::create('korban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
            $table->string('nama_lengkap', 150)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('usia')->nullable();
            $table->text('alamat')->nullable();
            $table->string('desa_kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kota_kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Budha', 'Konghucu'])->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai'])->nullable();
            $table->string('hubungan_pelapor', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('tugas_laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->cascadeOnDelete();
            $table->foreignId('petugas_id')->constrained('users')->cascadeOnDelete();
            $table->string('jenis_tindak_lanjut')->nullable();
            $table->date('tanggal_tugas')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('progres_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugas_laporan')->cascadeOnDelete();
            $table->text('deskripsi_tindak_lanjut')->nullable();
            $table->string('bukti_path')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

         Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('konselor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('laporan_id')->nullable()->constrained('laporan')->nullOnDelete();
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->enum('metode', ['chat', 'video_call'])->default('chat');
            $table->string('topik')->nullable();
            $table->dateTime('jadwal')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('chat_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsultasi_id')->constrained('konsultasi')->cascadeOnDelete();
            $table->foreignId('pengirim_id')->constrained('users')->cascadeOnDelete();
            $table->text('pesan');
            $table->enum('tipe', ['text', 'file'])->default('text');
            $table->string('file_path')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_tugas');
        Schema::dropIfExists('tugas_laporan');
        Schema::dropIfExists('korban');
        Schema::dropIfExists('terlapor');
        Schema::dropIfExists('pelapor');
        Schema::dropIfExists('laporan');
        Schema::dropIfExists('chat_konsultasi');
        Schema::dropIfExists('konsultasi');
        Schema::dropIfExists('users');
    }
};
