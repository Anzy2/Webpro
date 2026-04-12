@extends('layouts.app')

@section('title', $owner['name'] . ' — Portfolio')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero section" id="hero">
  <div class="hero-bg-grid"></div>
  <div class="container hero-inner">

    <div class="hero-text" data-reveal>
      <span class="hero-badge">👋 Tersedia untuk proyek baru</span>
      <h1 class="hero-title">
        {{ $owner['name'] }}<br>
        <em>{{ $owner['role'] }}</em>
      </h1>
      <p class="hero-desc">
        Saya merancang dan membangun pengalaman digital yang bersih, fungsional, dan berkesan.
        Spesialis dalam desain antarmuka dan pengembangan front-end modern.
      </p>
      <div class="hero-actions">
        <a href="#portfolio" class="btn btn-primary">
          Lihat Karya <i data-feather="arrow-right" class="btn-icon"></i>
        </a>
        <a href="#contact" class="btn btn-ghost">Hubungi Saya</a>
      </div>
      <div class="hero-stats">
        <div class="stat">
          <span class="stat-num" data-count="32">0</span>
          <span class="stat-label">Proyek Selesai</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat">
          <span class="stat-num" data-count="5">0</span>
          <span class="stat-label">Tahun Pengalaman</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat">
          <span class="stat-num" data-count="18">0</span>
          <span class="stat-label">Klien Puas</span>
        </div>
      </div>
    </div>

    <div class="hero-visual" data-reveal data-delay="200">
      <div class="hero-card">
        <div class="card-avatar">TFN</div>
        <div class="card-info">
          <strong>{{ $owner['name'] }}</strong>
          <span>{{ $owner['role'] }}</span>
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
  <div class="scroll-hint">
    <span>Scroll</span>
    <div class="scroll-line"></div>
  </div>
</section>


{{-- ============ ABOUT ============ --}}
<section class="about section" id="about">
  <div class="container">
    <div class="section-label" data-reveal>Tentang Saya</div>
    <div class="about-grid">

      <div class="about-text" data-reveal>
        <h2 class="section-title">Desain bukan hanya<br><em>tampilan</em> — tapi <em>rasa</em>.</h2>
        <p>Saya adalah seorang desainer dan developer dengan passion mendalam terhadap antarmuka yang intuitif dan kode yang rapi. Percaya bahwa produk terbaik lahir dari kolaborasi antara estetika dan fungsionalitas.</p>
        <p>Dengan pengalaman 5 tahun di industri digital, saya telah membantu startup hingga enterprise meningkatkan pengalaman pengguna mereka secara signifikan.</p>
        <div class="about-meta">
          <div class="meta-item">
            <i data-feather="map-pin"></i>{{ $owner['location'] }}
          </div>
          <div class="meta-item">
            <i data-feather="mail"></i>{{ $owner['email'] }}
          </div>
          <div class="meta-item">
            <i data-feather="phone"></i>{{ $owner['phone'] }}
          </div>
        </div>
      </div>

      <div class="about-timeline" data-reveal data-delay="150">
        <h3 class="timeline-title">Perjalanan</h3>
        <div class="timeline">
          @foreach ($timeline as $item)
          <div class="tl-item">
            <div class="tl-dot"></div>
            <div class="tl-content">
              <span class="tl-year">{{ $item['year'] }}</span>
              <strong>{{ $item['role'] }}</strong>
              <span class="tl-company">{{ $item['company'] }}</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>


{{-- ============ SKILLS ============ --}}
<section class="skills section" id="skills">
  <div class="container">
    <div class="section-label" data-reveal>Keahlian</div>
    <h2 class="section-title centered" data-reveal>Apa yang saya <em>kuasai</em></h2>
    <div class="skills-grid" data-reveal data-delay="100">

      {{-- Desain --}}
      <div class="skill-category">
        <div class="skill-cat-label"><i data-feather="pen-tool"></i> Desain</div>
        @foreach ($skills['design'] as $s)
        <div class="skill-bar">
          <div class="skill-bar-header">
            <span class="skill-name">{{ $s['name'] }}</span>
            <span class="skill-pct">{{ $s['pct'] }}%</span>
          </div>
          <div class="skill-track">
            <div class="skill-fill" data-width="{{ $s['pct'] }}"></div>
          </div>
        </div>
        @endforeach
      </div>

      {{-- Development --}}
      <div class="skill-category">
        <div class="skill-cat-label"><i data-feather="code"></i> Development</div>
        @foreach ($skills['dev'] as $s)
        <div class="skill-bar">
          <div class="skill-bar-header">
            <span class="skill-name">{{ $s['name'] }}</span>
            <span class="skill-pct">{{ $s['pct'] }}%</span>
          </div>
          <div class="skill-track">
            <div class="skill-fill" data-width="{{ $s['pct'] }}"></div>
          </div>
        </div>
        @endforeach
      </div>

      {{-- Tools --}}
      <div class="skill-category">
        <div class="skill-cat-label"><i data-feather="tool"></i> Tools & Lainnya</div>
        @foreach ($skills['tools'] as $s)
        <div class="skill-bar">
          <div class="skill-bar-header">
            <span class="skill-name">{{ $s['name'] }}</span>
            <span class="skill-pct">{{ $s['pct'] }}%</span>
          </div>
          <div class="skill-track">
            <div class="skill-fill" data-width="{{ $s['pct'] }}"></div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</section>


{{-- ============ PORTFOLIO ============ --}}
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
      @foreach ($projects as $p)
      <div class="portfolio-card" data-category="{{ $p['category'] }}" data-reveal>
        <div class="pc-thumb" style="background:{{ $p['color'] }}">
          <span class="pc-emoji">{{ $p['emoji'] }}</span>
          <div class="pc-overlay">
            <button class="pc-view-btn" onclick="openProject({{ $p['id'] }})">
              <i data-feather="eye"></i> Lihat Detail
            </button>
          </div>
        </div>
        <div class="pc-body">
          <div class="pc-meta">
            <span class="pc-cat"
                  style="color:{{ $p['accent'] }};background:{{ $p['color'] }}">
              {{ $p['cat_label'] }}
            </span>
            <span class="pc-year">{{ $p['year'] }}</span>
          </div>
          <h3 class="pc-title">{{ $p['title'] }}</h3>
          <p class="pc-desc">{{ $p['desc'] }}</p>
          <div class="pc-tags">
            @foreach ($p['tags'] as $tag)
              <span class="pc-tag">{{ $tag }}</span>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>


{{-- ============ CONTACT ============ --}}
<section class="contact section" id="contact">
  <div class="container">
    <div class="section-label" data-reveal>Kontak</div>
    <div class="contact-grid">

      <div class="contact-info" data-reveal>
        <h2 class="section-title">Mari <em>berkolaborasi</em> bersama</h2>
        <p class="contact-desc">Punya proyek menarik? Saya selalu terbuka untuk diskusi dan kesempatan kerja sama baru.</p>
        <div class="contact-details">
          <a class="contact-item" href="mailto:{{ $owner['email'] }}">
            <div class="ci-icon"><i data-feather="mail"></i></div>
            <div><strong>Email</strong><span>{{ $owner['email'] }}</span></div>
          </a>
          <a class="contact-item" href="tel:{{ $owner['phone'] }}">
            <div class="ci-icon"><i data-feather="phone"></i></div>
            <div><strong>Telepon</strong><span>{{ $owner['phone'] }}</span></div>
          </a>
          <div class="contact-item">
            <div class="ci-icon"><i data-feather="map-pin"></i></div>
            <div><strong>Lokasi</strong><span>{{ $owner['location'] }}</span></div>
          </div>
        </div>
        <div class="social-row">
          <a href="#" class="social-btn" title="LinkedIn"><i data-feather="linkedin"></i></a>
          <a href="#" class="social-btn" title="GitHub"><i data-feather="github"></i></a>
          <a href="#" class="social-btn" title="Instagram"><i data-feather="instagram"></i></a>
          <a href="#" class="social-btn" title="Dribbble"><i data-feather="dribbble"></i></a>
        </div>
      </div>

      {{-- Form Kontak (AJAX ke /contact) --}}
      <div class="contact-form-wrap" data-reveal data-delay="150">
        <form id="contactForm" novalidate>
          @csrf {{-- Token CSRF otomatis Laravel --}}
          <div class="form-row">
            <div class="form-group">
              <label for="nama">Nama Lengkap *</label>
              <input type="text"  id="nama"  name="nama"
                     placeholder="Budi Santoso" required/>
              <span class="field-error" id="err-nama"></span>
            </div>
            <div class="form-group">
              <label for="email">Email *</label>
              <input type="email" id="email" name="email"
                     placeholder="budi@email.com" required/>
              <span class="field-error" id="err-email"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="subjek">Subjek *</label>
            <input type="text" id="subjek" name="subjek"
                   placeholder="Tawaran Proyek / Kolaborasi" required/>
            <span class="field-error" id="err-subjek"></span>
          </div>
          <div class="form-group">
            <label for="pesan">Pesan *</label>
            <textarea id="pesan" name="pesan" rows="5"
                      placeholder="Ceritakan lebih lanjut tentang proyek Anda..."
                      required></textarea>
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

@endsection
