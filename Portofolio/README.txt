========================================
  PORTFOLIO WEBSITE — PANDUAN INSTALASI
  Dibuat dengan: HTML, CSS, PHP, AJAX, JS
========================================

📁 STRUKTUR FILE:
-----------------
portfolio/
├── index.php           ← Halaman utama (semua section)
├── contact.php         ← Backend handler form kontak (AJAX)
├── assets/
│   ├── css/
│   │   └── style.css   ← Semua styling
│   ├── js/
│   │   └── script.js   ← Semua JavaScript + AJAX
│   ├── cv/
│   │   └── cv-alex-naufal.pdf  ← ⚠️ Taruh file CV kamu di sini
│   └── img/            ← (opsional) Gambar tambahan
└── data/
    └── messages.json   ← Dibuat otomatis saat form dikirim


🚀 CARA MENJALANKAN (XAMPP / Laragon):
---------------------------------------

METODE 1 — XAMPP:
1. Pastikan XAMPP sudah terinstall (https://www.apachefriends.org)
2. Buka XAMPP Control Panel
3. Klik "Start" pada Apache
4. Copy folder "portfolio" ke:
   C:\xampp\htdocs\portfolio
5. Buka browser, akses:
   http://localhost/portfolio

METODE 2 — Laragon:
1. Copy folder "portfolio" ke:
   C:\laragon\www\portfolio
2. Jalankan Laragon → Start All
3. Buka browser, akses:
   http://portfolio.test
   (atau http://localhost/portfolio)

METODE 3 — PHP Built-in Server:
1. Buka terminal / CMD
2. Masuk ke folder portfolio:
   cd path/ke/portfolio
3. Jalankan:
   php -S localhost:8080
4. Buka browser:
   http://localhost:8080


⚙️ KONFIGURASI (Sesuaikan Data Diri):
---------------------------------------
Buka file index.php, edit bagian paling atas:

  $owner_name     = "Alex Naufal";      ← Ganti nama kamu
  $owner_role     = "UI/UX Designer..."; ← Ganti posisi
  $owner_email    = "alex@example.com"; ← Email kamu
  $owner_phone    = "+62 812-xxxxx";    ← No HP kamu
  $owner_location = "Jakarta, Indonesia"; ← Kota kamu

Juga ganti data proyek portofolio di array $projects
dan data skill di array $design_skills, $dev_skills, dll.


📧 FITUR FORM KONTAK (AJAX):
------------------------------
- Form dikirim tanpa reload halaman (AJAX via XMLHttpRequest)
- Validasi dilakukan di 2 layer:
  ✅ Client-side (JavaScript) — cepat, UX lebih baik
  ✅ Server-side (PHP)        — aman dari bypass
- Pesan tersimpan di: data/messages.json
- Untuk kirim email notifikasi, uncomment bagian mail()
  di file contact.php dan sesuaikan alamat email

📌 UNTUK KIRIM EMAIL (PRODUCTION):
- Uncomment kode mail() di contact.php
- Atau gunakan PHPMailer + SMTP Gmail untuk hasil lebih baik


📥 DOWNLOAD CV:
----------------
- Buat/taruh file CV PDF kamu di:
  assets/cv/cv-alex-naufal.pdf
- Tombol "Download CV" di navbar otomatis mengarah ke file ini


🎨 FITUR LENGKAP:
------------------
✅ Custom cursor animasi
✅ Navbar sticky + scroll effect
✅ Hero section dengan card animasi
✅ Counter angka animasi
✅ Section reveal saat scroll
✅ Skill bar animasi
✅ Portfolio grid dengan filter (All / UI / Web / Mobile)
✅ Modal detail proyek
✅ Form kontak + AJAX + validasi 2 layer
✅ Responsive mobile-friendly
✅ Smooth scroll navigasi
✅ Download CV button


❓ TROUBLESHOOTING:
--------------------
❌ Form kontak tidak bekerja?
   → Pastikan Apache sudah running
   → Pastikan akses ke http://localhost/portfolio (bukan file://...)

❌ Folder "data" tidak terbuat?
   → Buat manual folder "data" di dalam folder portfolio
   → Di Linux/Mac: chmod 755 data

❌ CSS/JS tidak load?
   → Pastikan struktur folder sudah benar
   → Buka browser console (F12) untuk cek error

========================================
  Dibuat oleh Claude untuk keperluan tugas
  HTML | CSS | PHP | AJAX | JavaScript
========================================
