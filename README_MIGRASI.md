# Migrasi Project PHP Native V-Skill ke Laravel

Project ini adalah hasil migrasi awal dari `platform-jasa-mahasiswa-main` ke struktur Laravel.

## Yang sudah dimigrasikan

- Route Laravel di `routes/web.php`
- Controller utama di `app/Http/Controllers/VSkillController.php`
- Model Eloquent:
  - `User`
  - `Profile`
  - `Service`
  - `Order`
  - `Portfolio`
- Migration database untuk tabel lama:
  - `users`
  - `profiles`
  - `services`
  - `orders`
  - `portfolio`
- Seeder dari data `database/vskill.sql`
- Asset gambar dari project lama ke `public/assets/images`
- Blade view dasar untuk halaman:
  - home
  - dashboard
  - detail jasa
  - login/register/logout
  - profile view/edit
  - jadi penyedia
  - service create/edit/delete
  - order/pesanan/order masuk

## Cara menjalankan dengan MySQL/XAMPP

1. Buat database baru, misalnya `vskill_laravel`.
2. Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vskill_laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. Jalankan perintah:

```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

4. Buka:

```text
http://127.0.0.1:8000
```

## Catatan penting

- File PHP native lama tidak lagi dipakai langsung. Logika `mysqli`, `session_start()`, dan `include koneksi.php` sudah diganti ke Laravel Auth, Controller, Eloquent, dan Blade.
- URL lama seperti `/dashboard.php`, `/login.php`, `/register.php`, `/tentang.php`, dan `/kontak.php` sudah dibuat redirect ke URL Laravel.
- Tampilan Blade dibuat versi sederhana agar cepat berjalan di Laravel. Jika ingin sama persis dengan desain lama, HTML dari file PHP lama bisa dipindahkan ke Blade secara bertahap.
- File SQL asli tetap disimpan di `database/vskill.sql` sebagai referensi.
