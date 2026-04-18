<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Mahasiswa</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #4f46e5;
            --primary-dark:  #3730a3;
            --primary-light: #eef2ff;
            --success:       #10b981;
            --warning:       #f59e0b;
            --danger:        #ef4444;
            --gray-50:       #f9fafb;
            --gray-100:      #f3f4f6;
            --gray-200:      #e5e7eb;
            --gray-300:      #d1d5db;
            --gray-400:      #9ca3af;
            --gray-500:      #6b7280;
            --gray-600:      #4b5563;
            --gray-700:      #374151;
            --gray-800:      #1f2937;
            --gray-900:      #111827;
            --white:         #ffffff;
            --shadow-sm:     0 1px 2px rgba(0,0,0,.05);
            --shadow:        0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -2px rgba(0,0,0,.1);
            --shadow-lg:     0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1);
            --radius:        12px;
            --radius-sm:     8px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
            color: var(--gray-800);
        }

        /* ===== LAYOUT ===== */
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* ===== HERO HEADER ===== */
        .hero {
            text-align: center;
            margin-bottom: 2rem;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(255,255,255,.2);
            color: var(--white);
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .35rem 1rem;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.35);
            margin-bottom: 1rem;
        }

        .hero-title {
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
            text-shadow: 0 2px 8px rgba(0,0,0,.2);
        }

        .hero-subtitle {
            color: rgba(255,255,255,.8);
            font-size: 1rem;
            margin-top: .5rem;
        }

        /* ===== MAIN CARD ===== */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-100);
            background: var(--gray-50);
        }

        .card-header-left h2 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gray-800);
        }

        .card-header-left p {
            font-size: .85rem;
            color: var(--gray-500);
            margin-top: .2rem;
        }

        .card-body {
            padding: 2rem;
        }

        /* ===== BUTTON ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-family: inherit;
            font-size: .9rem;
            font-weight: 600;
            padding: .65rem 1.5rem;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            transition: all .2s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 4px 14px rgba(79,70,229,.4);
        }

        .btn-primary:hover:not(:disabled) {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79,70,229,.5);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .btn-outline {
            background: transparent;
            color: var(--gray-600);
            border: 1.5px solid var(--gray-300);
        }

        .btn-outline:hover {
            background: var(--gray-100);
            border-color: var(--gray-400);
        }

        /* ===== STATS BAR ===== */
        .stats-bar {
            display: none;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stats-bar.visible { display: grid; }

        .stat-card {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            padding: 1rem 1.25rem;
            text-align: center;
        }

        .stat-card .stat-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: .75rem;
            color: var(--gray-500);
            margin-top: .3rem;
            font-weight: 500;
        }

        /* ===== SEARCH ===== */
        .toolbar {
            display: none;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
        }

        .toolbar.visible { display: flex; }

        .search-wrapper {
            flex: 1;
            min-width: 200px;
            position: relative;
        }

        .search-wrapper svg {
            position: absolute;
            left: .75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: .6rem .75rem .6rem 2.25rem;
            font-family: inherit;
            font-size: .9rem;
            border: 1.5px solid var(--gray-300);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            color: var(--gray-700);
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79,70,229,.15);
        }

        .result-count {
            font-size: .85rem;
            color: var(--gray-500);
            white-space: nowrap;
        }

        /* ===== TABLE ===== */
        .table-wrapper {
            overflow-x: auto;
            border-radius: var(--radius-sm);
            border: 1px solid var(--gray-200);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: .9rem;
        }

        thead tr {
            background: var(--gray-800);
            color: var(--white);
        }

        thead th {
            padding: .9rem 1.1rem;
            text-align: left;
            font-weight: 600;
            font-size: .8rem;
            letter-spacing: .05em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background .15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--primary-light); }

        tbody td {
            padding: .85rem 1.1rem;
            color: var(--gray-700);
            vertical-align: middle;
        }

        /* Avatar + nama */
        .cell-nama {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: var(--white);
            font-size: .8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nim-badge {
            display: inline-block;
            background: var(--gray-100);
            color: var(--gray-600);
            font-size: .78rem;
            font-weight: 600;
            padding: .2rem .6rem;
            border-radius: 999px;
            font-family: 'Courier New', monospace;
            letter-spacing: .02em;
        }

        .kelas-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
            font-size: .85rem;
            border-radius: 6px;
        }

        .ipk-pill {
            display: inline-block;
            padding: .25rem .65rem;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 600;
        }

        .ipk-high   { background: #d1fae5; color: #065f46; }
        .ipk-medium { background: #fef3c7; color: #92400e; }
        .ipk-low    { background: #fee2e2; color: #991b1b; }

        /* ===== STATES ===== */
        .empty-state, .loading-state, .error-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            text-align: center;
            gap: 1rem;
        }

        .empty-state .icon, .loading-state .icon, .error-state .icon {
            font-size: 3rem;
            line-height: 1;
        }

        .empty-state p, .loading-state p, .error-state p {
            color: var(--gray-500);
            font-size: .95rem;
        }

        .error-state p { color: var(--danger); }

        /* Loading spinner */
        .spinner {
            width: 48px; height: 48px;
            border: 4px solid var(--gray-200);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ===== TOAST ===== */
        .toast-container {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: .65rem;
            background: var(--gray-900);
            color: var(--white);
            padding: .75rem 1.25rem;
            border-radius: var(--radius-sm);
            font-size: .88rem;
            font-weight: 500;
            box-shadow: var(--shadow-lg);
            animation: slideIn .3s ease;
            min-width: 240px;
        }

        .toast.success { border-left: 4px solid var(--success); }
        .toast.error   { border-left: 4px solid var(--danger); }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }

        @keyframes slideOut {
            from { transform: translateX(0);    opacity: 1; }
            to   { transform: translateX(100%); opacity: 0; }
        }

        /* ===== NO DATA ROW ===== */
        .no-results td {
            text-align: center;
            color: var(--gray-400);
            padding: 2rem;
            font-style: italic;
        }

        /* ===== FOOTER ===== */
        .app-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: .8rem;
            color: rgba(255,255,255,.6);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            body { padding: 1rem .75rem; }
            .card-body { padding: 1.25rem; }
            .card-header { padding: 1.25rem; }
            thead th:nth-child(5),
            tbody td:nth-child(5) { display: none; } /* sembunyikan kolom IPK di mobile */
        }
    </style>
</head>
<body>

<div class="container">

    {{-- ===== HERO ===== --}}
    <div class="hero">
        <div class="hero-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
            Sistem Informasi Akademik
        </div>
        <h1 class="hero-title">Data Mahasiswa</h1>
        <p class="hero-subtitle">Manajemen data mahasiswa aktif — tanpa database</p>
    </div>

    {{-- ===== MAIN CARD ===== --}}
    <div class="card">

        {{-- Card Header --}}
        <div class="card-header">
            <div class="card-header-left">
                <h2>Daftar Mahasiswa</h2>
                <p>Klik tombol untuk memuat data dari file JSON lokal</p>
            </div>
            <div style="display:flex; gap:.75rem; flex-wrap:wrap;">
                <button id="btnLoad" class="btn btn-primary" onclick="loadData()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.44"/></svg>
                    Tampilkan Data
                </button>
                <button id="btnReset" class="btn btn-outline" onclick="resetData()" style="display:none;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    Reset
                </button>
            </div>
        </div>

        {{-- Card Body --}}
        <div class="card-body">

            {{-- Stats Bar --}}
            <div class="stats-bar" id="statsBar">
                <div class="stat-card">
                    <div class="stat-value" id="statTotal">0</div>
                    <div class="stat-label">Total Mahasiswa</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="statProdi">0</div>
                    <div class="stat-label">Program Studi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="statAvgIPK">0.00</div>
                    <div class="stat-label">Rata-rata IPK</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="statKelas">0</div>
                    <div class="stat-label">Kelas Aktif</div>
                </div>
            </div>

            {{-- Toolbar --}}
            <div class="toolbar" id="toolbar">
                <div class="search-wrapper">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama, NIM, atau prodi…" oninput="filterTable()">
                </div>
                <span class="result-count" id="resultCount"></span>
            </div>

            {{-- Area Hasil Data --}}
            <div id="dataArea">
                {{-- Initial empty state --}}
                <div class="empty-state" id="emptyState">
                    <div class="icon">🎓</div>
                    <p>Belum ada data yang dimuat.<br>Klik <strong>Tampilkan Data</strong> untuk memulai.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="app-footer">
        Dibuat dengan Laravel Blade + AJAX &nbsp;•&nbsp; Data bersumber dari <code>data/mahasiswa.json</code>
    </div>
</div>

{{-- Toast Container --}}
<div class="toast-container" id="toastContainer"></div>


<script>
    // ============================================================
    // State
    // ============================================================
    let allData = [];

    // ============================================================
    // Load data via AJAX
    // ============================================================
    function loadData() {
        const btn = document.getElementById('btnLoad');
        btn.disabled = true;
        btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin .7s linear infinite"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.44"/></svg>
            Memuat…`;

        showLoading();

        fetch('{{ route("mahasiswa.data") }}', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            return res.json();
        })
        .then(json => {
            if (!json.success) throw new Error(json.message || 'Gagal memuat data.');

            allData = json.data;
            renderTable(allData);
            updateStats(allData);
            showToast('success', `✅ ${json.total} data mahasiswa berhasil dimuat!`);

            // Tampilkan stats + toolbar + tombol reset
            document.getElementById('statsBar').classList.add('visible');
            document.getElementById('toolbar').classList.add('visible');
            document.getElementById('btnReset').style.display = 'inline-flex';
            btn.style.display = 'none';
        })
        .catch(err => {
            showError(err.message);
            showToast('error', '❌ Gagal: ' + err.message);
            btn.disabled = false;
            btn.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.44"/></svg>
                Coba Lagi`;
        });
    }

    // ============================================================
    // Render table
    // ============================================================
    function renderTable(data) {
        const area = document.getElementById('dataArea');

        if (!data || data.length === 0) {
            area.innerHTML = `
                <div class="empty-state">
                    <div class="icon">🔍</div>
                    <p>Tidak ada data yang sesuai pencarian.</p>
                </div>`;
            return;
        }

        const rows = data.map((m, i) => {
            const inisial = m.nama.split(' ').map(w => w[0]).slice(0,2).join('').toUpperCase();
            const ipkClass = m.ipk >= 3.7 ? 'ipk-high' : m.ipk >= 3.3 ? 'ipk-medium' : 'ipk-low';
            return `
            <tr>
                <td style="color:var(--gray-400);font-size:.8rem;font-weight:600;">${String(i+1).padStart(2,'0')}</td>
                <td>
                    <div class="cell-nama">
                        <div class="avatar">${inisial}</div>
                        <span style="font-weight:500;">${escHtml(m.nama)}</span>
                    </div>
                </td>
                <td><span class="nim-badge">${escHtml(m.nim)}</span></td>
                <td><span class="kelas-badge">${escHtml(m.kelas)}</span></td>
                <td style="max-width:200px;">${escHtml(m.prodi)}</td>
                <td>${m.ipk !== undefined ? `<span class="ipk-pill ${ipkClass}">${Number(m.ipk).toFixed(2)}</span>` : '—'}</td>
            </tr>`;
        }).join('');

        area.innerHTML = `
            <div class="table-wrapper">
                <table id="mahasiswaTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Kelas</th>
                            <th>Program Studi</th>
                            <th>IPK</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">${rows}</tbody>
                </table>
            </div>`;

        updateResultCount(data.length, allData.length);
    }

    // ============================================================
    // Filter / search
    // ============================================================
    function filterTable() {
        const q = document.getElementById('searchInput').value.toLowerCase().trim();
        const filtered = q
            ? allData.filter(m =>
                m.nama.toLowerCase().includes(q) ||
                m.nim.toLowerCase().includes(q)  ||
                m.prodi.toLowerCase().includes(q) ||
                m.kelas.toLowerCase().includes(q)
              )
            : allData;

        renderTable(filtered);
    }

    function updateResultCount(shown, total) {
        const el = document.getElementById('resultCount');
        el.textContent = shown === total
            ? `${total} mahasiswa`
            : `${shown} dari ${total} mahasiswa`;
    }

    // ============================================================
    // Stats
    // ============================================================
    function updateStats(data) {
        document.getElementById('statTotal').textContent = data.length;
        document.getElementById('statProdi').textContent = new Set(data.map(m => m.prodi)).size;
        document.getElementById('statKelas').textContent = new Set(data.map(m => m.kelas)).size;
        const avg = data.reduce((s, m) => s + (m.ipk || 0), 0) / (data.length || 1);
        document.getElementById('statAvgIPK').textContent = avg.toFixed(2);
    }

    // ============================================================
    // Reset
    // ============================================================
    function resetData() {
        allData = [];
        document.getElementById('dataArea').innerHTML = `
            <div class="empty-state" id="emptyState">
                <div class="icon">🎓</div>
                <p>Belum ada data yang dimuat.<br>Klik <strong>Tampilkan Data</strong> untuk memulai.</p>
            </div>`;
        document.getElementById('statsBar').classList.remove('visible');
        document.getElementById('toolbar').classList.remove('visible');
        document.getElementById('btnReset').style.display = 'none';
        document.getElementById('searchInput').value = '';

        const btn = document.getElementById('btnLoad');
        btn.style.display = 'inline-flex';
        btn.disabled = false;
        btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.44"/></svg>
            Tampilkan Data`;
    }

    // ============================================================
    // UI Helpers
    // ============================================================
    function showLoading() {
        document.getElementById('dataArea').innerHTML = `
            <div class="loading-state">
                <div class="spinner"></div>
                <p>Memuat data mahasiswa…</p>
            </div>`;
    }

    function showError(msg) {
        document.getElementById('dataArea').innerHTML = `
            <div class="error-state">
                <div class="icon">⚠️</div>
                <p>${escHtml(msg)}</p>
            </div>`;
    }

    function escHtml(str) {
        return String(str)
            .replace(/&/g,'&amp;')
            .replace(/</g,'&lt;')
            .replace(/>/g,'&gt;')
            .replace(/"/g,'&quot;');
    }

    function showToast(type, message) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.textContent = message;
        container.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideOut .3s ease forwards';
            setTimeout(() => toast.remove(), 300);
        }, 3200);
    }
</script>

{{-- Inject spinner keyframe globally --}}
<style>
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

</body>
</html>
