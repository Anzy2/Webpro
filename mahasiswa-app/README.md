<div align="center">

# LAPORAN PRAKTIKUM  
# APLIKASI BERBASIS PLATFORM

## LARAVEL AJAX APP

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

Aplikasi menampilkan data mahasiswa dari file JSON lokal menggunakan AJAX tanpa reload halaman, tanpa database.

---

## Struktur File

```
mahasiswa-app/
├── data/mahasiswa.json
├── app/Http/Controllers/MahasiswaController.php
├── resources/views/mahasiswa/index.blade.php
└── routes/web.php
```

---

## Penjelasan Kode

### `data/mahasiswa.json`
Menyimpan data mahasiswa dalam format array JSON sebagai pengganti database.

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

---

### `routes/web.php`
Mendaftarkan dua route yang digunakan aplikasi.

```php
// Menampilkan halaman utama
Route::get('/', [MahasiswaController::class, 'index']);

// Mengembalikan data JSON untuk request AJAX
Route::get('/api/mahasiswa', [MahasiswaController::class, 'getData']);
```

---

### `MahasiswaController.php`
Berisi dua method utama.

```php
// Menampilkan halaman Blade
public function index()
{
    return view('mahasiswa.index');
}

// Membaca file JSON dan mengembalikannya sebagai response JSON
public function getData(): JsonResponse
{
    $filePath    = base_path('data/mahasiswa.json'); // path ke file JSON
    $jsonContent = file_get_contents($filePath);     // baca isi file
    $mahasiswa   = json_decode($jsonContent, true);  // ubah ke array PHP

    return response()->json([
        'success' => true,
        'total'   => count($mahasiswa),
        'data'    => $mahasiswa
    ]);
}
```

---

### `index.blade.php`
Halaman utama dengan tombol dan area tabel. Saat tombol diklik, fungsi `loadData()` dipanggil.

```javascript
function loadData() {
    // Kirim request ke /api/mahasiswa tanpa reload halaman
    fetch('{{ route("mahasiswa.data") }}', {
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    })
    .then(res => res.json())
    .then(json => renderTable(json.data)); // tampilkan hasil ke tabel
}

function renderTable(data) {
    // Buat baris tabel dari setiap data mahasiswa
    const rows = data.map(m => `
        <tr>
            <td>${m.nama}</td>
            <td>${m.nim}</td>
            <td>${m.kelas}</td>
            <td>${m.prodi}</td>
            <td>${m.ipk}</td>
        </tr>
    `).join('');

    document.getElementById('dataArea').innerHTML = `<table>...<tbody>${rows}</tbody></table>`;
}
```

---

## Cara Menggunakan

**1. Install Laravel dan salin file project**
```bash
composer create-project laravel/laravel mahasiswa-app --no-security-blocking
cd mahasiswa-app
```
Salin semua file dari project ini ke folder Laravel yang baru dibuat.

**2. Ubah konfigurasi `.env`**
```env
SESSION_DRIVER=file
```

**3. Generate key dan jalankan server**
```bash
php artisan key:generate
php artisan serve
```

**4. Buka di browser**
```
http://127.0.0.1:8000
```

**5. Klik tombol "Tampilkan Data"** — data mahasiswa akan langsung muncul dalam tabel tanpa reload halaman.

**6. Gunakan kotak pencarian** untuk memfilter data berdasarkan nama, NIM, kelas, atau prodi secara real-time.

<img src="assets/DataMahasiswa.jpeg" alt ="Data" width = "300"> 