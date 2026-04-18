<div align="center">

# LAPORAN PRAKTIKUM  
# APLIKASI BERBASIS PLATFORM

## COTS 2

<img src="assets/logotelu.jpeg" alt ="logo" width = "300"> 

### Disusun Oleh
**[Titanio Francy Naddiansa]**  
[2311102289]  
[IF-11-04]  

### Dosen Pengampu
**Cahyo Prihantoro, S.Kom., M.Eng.**


### LABORATORIUM HIGH PERFORMANCE  
FAKULTAS INFORMATIKA  
UNIVERSITAS TELKOM PURWOKERTO  
2026

</div>

---

# 🎓 Mahasiswa App — Laravel AJAX

Aplikasi web sederhana berbasis **Laravel** untuk menampilkan data mahasiswa dari file JSON lokal menggunakan **AJAX** tanpa reload halaman. Tidak menggunakan database sama sekali.

---

## 📋 Daftar Isi

- [Fitur Aplikasi](#-fitur-aplikasi)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Struktur Project](#-struktur-project)
- [Prasyarat](#-prasyarat)
- [Cara Instalasi & Menjalankan](#-cara-instalasi--menjalankan)
- [Penjelasan Kode](#-penjelasan-kode)
  - [1. File Data JSON](#1-file-data-mahasiswajson)
  - [2. Routes](#2-routeswebphp)
  - [3. Controller](#3-mahasiswacontrollerphp)
  - [4. Blade View](#4-resourcesviewsmahasiswaindexbladephp)
- [Cara Menggunakan Aplikasi](#-cara-menggunakan-aplikasi)
- [Menambah Data Mahasiswa](#-menambah-data-mahasiswa)
- [Troubleshooting](#-troubleshooting)

---

## ✨ Fitur Aplikasi

| Fitur | Keterangan |
|---|---|
| 📄 Blade Template | Halaman utama dirender menggunakan Laravel Blade |
| 📁 JSON Lokal | Data dibaca dari file `data/mahasiswa.json`, tanpa database |
| ⚡ AJAX | Data dimuat secara dinamis tanpa reload halaman |
| 📊 Tabel Responsif | Tampilan tabel lengkap dengan avatar, badge NIM, badge kelas |
| 🔍 Live Search | Filter data secara real-time berdasarkan nama, NIM, prodi, atau kelas |
| 📈 Statistik | Menampilkan total mahasiswa, jumlah prodi, kelas aktif, dan rata-rata IPK |
| 🔔 Toast Notifikasi | Notifikasi sukses atau gagal saat data dimuat |
| 🔄 Tombol Reset | Mengembalikan tampilan ke kondisi awal |

---

## 🛠 Teknologi yang Digunakan

- **PHP** >= 8.2
- **Laravel** 12.x
- **Laravel Blade** — template engine untuk halaman HTML
- **JavaScript (Fetch API)** — untuk request AJAX
- **CSS3** — styling murni tanpa framework CSS tambahan
- **JSON** — sebagai pengganti database

---

## 📁 Struktur Project

Berikut adalah file-file penting dalam project ini (di dalam folder Laravel):

```
mahasiswa-app/
│
├── 📂 app/
│   └── 📂 Http/
│       └── 📂 Controllers/
│           └── 📄 MahasiswaController.php   ← Logic utama aplikasi
│
├── 📂 data/
│   └── 📄 mahasiswa.json                    ← Sumber data mahasiswa (pengganti database)
│
├── 📂 resources/
│   └── 📂 views/
│       └── 📂 mahasiswa/
│           └── 📄 index.blade.php           ← Tampilan halaman utama
│
├── 📂 routes/
│   └── 📄 web.php                           ← Definisi URL/route aplikasi
│
├── 📄 .env                                  ← Konfigurasi environment
└── 📄 README.md                             ← Dokumentasi ini
```

---

## ✅ Prasyarat

Pastikan komputer kamu sudah terinstall:

1. **PHP >= 8.2** — cek dengan `php -v`
2. **Composer** — cek dengan `composer --version` (download di https://getcomposer.org)
3. **Web browser** (Chrome, Firefox, Edge, dll.)

---

## 🚀 Cara Instalasi & Menjalankan

### Langkah 1 — Buat Project Laravel Baru

Buka terminal / PowerShell, lalu jalankan:

```bash
composer create-project laravel/laravel mahasiswa-app --no-security-blocking
cd mahasiswa-app
```

### Langkah 2 — Salin File dari Project Ini

Salin file-file berikut ke dalam folder Laravel yang baru dibuat:

| File yang disalin | Letakkan di |
|---|---|
| `data/mahasiswa.json` | Buat folder `data/` di root project, taruh di sana |
| `app/Http/Controllers/MahasiswaController.php` | `app/Http/Controllers/` (timpa jika ada) |
| `resources/views/mahasiswa/index.blade.php` | Buat folder `resources/views/mahasiswa/`, taruh di sana |
| `routes/web.php` | `routes/web.php` (timpa file yang sudah ada) |

### Langkah 3 — Konfigurasi File `.env`

Buka file `.env` di root project, pastikan baris berikut seperti ini:

```env
APP_NAME="Mahasiswa App"
APP_KEY=                    ← akan diisi otomatis di langkah berikutnya
SESSION_DRIVER=file         ← WAJIB diubah ke "file", bukan "database"
```

### Langkah 4 — Generate Application Key

```bash
php artisan key:generate
```

### Langkah 5 — Jalankan Server

```bash
php artisan serve
```

### Langkah 6 — Buka di Browser

```
http://127.0.0.1:8000
```

---

## 📖 Penjelasan Kode

### 1. File `data/mahasiswa.json`

File ini adalah **sumber data** aplikasi, menggantikan fungsi database. Berisi array objek JSON dengan data mahasiswa.

```json
[
    {
        "id": 1,
        "nama": "Titanio Francy Naddiansa",
        "nim": "2311102289",
        "kelas": "A",
        "prodi": "Teknik Informatika",
        "angkatan": 2023,
        "ipk": 3.85
    }
]
```

**Penjelasan setiap field:**

| Field | Tipe | Keterangan |
|---|---|---|
| `id` | number | Nomor urut unik tiap mahasiswa |
| `nama` | string | Nama lengkap mahasiswa |
| `nim` | string | Nomor Induk Mahasiswa |
| `kelas` | string | Kelas mahasiswa (A, B, C, dst.) |
| `prodi` | string | Program Studi |
| `angkatan` | number | Tahun masuk kuliah |
| `ipk` | number | Indeks Prestasi Kumulatif (0.00 - 4.00) |

---

### 2. `routes/web.php`

File ini mendefinisikan **URL/alamat** yang bisa diakses di aplikasi. Setiap URL diarahkan ke method tertentu di Controller.

```php
use App\Http\Controllers\MahasiswaController;

// Route 1: Menampilkan halaman utama
Route::get('/', [MahasiswaController::class, 'index'])
    ->name('mahasiswa.index');

// Route 2: Mengembalikan data JSON untuk AJAX
Route::get('/api/mahasiswa', [MahasiswaController::class, 'getData'])
    ->name('mahasiswa.data');
```

**Penjelasan:**

- `Route::get('/', ...)` — saat user membuka `http://127.0.0.1:8000`, Laravel memanggil method `index()` di Controller untuk menampilkan halaman.
- `Route::get('/api/mahasiswa', ...)` — saat JavaScript melakukan request AJAX ke URL ini, Laravel memanggil method `getData()` yang mengembalikan data JSON.
- `->name(...)` — memberi nama alias pada route, sehingga bisa dipanggil di Blade dengan `route('nama.route')` tanpa menulis URL secara hardcode.

---

### 3. `app/Http/Controllers/MahasiswaController.php`

Controller adalah **otak** aplikasi. Berisi logic untuk menangani setiap request yang masuk.

```php
class MahasiswaController extends Controller
{
    // Method 1: Render halaman utama
    public function index()
    {
        return view('mahasiswa.index');
        // Artinya: tampilkan file resources/views/mahasiswa/index.blade.php
    }

    // Method 2: Baca file JSON, kembalikan sebagai response JSON
    public function getData(): JsonResponse
    {
        // base_path() menghasilkan path absolut ke root project
        // Contoh: C:\ngoding\APB\mahasiswa-app\data\mahasiswa.json
        $filePath = base_path('data/mahasiswa.json');

        // Cek apakah file ada, jika tidak kembalikan error 404
        if (!file_exists($filePath)) {
            return response()->json([
                'success' => false,
                'message' => 'File data tidak ditemukan.',
                'data'    => []
            ], 404);
        }

        // Baca seluruh isi file sebagai string teks
        $jsonContent = file_get_contents($filePath);

        // Ubah string JSON → array PHP (true = array asosiatif)
        $mahasiswa = json_decode($jsonContent, true);

        // Validasi: apakah JSON berhasil di-decode?
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'success' => false,
                'message' => 'Format JSON tidak valid.',
                'data'    => []
            ], 500);
        }

        // Kembalikan data sebagai JSON response
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dimuat.',
            'total'   => count($mahasiswa),
            'data'    => $mahasiswa
        ]);
    }
}
```

**Fungsi-fungsi PHP yang digunakan:**

| Fungsi | Penjelasan |
|---|---|
| `base_path('data/mahasiswa.json')` | Menghasilkan path lengkap ke file di root project |
| `file_exists($path)` | Mengecek apakah file ada di lokasi tersebut |
| `file_get_contents($path)` | Membaca seluruh isi file sebagai string |
| `json_decode($string, true)` | Mengubah string JSON menjadi array PHP |
| `json_last_error()` | Mengecek apakah proses json_decode berhasil |
| `response()->json([...])` | Membuat HTTP response berformat JSON |
| `count($array)` | Menghitung jumlah elemen dalam array |

**Contoh response JSON yang dikembalikan ke JavaScript:**

```json
{
    "success": true,
    "message": "Data berhasil dimuat.",
    "total": 5,
    "data": [
        {
            "id": 1,
            "nama": "Titanio Francy Naddiansa",
            "nim": "2311102289",
            "kelas": "A",
            "prodi": "Teknik Informatika",
            "angkatan": 2023,
            "ipk": 3.85
        }
    ]
}
```

---

### 4. `resources/views/mahasiswa/index.blade.php`

File Blade adalah **tampilan** yang dilihat user di browser. Laravel Blade memungkinkan kita menulis sintaks PHP khusus di dalam HTML.

#### a) Meta CSRF Token
```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```
`{{ csrf_token() }}` adalah sintaks Blade untuk mencetak token keamanan Laravel. Token ini dikirim di setiap request AJAX agar Laravel tahu bahwa request tersebut sah dan bukan serangan dari luar.

#### b) Penggunaan `route()` di Blade
```javascript
fetch('{{ route("mahasiswa.data") }}', ...)
```
`route("mahasiswa.data")` adalah helper Blade yang secara otomatis menghasilkan URL `/api/mahasiswa`. Ini lebih aman dan fleksibel daripada menulis URL secara langsung.

#### c) Fungsi AJAX `loadData()`
```javascript
function loadData() {
    showLoading(); // Tampilkan animasi loading

    fetch('{{ route("mahasiswa.data") }}', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest', // Penanda bahwa ini AJAX request
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())        // Parse response menjadi object JavaScript
    .then(json => {
        renderTable(json.data);     // Tampilkan data ke tabel
        updateStats(json.data);     // Update angka statistik
    })
    .catch(err => {
        showError(err.message);     // Tampilkan pesan error jika gagal
    });
}
```

**Alur kerja AJAX secara lengkap:**

```
User klik tombol "Tampilkan Data"
         ↓
JavaScript jalankan fungsi loadData()
         ↓
Fetch API kirim request GET ke /api/mahasiswa
         ↓
Laravel terima request → arahkan ke MahasiswaController@getData()
         ↓
Controller baca file data/mahasiswa.json
         ↓
Controller kembalikan data sebagai JSON response
         ↓
JavaScript terima response JSON
         ↓
Fungsi renderTable() membangun HTML tabel dari data
         ↓
Tabel langsung muncul di halaman ✓ (tanpa reload)
```

#### d) Fungsi `renderTable(data)`
Fungsi ini membangun HTML tabel secara dinamis dari array data yang diterima:

```javascript
function renderTable(data) {
    // Buat baris tabel untuk setiap mahasiswa menggunakan .map()
    const rows = data.map((m, i) => `
        <tr>
            <td>${m.nama}</td>
            <td>${m.nim}</td>
            <td>${m.kelas}</td>
            <td>${m.prodi}</td>
            <td>${m.ipk}</td>
        </tr>
    `).join(''); // Gabungkan semua baris menjadi satu string HTML

    // Masukkan tabel ke dalam elemen #dataArea di halaman
    document.getElementById('dataArea').innerHTML = `
        <table>
            <thead>...</thead>
            <tbody>${rows}</tbody>
        </table>
    `;
}
```

#### e) Fungsi `filterTable()` — Live Search
```javascript
function filterTable() {
    // Ambil teks yang diketik user, ubah ke huruf kecil
    const q = document.getElementById('searchInput').value.toLowerCase();

    // Filter array data: hanya tampilkan yang cocok dengan pencarian
    const filtered = allData.filter(m =>
        m.nama.toLowerCase().includes(q)  ||
        m.nim.toLowerCase().includes(q)   ||
        m.prodi.toLowerCase().includes(q) ||
        m.kelas.toLowerCase().includes(q)
    );

    // Render ulang tabel hanya dengan data yang lolos filter
    renderTable(filtered);
}
```

Pencarian dilakukan sepenuhnya di sisi **frontend** — tidak ada request baru ke server, sehingga sangat cepat dan responsif.

---

## 🖥 Cara Menggunakan Aplikasi

1. Buka `http://127.0.0.1:8000` di browser
2. Halaman menampilkan judul dan tombol **"Tampilkan Data"**
3. Klik tombol — animasi loading muncul sebentar
4. Data mahasiswa **langsung tampil dalam tabel** tanpa reload halaman
5. **Statistik** (total mahasiswa, jumlah prodi, kelas aktif, rata-rata IPK) tampil di atas tabel
6. Ketik di **kotak pencarian** untuk memfilter data secara real-time
7. Klik **tombol Reset** untuk kembali ke tampilan awal

---

## ➕ Menambah Data Mahasiswa

Cukup edit file `data/mahasiswa.json`, tambahkan objek baru di dalam array:

```json
[
    { ... data yang sudah ada ... },
    {
        "id": 6,
        "nama": "Nama Mahasiswa Baru",
        "nim": "2311102345",
        "kelas": "A",
        "prodi": "Teknik Informatika",
        "angkatan": 2023,
        "ipk": 3.75
    }
]
```


Tidak perlu restart server — data langsung terbaca saat tombol diklik.

---

## 🔧 Troubleshooting

| Error yang Muncul | Penyebab | Solusi |
|---|---|---|
| `Could not open input file: artisan` | Bukan folder Laravel atau `vendor` belum ada | Jalankan `composer install --no-security-blocking` |
| `MissingAppKeyException` | File `.env` belum punya `APP_KEY` | Jalankan `php artisan key:generate` |
| `QueryException: database.sqlite does not exist` | `SESSION_DRIVER` masih diset ke `database` | Ubah ke `SESSION_DRIVER=file` di file `.env` |
| `File data tidak ditemukan` | File `data/mahasiswa.json` belum ada | Buat folder `data/` di root project dan salin file JSON ke dalamnya |
| Tabel tidak muncul / halaman putih | File Blade belum disalin | Pastikan `index.blade.php` ada di `resources/views/mahasiswa/` |
| `419 Page Expired` | CSRF token tidak terkirim | Pastikan tag `<meta name="csrf-token">` ada di `<head>` Blade |

---

## 👨‍💻 Informasi Project

| | |
|---|---|
| **Framework** | Laravel 12.x |
| **Bahasa** | PHP 8.2+, JavaScript ES6+ |
| **Database** | ❌ Tidak digunakan |
| **Styling** | CSS3 murni (tanpa Bootstrap/Tailwind) |
| **Request AJAX** | Fetch API (JavaScript native bawaan browser) |
| **Data Source** | File JSON lokal (`data/mahasiswa.json`) |

---

