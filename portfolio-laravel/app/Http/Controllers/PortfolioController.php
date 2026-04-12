<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Data pemilik portofolio — ubah sesuai kebutuhan.
     */
    private array $owner = [
        'name'     => 'Titanio Francy Naddiansa',
        'role'     => 'UI/UX Designer & Front-End Developer',
        'email'    => 'titaniofrancy@gmail.com',
        'phone'    => '+62 877-3665-9183',
        'location' => 'Purwokerto, Indonesia',
    ];

    /**
     * Data skill — [nama, persentase]
     */
    private array $skills = [
        'design' => [
            ['name' => 'Figma',         'pct' => 92],
            ['name' => 'Adobe XD',      'pct' => 85],
            ['name' => 'Illustrator',   'pct' => 78],
            ['name' => 'Prototyping',   'pct' => 90],
        ],
        'dev' => [
            ['name' => 'HTML / CSS',    'pct' => 95],
            ['name' => 'JavaScript',    'pct' => 88],
            ['name' => 'PHP',           'pct' => 82],
            ['name' => 'React',         'pct' => 75],
        ],
        'tools' => [
            ['name' => 'Git / GitHub',  'pct' => 88],
            ['name' => 'MySQL',         'pct' => 80],
            ['name' => 'AJAX / REST API','pct' => 85],
            ['name' => 'Tailwind CSS',  'pct' => 82],
        ],
    ];

    /**
     * Data pengalaman / timeline
     */
    private array $timeline = [
        ['year' => '2027 – Kini', 'role' => 'Senior UI/UX Designer',    'company' => 'Kreasi Digital Studio'],
        ['year' => '2025 – 2026', 'role' => 'Front End Developer',       'company' => 'Bridge Note Indonesia'],
        ['year' => '2023 – 2024', 'role' => 'Magang',                    'company' => 'PT Telkom'],
        ['year' => '2023 – 2027', 'role' => 'Mahasiswa',                 'company' => 'Telkom University Purwokerto'],
    ];

    /**
     * Data proyek portofolio
     */
    private array $projects = [
        [
            'id'        => 1,
            'title'     => 'DineEase — App Reservasi Restoran',
            'category'  => 'ui',
            'cat_label' => 'UI/UX',
            'year'      => '2024',
            'color'     => '#F0EBE3',
            'accent'    => '#C4956A',
            'emoji'     => '🍽️',
            'desc'      => 'Redesign lengkap aplikasi mobile untuk reservasi meja restoran. Fokus pada alur pemesanan yang lebih cepat dan intuitif.',
            'tags'      => ['Figma', 'Prototyping', 'User Research'],
        ],
        [
            'id'        => 2,
            'title'     => 'DataFlow — Dashboard Analitik',
            'category'  => 'web',
            'cat_label' => 'Web Dev',
            'year'      => '2024',
            'color'     => '#E8F0FE',
            'accent'    => '#4A6CF7',
            'emoji'     => '📊',
            'desc'      => 'Dashboard data real-time untuk monitoring performa bisnis, dibangun dengan PHP, AJAX, dan Chart.js.',
            'tags'      => ['PHP', 'AJAX', 'Chart.js', 'MySQL'],
        ],
        [
            'id'        => 3,
            'title'     => 'LeafMart — E-Commerce Tanaman',
            'category'  => 'web',
            'cat_label' => 'Web Dev',
            'year'      => '2023',
            'color'     => '#E8F5E9',
            'accent'    => '#4CAF50',
            'emoji'     => '🌿',
            'desc'      => 'Platform e-commerce lengkap untuk penjualan tanaman hias dengan sistem keranjang dan pembayaran terintegrasi.',
            'tags'      => ['PHP', 'MySQL', 'JavaScript', 'CSS'],
        ],
        [
            'id'        => 4,
            'title'     => 'HealthPal — App Kesehatan',
            'category'  => 'mobile',
            'cat_label' => 'Mobile',
            'year'      => '2023',
            'color'     => '#FCE4EC',
            'accent'    => '#E91E8C',
            'emoji'     => '❤️',
            'desc'      => 'Aplikasi pelacak kesehatan harian dengan fitur reminder, diary makanan, dan grafik progress mingguan.',
            'tags'      => ['Figma', 'Adobe XD', 'Mobile UI'],
        ],
        [
            'id'        => 5,
            'title'     => 'EduSpace — LMS Platform',
            'category'  => 'ui',
            'cat_label' => 'UI/UX',
            'year'      => '2022',
            'color'     => '#FFF8E1',
            'accent'    => '#FF9800',
            'emoji'     => '📚',
            'desc'      => 'Desain sistem manajemen pembelajaran online untuk institusi pendidikan tinggi. Mencakup dashboard siswa dan instruktur.',
            'tags'      => ['Figma', 'Design System', 'Prototyping'],
        ],
        [
            'id'        => 6,
            'title'     => 'WorkSpace — SaaS Produktivitas',
            'category'  => 'web',
            'cat_label' => 'Web Dev',
            'year'      => '2022',
            'color'     => '#EDE7F6',
            'accent'    => '#7C4DFF',
            'emoji'     => '🚀',
            'desc'      => 'Aplikasi manajemen proyek tim berbasis web dengan fitur kanban board, chat, dan laporan progres.',
            'tags'      => ['PHP', 'JavaScript', 'AJAX', 'MySQL'],
        ],
    ];

    /**
     * Tampilkan halaman utama portofolio.
     */
    public function index(): View
    {
        return view('portfolio.index', [
            'owner'    => $this->owner,
            'skills'   => $this->skills,
            'timeline' => $this->timeline,
            'projects' => $this->projects,
        ]);
    }
}
