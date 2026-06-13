<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('pembeli', 'penyedia', 'admin') DEFAULT 'pembeli'");
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'admin')->update(['role' => 'pembeli']);
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('pembeli', 'penyedia') DEFAULT 'pembeli'");
    }
};
