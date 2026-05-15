ZIP ini adalah SOURCE CODE Laravel tanpa folder vendor supaya tidak error/lama saat dipindahkan ke C:\laragon\www.

Cara pakai:
1. Extract folder ini ke C:\laragon\www\jasa-mahasiswa-laravel-cocok
2. Buka terminal Laragon di folder project.
3. Jalankan: composer install
4. Kalau .env belum ada: copy .env.example .env
5. Jalankan: php artisan key:generate
6. Buat database MySQL: vskill_laravel
7. Pastikan .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=vskill_laravel
   DB_USERNAME=root
   DB_PASSWORD=
8. Jalankan: php artisan migrate:fresh --seed
9. Jalankan: php artisan serve
10. Buka http://127.0.0.1:8000

Catatan:
- Folder vendor memang sengaja tidak disertakan. Vendor dibuat oleh composer install.
- Folder node_modules juga tidak dibutuhkan karena project memakai Tailwind CDN + CSS custom.
