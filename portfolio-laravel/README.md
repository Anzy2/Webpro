# 🚀 Portfolio TFN — Laravel Edition

Migrasi portofolio dari PHP native ke **Laravel 11** dengan tetap mempertahankan
semua tampilan (custom CSS) dan interaktivitas (custom JS) yang sudah ada.

---

## 📁 Struktur Proyek

```
portfolio-laravel/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── PortfolioController.php   ← Data owner, skill, proyek
│           └── ContactController.php     ← Handler form kontak + validasi
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php             ← Layout utama (navbar, footer, dll)
│       ├── partials/
│       │   ├── navbar.blade.php
│       │   ├── mobile-menu.blade.php
│       │   ├── footer.blade.php
│       │   └── modal.blade.php
│       └── portfolio/
│           └── index.blade.php           ← Halaman utama (semua section)
├── routes/
│   └── web.php                           ← Definisi route
└── public/
    └── assets/
        ├── css/
        │   └── style.css                 ← CSS kamu (taruh di sini)
        ├── js/
        │   └── script.js                 ← JS yang sudah diupdate
        └── cv/
            └── cv-Titanio Francy Naddiansa.pdf
```

---

## ⚙️ Cara Install & Jalankan

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM (opsional, untuk Vite)

### Langkah-langkah

```bash
# 1. Buat proyek Laravel baru
composer create-project laravel/laravel portfolio-laravel
cd portfolio-laravel

# 2. Salin semua file dari folder ini ke dalam proyek Laravel
#    (timpa file yang sudah ada)

# 3. Salin file assets kamu
#    - style.css   → public/assets/css/style.css
#    - script.js   → public/assets/js/script.js   (gunakan versi baru dari folder ini)
#    - CV PDF      → public/assets/cv/

# 4. Buat file .env
cp .env.example .env
php artisan key:generate

# 5. Jalankan server
php artisan serve
# Buka: http://localhost:8000
```

---

## 🔄 Perubahan dari PHP Native ke Laravel

| Aspek | PHP Native | Laravel |
|---|---|---|
| **Routing** | URL langsung ke file `.php` | `routes/web.php` dengan named routes |
| **Template** | PHP echo / foreach | Blade (`@foreach`, `{{ }}`, `@csrf`) |
| **Validasi Form** | Manual `filter_var` | `$request->validate([...])` |
| **Simpan Pesan** | `file_put_contents` manual | `Storage::put()` Laravel |
| **CSRF** | Tidak ada | Otomatis via `@csrf` + meta tag |
| **AJAX Error** | JSON custom | Laravel `422 ValidationException` |
| **Asset** | Path relatif | `asset('...')` helper |
| **Data** | PHP array di file yang sama | Controller terpisah |

---

## 📝 Kustomisasi Data

Semua data portofolio ada di satu tempat:
**`app/Http/Controllers/PortfolioController.php`**

Ubah array `$owner`, `$skills`, `$timeline`, dan `$projects` sesuai kebutuhan.

---

## 💾 Pesan Kontak Tersimpan Di

```
storage/app/messages.json
```

Bisa dilihat dari terminal:
```bash
cat storage/app/messages.json
```

---

## 📧 Menambahkan Notifikasi Email (Opsional)

Di `ContactController.php`, uncomment baris:
```php
// Mail::to('titaniofrancy@gmail.com')->send(new ContactMail($validated));
```

Lalu buat Mailable:
```bash
php artisan make:mail ContactMail --markdown=emails.contact
```

Atur SMTP di `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=titaniofrancy@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=titaniofrancy@gmail.com
```
