<?php
  $page_title = "Titanio Francy Naddiansa — Portfolio";
  $owner_name = "Titanio Francy Naddiansa";
  $owner_role = "UI/UX Designer & Front-End Developer";
  $owner_email = "titaniofrancy@gmail.com";
  $owner_phone = "+62 877-3665-9183";
  $owner_location = "Purwokerto, Indonesia";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($page_title) ?></title>
  <link rel="stylesheet" href="assets/css/style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
  <!-- Feather Icons CDN -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>

<!-- ============ CURSOR ============ -->
<div class="cursor" id="cursor"></div>
<div class="cursor-follower" id="cursorFollower"></div>

<!-- ============ NAVBAR ============ -->
<nav class="navbar" id="navbar">
  <div class="nav-inner">
    <a href="#hero" class="nav-logo">TFN<span>.</span></a>
    <ul class="nav-links">
      <li><a href="#about" class="nav-link">Tentang</a></li>
      <li><a href="#skills" class="nav-link">Skill</a></li>
      <li><a href="#portfolio" class="nav-link">Portofolio</a></li>
      <li><a href="#contact" class="nav-link">Kontak</a></li>
    </ul>
    <a href="assets/cv/cv-Titanio Francy Naddiansa.pdf" download class="btn btn-outline nav-cv">
      <i data-feather="download" class="btn-icon"></i> Download CV
    </a>
    <button class="hamburger" id="hamburger" aria-label="menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
  <ul>
    <li><a href="#about" class="mobile-link">Tentang</a></li>
    <li><a href="#skills" class="mobile-link">Skill</a></li>
    <li><a href="#portfolio" class="mobile-link">Portofolio</a></li>
    <li><a href="#contact" class="mobile-link">Kontak</a></li>
    <li><a href="assets/cv/cv-alex-naufal.pdf" download class="mobile-link cv-link">⬇ Download CV</a></li>
  </ul>
</div>

<!-- ============ HERO ============ -->
<section class="hero section" id="hero">
  <div class="hero-bg-grid"></div>
  <div class="container hero-inner">
    <div class="hero-text" data-reveal>
      <span class="hero-badge">👋 Tersedia untuk proyek baru</span>
      <h1 class="hero-title">
        <?= htmlspecialchars($owner_name) ?><br>
        <em><?= htmlspecialchars($owner_role) ?></em>
      </h1>
      <p class="hero-desc">
        Saya merancang dan membangun pengalaman digital yang bersih, fungsional, dan berkesan. 
        Spesialis dalam desain antarmuka dan pengembangan front-end modern.
      </p>
      <div class="hero-actions">
        <a href="#portfolio" class="btn btn-primary">Lihat Karya <i data-feather="arrow-right" class="btn-icon"></i></a>
        <a href="#contact" class="btn btn-ghost">Hubungi Saya</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><span class="stat-num" data-count="32">0</span><span class="stat-label">Proyek Selesai</span></div>
        <div class="stat-divider"></div>
        <div class="stat"><span class="stat-num" data-count="5">0</span><span class="stat-label">Tahun Pengalaman</span></div>
        <div class="stat-divider"></div>
        <div class="stat"><span class="stat-num" data-count="18">0</span><span class="stat-label">Klien Puas</span></div>
      </div>
    </div>
    <div class="hero-visual" data-reveal data-delay="200">
      <div class="hero-card">
        <div class="card-avatar">TFN</div>
        <div class="card-info">
          <strong><?= htmlspecialchars($owner_name) ?></strong>
          <span><?= htmlspecialchars($owner_role) ?></span>
        </div>
        <div class="card-badge available">● Aktif</div>
        <div class="card-skills-row">
          <span class="chip">Figma</span>
          <span class="chip">React</span>
          <span class="chip">PHP</span>
          <span class="chip">UI/UX</span>
        </div>
        <div class="card-decoration"></div>
      </div>
      <div class="floating-tag tag-2"><i data-feather="code"></i> Dev</div>
    </div>
  </div>
  <div class="scroll-hint"><span>Scroll</span><div class="scroll-line"></div></div>
</section>

<!-- ============ ABOUT ============ -->
<section class="about section" id="about">
  <div class="container">
    <div class="section-label" data-reveal>Tentang Saya</div>
    <div class="about-grid">
      <div class="about-text" data-reveal>
        <h2 class="section-title">Desain bukan hanya<br><em>tampilan</em> — tapi <em>rasa</em>.</h2>
        <p>Saya adalah seorang desainer dan developer dengan passion mendalam terhadap antarmuka yang intuitif dan kode yang rapi. Percaya bahwa produk terbaik lahir dari kolaborasi antara estetika dan fungsionalitas.</p>
        <p>Dengan pengalaman 5 tahun di industri digital, saya telah membantu startup hingga enterprise meningkatkan pengalaman pengguna mereka secara signifikan.</p>
        <div class="about-meta">
          <div class="meta-item"><i data-feather="map-pin"></i><?= htmlspecialchars($owner_location) ?></div>
          <div class="meta-item"><i data-feather="mail"></i><?= htmlspecialchars($owner_email) ?></div>
          <div class="meta-item"><i data-feather="phone"></i><?= htmlspecialchars($owner_phone) ?></div>
        </div>
      </div>
      <div class="about-timeline" data-reveal data-delay="150">
        <h3 class="timeline-title">Perjalanan</h3>
        <div class="timeline">
          <div class="tl-item">
            <div class="tl-dot"></div>
            <div class="tl-content">
              <span class="tl-year">2027 – Kini</span>
              <strong>senior ui/ux desaigner</strong>
              <span class="tl-company">Kreasi Digital Studio</span>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot"></div>
            <div class="tl-content">
              <span class="tl-year">2025 – 2026 </span>
              <strong>front end developer</strong>
              <span class="tl-company">bridge note indonesia</span>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot"></div>
            <div class="tl-content">
              <span class="tl-year">2023 – 2024</span>
              <strong>magang</strong>
              <span class="tl-company">pt telkom</span>
            </div>
          </div>
          <div class="tl-item">
            <div class="tl-dot"></div>
            <div class="tl-content">
              <span class="tl-year">2023 – 2027</span>
              <strong>mahasiswa</strong>
              <span class="tl-company">Telkom University Purwokerto</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SKILLS ============ -->
<section class="skills section" id="skills">
  <div class="container">
    <div class="section-label" data-reveal>Keahlian</div>
    <h2 class="section-title centered" data-reveal>Apa yang saya <em>kuasai</em></h2>
    <div class="skills-grid" data-reveal data-delay="100">

      <div class="skill-category">
        <div class="skill-cat-label"><i data-feather="pen-tool"></i> Desain</div>
        <?php
          $design_skills = [
            ["Figma", 92], ["Adobe XD", 85], ["Illustrator", 78], ["Prototyping", 90]
          ];
          foreach ($design_skills as $s): ?>
          <div class="skill-bar">
            <div class="skill-bar-header">
              <span class="skill-name"><?= $s[0] ?></span>
              <span class="skill-pct"><?= $s[1] ?>%</span>
            </div>
            <div class="skill-track">
              <div class="skill-fill" data-width="<?= $s[1] ?>"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="skill-category">
        <div class="skill-cat-label"><i data-feather="code"></i> Development</div>
        <?php
          $dev_skills = [
            ["HTML / CSS", 95], ["JavaScript", 88], ["PHP", 82], ["React", 75]
          ];
          foreach ($dev_skills as $s): ?>
          <div class="skill-bar">
            <div class="skill-bar-header">
              <span class="skill-name"><?= $s[0] ?></span>
              <span class="skill-pct"><?= $s[1] ?>%</span>
            </div>
            <div class="skill-track">
              <div class="skill-fill" data-width="<?= $s[1] ?>"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="skill-category">
        <div class="skill-cat-label"><i data-feather="tool"></i> Tools & Lainnya</div>
        <?php
          $other_skills = [
            ["Git / GitHub", 88], ["MySQL", 80], ["AJAX / REST API", 85], ["Tailwind CSS", 82]
          ];
          foreach ($other_skills as $s): ?>
          <div class="skill-bar">
            <div class="skill-bar-header">
              <span class="skill-name"><?= $s[0] ?></span>
              <span class="skill-pct"><?= $s[1] ?>%</span>
            </div>
            <div class="skill-track">
              <div class="skill-fill" data-width="<?= $s[1] ?>"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ============ PORTFOLIO ============ -->
<section class="portfolio section" id="portfolio">
  <div class="container">
    <div class="section-label" data-reveal>Karya</div>
    <div class="portfolio-header" data-reveal>
      <h2 class="section-title">Proyek <em>Pilihan</em></h2>
      <div class="filter-tabs">
        <button class="filter-btn active" data-filter="all">Semua</button>
        <button class="filter-btn" data-filter="ui">UI/UX</button>
        <button class="filter-btn" data-filter="web">Web Dev</button>
        <button class="filter-btn" data-filter="mobile">Mobile</button>
      </div>
    </div>

    <div class="portfolio-grid" id="portfolioGrid">
      <?php
        $projects = [
          [
            "id" => 1,
            "title" => "DineEase — App Reservasi Restoran",
            "category" => "ui",
            "cat_label" => "UI/UX",
            "year" => "2024",
            "color" => "#F0EBE3",
            "accent" => "#C4956A",
            "emoji" => "🍽️",
            "desc" => "Redesign lengkap aplikasi mobile untuk reservasi meja restoran. Fokus pada alur pemesanan yang lebih cepat dan intuitif.",
            "tags" => ["Figma", "Prototyping", "User Research"]
          ],
          [
            "id" => 2,
            "title" => "DataFlow — Dashboard Analitik",
            "category" => "web",
            "cat_label" => "Web Dev",
            "year" => "2024",
            "color" => "#E8F0FE",
            "accent" => "#4A6CF7",
            "emoji" => "📊",
            "desc" => "Dashboard data real-time untuk monitoring performa bisnis, dibangun dengan PHP, AJAX, dan Chart.js.",
            "tags" => ["PHP", "AJAX", "Chart.js", "MySQL"]
          ],
          [
            "id" => 3,
            "title" => "LeafMart — E-Commerce Tanaman",
            "category" => "web",
            "cat_label" => "Web Dev",
            "year" => "2023",
            "color" => "#E8F5E9",
            "accent" => "#4CAF50",
            "emoji" => "🌿",
            "desc" => "Platform e-commerce lengkap untuk penjualan tanaman hias dengan sistem keranjang dan pembayaran terintegrasi.",
            "tags" => ["PHP", "MySQL", "JavaScript", "CSS"]
          ],
          [
            "id" => 4,
            "title" => "HealthPal — App Kesehatan",
            "category" => "mobile",
            "cat_label" => "Mobile",
            "year" => "2023",
            "color" => "#FCE4EC",
            "accent" => "#E91E8C",
            "emoji" => "❤️",
            "desc" => "Aplikasi pelacak kesehatan harian dengan fitur reminder, diary makanan, dan grafik progress mingguan.",
            "tags" => ["Figma", "Adobe XD", "Mobile UI"]
          ],
          [
            "id" => 5,
            "title" => "EduSpace — LMS Platform",
            "category" => "ui",
            "cat_label" => "UI/UX",
            "year" => "2022",
            "color" => "#FFF8E1",
            "accent" => "#FF9800",
            "emoji" => "📚",
            "desc" => "Desain sistem manajemen pembelajaran online untuk institusi pendidikan tinggi. Mencakup dashboard siswa dan instruktur.",
            "tags" => ["Figma", "Design System", "Prototyping"]
          ],
          [
            "id" => 6,
            "title" => "WorkSpace — SaaS Produktivitas",
            "category" => "web",
            "cat_label" => "Web Dev",
            "year" => "2022",
            "color" => "#EDE7F6",
            "accent" => "#7C4DFF",
            "emoji" => "🚀",
            "desc" => "Aplikasi manajemen proyek tim berbasis web dengan fitur kanban board, chat, dan laporan progres.",
            "tags" => ["PHP", "JavaScript", "AJAX", "MySQL"]
          ],
        ];
        foreach ($projects as $p): ?>
        <div class="portfolio-card" data-category="<?= $p['category'] ?>" data-reveal>
          <div class="pc-thumb" style="background:<?= $p['color'] ?>">
            <span class="pc-emoji"><?= $p['emoji'] ?></span>
            <div class="pc-overlay">
              <button class="pc-view-btn" onclick="openProject(<?= $p['id'] ?>)">
                <i data-feather="eye"></i> Lihat Detail
              </button>
            </div>
          </div>
          <div class="pc-body">
            <div class="pc-meta">
              <span class="pc-cat" style="color:<?= $p['accent'] ?>;background:<?= $p['color'] ?>"><?= $p['cat_label'] ?></span>
              <span class="pc-year"><?= $p['year'] ?></span>
            </div>
            <h3 class="pc-title"><?= htmlspecialchars($p['title']) ?></h3>
            <p class="pc-desc"><?= htmlspecialchars($p['desc']) ?></p>
            <div class="pc-tags">
              <?php foreach ($p['tags'] as $tag): ?>
                <span class="pc-tag"><?= $tag ?></span>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ CONTACT ============ -->
<section class="contact section" id="contact">
  <div class="container">
    <div class="section-label" data-reveal>Kontak</div>
    <div class="contact-grid">
      <div class="contact-info" data-reveal>
        <h2 class="section-title">Mari <em>berkolaborasi</em> bersama</h2>
        <p class="contact-desc">Punya proyek menarik? Saya selalu terbuka untuk diskusi dan kesempatan kerja sama baru.</p>
        <div class="contact-details">
          <a class="contact-item" href="mailto:<?= $owner_email ?>">
            <div class="ci-icon"><i data-feather="mail"></i></div>
            <div><strong>Email</strong><span><?= $owner_email ?></span></div>
          </a>
          <a class="contact-item" href="tel:<?= $owner_phone ?>">
            <div class="ci-icon"><i data-feather="phone"></i></div>
            <div><strong>Telepon</strong><span><?= $owner_phone ?></span></div>
          </a>
          <div class="contact-item">
            <div class="ci-icon"><i data-feather="map-pin"></i></div>
            <div><strong>Lokasi</strong><span><?= $owner_location ?></span></div>
          </div>
        </div>
        <div class="social-row">
          <a href="#" class="social-btn" title="LinkedIn"><i data-feather="linkedin"></i></a>
          <a href="#" class="social-btn" title="GitHub"><i data-feather="github"></i></a>
          <a href="#" class="social-btn" title="Instagram"><i data-feather="instagram"></i></a>
          <a href="#" class="social-btn" title="Dribbble"><i data-feather="dribbble"></i></a>
        </div>
      </div>

      <!-- FORM KONTAK (dikirim via AJAX ke contact.php) -->
      <div class="contact-form-wrap" data-reveal data-delay="150">
        <form id="contactForm" novalidate>
          <div class="form-row">
            <div class="form-group">
              <label for="nama">Nama Lengkap *</label>
              <input type="text" id="nama" name="nama" placeholder="Budi Santoso" required/>
              <span class="field-error" id="err-nama"></span>
            </div>
            <div class="form-group">
              <label for="email">Email *</label>
              <input type="email" id="email" name="email" placeholder="budi@email.com" required/>
              <span class="field-error" id="err-email"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="subjek">Subjek *</label>
            <input type="text" id="subjek" name="subjek" placeholder="Tawaran Proyek / Kolaborasi" required/>
            <span class="field-error" id="err-subjek"></span>
          </div>
          <div class="form-group">
            <label for="pesan">Pesan *</label>
            <textarea id="pesan" name="pesan" rows="5" placeholder="Ceritakan lebih lanjut tentang proyek Anda..." required></textarea>
            <span class="field-error" id="err-pesan"></span>
          </div>
          <div id="formAlert" class="form-alert hidden"></div>
          <button type="submit" class="btn btn-primary btn-full" id="submitBtn">
            <span id="btnText">Kirim Pesan</span>
            <i data-feather="send" class="btn-icon" id="btnIcon"></i>
            <span class="btn-loader hidden" id="btnLoader"></span>
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- ============ FOOTER ============ -->
<footer class="footer">
  <div class="container footer-inner">
    <span class="footer-logo">TFN<span>.</span></span>
    <p>© <?= date('Y') ?> <?= htmlspecialchars($owner_name) ?>. Dibuat dengan ❤️ menggunakan PHP & CSS.</p>
    <a href="#hero" class="back-top"><i data-feather="arrow-up"></i></a>
  </div>
</footer>

<!-- ============ PROJECT MODAL ============ -->
<div class="modal-overlay" id="projectModal">
  <div class="modal-backdrop" id="modalBackdrop"></div>
  <div class="modal-box" id="modalBox">
    <button class="modal-close" id="modalClose"><i data-feather="x"></i></button>
    <div id="modalContent"><!-- filled by JS --></div>
  </div>
</div>

<script src="assets/js/script.js"></script>
<script>feather.replace();</script>
</body>
</html>
