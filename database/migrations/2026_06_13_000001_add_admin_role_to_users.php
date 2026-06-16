<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        // Role 'admin' sudah termasuk di migration awal (create_users_table).
        // Migration ini dikosongkan agar kompatibel dengan SQLite yang tidak
        // mendukung ALTER TABLE MODIFY COLUMN.
    }

    public function down(): void {}
};
