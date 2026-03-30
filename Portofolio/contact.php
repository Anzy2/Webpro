<?php
/**
 * contact.php — Handler Form Kontak (AJAX Endpoint)
 * Dipanggil via AJAX dari script.js
 */

// Izinkan request dari same-origin saja
header('Content-Type: application/json; charset=utf-8');

// Hanya terima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan.']);
    exit;
}

// ---- Ambil & sanitasi input ----
$nama   = trim(strip_tags($_POST['nama']   ?? ''));
$email  = trim(strip_tags($_POST['email']  ?? ''));
$subjek = trim(strip_tags($_POST['subjek'] ?? ''));
$pesan  = trim(strip_tags($_POST['pesan']  ?? ''));

// ---- Validasi ----
$errors = [];

if (empty($nama) || mb_strlen($nama) < 2) {
    $errors['nama'] = 'Nama minimal 2 karakter.';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Format email tidak valid.';
}

if (empty($subjek) || mb_strlen($subjek) < 3) {
    $errors['subjek'] = 'Subjek minimal 3 karakter.';
}

if (empty($pesan) || mb_strlen($pesan) < 10) {
    $errors['pesan'] = 'Pesan minimal 10 karakter.';
}

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => 'Mohon periksa kembali isian form.',
        'errors'  => $errors
    ]);
    exit;
}


$log_dir  = __DIR__ . '/data';
$log_file = $log_dir . '/messages.json';

// Buat folder data jika belum ada
if (!is_dir($log_dir)) {
    mkdir($log_dir, 0755, true);
}

// Baca pesan lama
$messages = [];
if (file_exists($log_file)) {
    $raw = file_get_contents($log_file);
    $messages = json_decode($raw, true) ?: [];
}

// Tambahkan pesan baru
$new_message = [
    'id'        => uniqid(),
    'nama'      => $nama,
    'email'     => $email,
    'subjek'    => $subjek,
    'pesan'     => $pesan,
    'timestamp' => date('Y-m-d H:i:s'),
    'ip'        => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

$messages[] = $new_message;

// Simpan kembali
$saved = file_put_contents(
    $log_file,
    json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
    LOCK_EX
);

if ($saved === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal menyimpan pesan. Coba lagi nanti.'
    ]);
    exit;
}


echo json_encode([
    'success' => true,
    'message' => "Terima kasih, $nama! Pesan Anda telah diterima. Saya akan segera menghubungi Anda."
]);
exit;
