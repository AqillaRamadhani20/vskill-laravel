<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('npm', 20)->unique();
            $table->string('prodi', 100);
            $table->string('foto')->default('default.jpg');

            $table->text('bio')->nullable();
            $table->text('skill_summary')->nullable();
            $table->text('tools_summary')->nullable();

            $table->integer('harga_mulai')->default(0);
            $table->string('kontak_wa', 20)->nullable();

            $table->enum('status_ketersediaan', ['tersedia', 'sibuk'])
                ->default('tersedia');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('judul_jasa', 100);
            $table->string('kategori', 100);
            $table->text('deskripsi');
            $table->integer('harga');

            $table->string('estimasi_pengerjaan', 50)
                ->nullable();

            $table->enum('status', ['aktif', 'nonaktif'])
                ->default('aktif');

            $table->timestamp('created_at')
                ->useCurrent();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->foreignId('buyer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('seller_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('no_wa', 20);
            $table->text('catatan');

            $table->enum('status', ['pending', 'diterima', 'ditolak', 'selesai'])
                ->default('pending');

            $table->timestamp('created_at')
                ->useCurrent();
        });

        Schema::create('portfolio', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('judul_project', 100);
            $table->text('deskripsi');

            $table->string('tools')
                ->nullable();

            $table->string('link_demo')
                ->nullable();

            $table->timestamp('created_at')
                ->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('services');
        Schema::dropIfExists('profiles');
    }
};