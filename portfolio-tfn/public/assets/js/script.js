/**
 * script.js — Portfolio Interactive Logic
 * Features: Custom Cursor, Scroll Reveal, Skill Bar, Counter,
 *           Portfolio Filter, Project Modal, AJAX Contact Form
 */

document.addEventListener('DOMContentLoaded', () => {

  // ==================================================
  // 1. CUSTOM CURSOR
  // ==================================================
  const cursor   = document.getElementById('cursor');
  const follower = document.getElementById('cursorFollower');
  let mouseX = 0, mouseY = 0, followerX = 0, followerY = 0;

  document.addEventListener('mousemove', e => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    cursor.style.left = mouseX + 'px';
    cursor.style.top  = mouseY + 'px';
  });

  // Smooth follower
  function animateCursor() {
    followerX += (mouseX - followerX) * 0.12;
    followerY += (mouseY - followerY) * 0.12;
    follower.style.left = followerX + 'px';
    follower.style.top  = followerY + 'px';
    requestAnimationFrame(animateCursor);
  }
  animateCursor();

  // Hover effect on interactive elements
  const hoverEls = document.querySelectorAll('a, button, .portfolio-card, .skill-category, .card');
  hoverEls.forEach(el => {
    el.addEventListener('mouseenter', () => {
      cursor.style.transform   = 'translate(-50%,-50%) scale(2)';
      follower.style.transform = 'translate(-50%,-50%) scale(1.6)';
      follower.style.opacity   = '0.25';
    });
    el.addEventListener('mouseleave', () => {
      cursor.style.transform   = 'translate(-50%,-50%) scale(1)';
      follower.style.transform = 'translate(-50%,-50%) scale(1)';
      follower.style.opacity   = '0.5';
    });
  });

  // ==================================================
  // 2. NAVBAR SCROLL STATE
  // ==================================================
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 40);
  }, { passive: true });

  // ==================================================
  // 3. HAMBURGER MOBILE MENU
  // ==================================================
  const hamburger  = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobileMenu');

  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobileMenu.classList.toggle('open');
  });

  document.querySelectorAll('.mobile-link').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('open');
      mobileMenu.classList.remove('open');
    });
  });

  // ==================================================
  // 4. SCROLL REVEAL (IntersectionObserver)
  // ==================================================
  const revealEls = document.querySelectorAll('[data-reveal]');

  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const delay = entry.target.dataset.delay || 0;
        setTimeout(() => {
          entry.target.classList.add('revealed');
          // Trigger skills if inside skills section
          entry.target.querySelectorAll('.skill-fill').forEach(animateSkillBar);
        }, parseInt(delay));
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  revealEls.forEach(el => revealObserver.observe(el));

  // ==================================================
  // 5. SKILL BAR ANIMATION
  // ==================================================
  function animateSkillBar(bar) {
    const targetWidth = bar.dataset.width;
    bar.style.width = targetWidth + '%';
  }

  // Observe skill sections specifically
  const skillSection = document.getElementById('skills');
  if (skillSection) {
    const skillObserver = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        document.querySelectorAll('.skill-fill').forEach(animateSkillBar);
        skillObserver.disconnect();
      }
    }, { threshold: 0.3 });
    skillObserver.observe(skillSection);
  }

  // ==================================================
  // 6. ANIMATED COUNTERS
  // ==================================================
  const counters = document.querySelectorAll('[data-count]');
  let countersStarted = false;

  function startCounters() {
    if (countersStarted) return;
    countersStarted = true;
    counters.forEach(counter => {
      const target = parseInt(counter.dataset.count);
      const duration = 1800;
      const step = target / (duration / 16);
      let current = 0;
      const interval = setInterval(() => {
        current += step;
        if (current >= target) {
          current = target;
          clearInterval(interval);
        }
        counter.textContent = Math.floor(current);
      }, 16);
    });
  }

  const heroSection = document.getElementById('hero');
  const counterObserver = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) startCounters();
  }, { threshold: 0.5 });
  if (heroSection) counterObserver.observe(heroSection);

  // ==================================================
  // 7. PORTFOLIO FILTER
  // ==================================================
  const filterBtns  = document.querySelectorAll('.filter-btn');
  const portfolioCards = document.querySelectorAll('.portfolio-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.dataset.filter;

      portfolioCards.forEach(card => {
        const match = filter === 'all' || card.dataset.category === filter;
        if (match) {
          card.classList.remove('hidden');
          // Reset + re-trigger animation
          card.style.animation = 'none';
          card.offsetHeight; // reflow
          card.style.animation = '';
        } else {
          card.classList.add('hidden');
        }
      });
    });
  });

  // ==================================================
  // 8. PROJECT MODAL
  // ==================================================
  const projectData = {
    1: {
      emoji: '🍽️',
      title: 'DineEase — App Reservasi Restoran',
      category: 'UI/UX Design',
      year: '2024',
      color: '#F0EBE3',
      accent: '#C4956A',
      desc: 'Proyek redesign menyeluruh untuk aplikasi mobile reservasi restoran. Dimulai dari riset pengguna mendalam, pemetaan user journey, hingga prototype interaktif berdasarkan feedback nyata.',
      longDesc: 'Tantangan utama adalah menyederhanakan alur pemesanan dari 7 langkah menjadi hanya 3, sambil menambahkan fitur pemilihan meja secara visual. Hasilnya meningkatkan konversi reservasi sebesar 42%.',
      tags: ['Figma', 'Prototyping', 'User Research', 'Mobile UI', 'Usability Testing'],
    },
    2: {
      emoji: '📊',
      title: 'DataFlow — Dashboard Analitik',
      category: 'Web Development',
      year: '2024',
      color: '#E8F0FE',
      accent: '#4A6CF7',
      desc: 'Dashboard analitik real-time untuk bisnis retail, dibangun dengan PHP backend, MySQL database, dan pembaruan data via AJAX polling setiap 30 detik.',
      longDesc: 'Sistem menampilkan 12 jenis grafik interaktif (Chart.js), tabel data dengan sorting/filter, dan fitur ekspor ke Excel/PDF. Dioptimalkan untuk performa dengan query caching.',
      tags: ['PHP', 'AJAX', 'Chart.js', 'MySQL', 'JavaScript', 'CSS Grid'],
    },
    3: {
      emoji: '🌿',
      title: 'LeafMart — E-Commerce Tanaman',
      category: 'Web Development',
      year: '2023',
      color: '#E8F5E9',
      accent: '#4CAF50',
      desc: 'Platform e-commerce lengkap untuk penjualan tanaman hias. Fitur meliputi keranjang belanja, wishlist, sistem ulasan, dan integrasi pembayaran.',
      longDesc: 'Dibangun dari nol menggunakan PHP native + MySQL. Menerapkan session-based cart, pencarian real-time dengan AJAX, dan sistem upload foto produk dengan optimasi otomatis.',
      tags: ['PHP', 'MySQL', 'JavaScript', 'CSS', 'AJAX', 'Payment Gateway'],
    },
    4: {
      emoji: '❤️',
      title: 'HealthPal — App Kesehatan',
      category: 'Mobile UI Design',
      year: '2023',
      color: '#FCE4EC',
      accent: '#E91E8C',
      desc: 'Desain UI/UX untuk aplikasi pelacak kesehatan harian. Menggabungkan estetika yang menyenangkan dengan data kesehatan yang kompleks.',
      longDesc: 'Tantangan terbesar adalah menyajikan data kesehatan yang padat (BMI, kalori, tidur, langkah kaki) dalam antarmuka yang tidak terasa overwhelming. Solusinya adalah sistem dashboard modular yang bisa dikustomisasi pengguna.',
      tags: ['Figma', 'Adobe XD', 'Mobile UI', 'Design System', 'Animation'],
    },
    5: {
      emoji: '📚',
      title: 'EduSpace — LMS Platform',
      category: 'UI/UX Design',
      year: '2022',
      color: '#FFF8E1',
      accent: '#FF9800',
      desc: 'Sistem manajemen pembelajaran komprehensif untuk universitas dengan 15.000+ mahasiswa. Mencakup modul kelas, tugas, ujian, dan forum diskusi.',
      longDesc: 'Proyek 8 bulan yang melibatkan riset dengan 200+ pengguna (mahasiswa dan dosen). Menghasilkan design system lengkap dengan 80+ komponen yang konsisten di seluruh platform.',
      tags: ['Figma', 'Design System', 'Prototyping', 'User Research', 'Accessibility'],
    },
    6: {
      emoji: '🚀',
      title: 'WorkSpace — SaaS Produktivitas',
      category: 'Web Development',
      year: '2022',
      color: '#EDE7F6',
      accent: '#7C4DFF',
      desc: 'Aplikasi manajemen proyek SaaS dengan fitur kanban board drag-and-drop, chat tim real-time simulasi via AJAX long-polling, dan laporan progres otomatis.',
      longDesc: 'Arsitektur MVC PHP dengan sistem autentikasi berbasis JWT, manajemen peran pengguna (admin/member/viewer), dan notifikasi in-app. Sudah digunakan oleh 3 startup early-stage.',
      tags: ['PHP', 'JavaScript', 'AJAX', 'MySQL', 'CSS', 'MVC Architecture'],
    },
  };

  const modal        = document.getElementById('projectModal');
  const modalContent = document.getElementById('modalContent');
  const modalClose   = document.getElementById('modalClose');
  const modalBackdrop= document.getElementById('modalBackdrop');

  window.openProject = function(id) {
    const p = projectData[id];
    if (!p) return;

    modalContent.innerHTML = `
      <span class="modal-emoji">${p.emoji}</span>
      <div class="modal-meta">
        <span class="pc-cat" style="color:${p.accent};background:${p.color}">${p.category}</span>
        <span class="pc-year">${p.year}</span>
      </div>
      <h2 class="modal-title">${p.title}</h2>
      <p class="modal-desc">${p.desc}</p>
      <p class="modal-desc" style="margin-bottom:20px">${p.longDesc}</p>
      <div class="modal-tags">
        ${p.tags.map(t => `<span class="modal-tag">${t}</span>`).join('')}
      </div>
      <div class="modal-cta">
        <button class="btn btn-primary" onclick="closeProject()">
          <span>Tutup</span>
        </button>
      </div>
    `;

    // Re-init feather icons inside modal
    if (window.feather) feather.replace();

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  };

  window.closeProject = function() {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  };

  modalClose.addEventListener('click', closeProject);
  modalBackdrop.addEventListener('click', closeProject);
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeProject();
  });

  // ==================================================
  // 9. AJAX CONTACT FORM
  // ==================================================
  const form      = document.getElementById('contactForm');
  const formAlert = document.getElementById('formAlert');
  const submitBtn = document.getElementById('submitBtn');
  const btnText   = document.getElementById('btnText');
  const btnIcon   = document.getElementById('btnIcon');
  const btnLoader = document.getElementById('btnLoader');

  function clearErrors() {
    document.querySelectorAll('.field-error').forEach(el => el.textContent = '');
    document.querySelectorAll('.form-group input, .form-group textarea')
      .forEach(el => el.classList.remove('error'));
    formAlert.className = 'form-alert hidden';
    formAlert.textContent = '';
  }

  function showFieldError(field, msg) {
    const input = document.getElementById(field);
    const errEl = document.getElementById('err-' + field);
    if (input) input.classList.add('error');
    if (errEl) errEl.textContent = msg;
  }

  function setLoading(loading) {
    submitBtn.disabled = loading;
    btnText.textContent = loading ? 'Mengirim...' : 'Kirim Pesan';
    btnIcon.classList.toggle('hidden', loading);
    btnLoader.classList.toggle('hidden', !loading);
  }

  function showAlert(type, msg) {
    formAlert.className = `form-alert ${type}`;
    formAlert.textContent = msg;
    formAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  // Client-side validation (mirror of PHP rules)
  function validateForm(data) {
    let valid = true;
    if (!data.nama || data.nama.length < 2) {
      showFieldError('nama', 'Nama minimal 2 karakter.');
      valid = false;
    }
    const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!data.email || !emailRe.test(data.email)) {
      showFieldError('email', 'Format email tidak valid.');
      valid = false;
    }
    if (!data.subjek || data.subjek.length < 3) {
      showFieldError('subjek', 'Subjek minimal 3 karakter.');
      valid = false;
    }
    if (!data.pesan || data.pesan.length < 10) {
      showFieldError('pesan', 'Pesan minimal 10 karakter.');
      valid = false;
    }
    return valid;
  }

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    clearErrors();

    const formData = {
      nama:   document.getElementById('nama').value.trim(),
      email:  document.getElementById('email').value.trim(),
      subjek: document.getElementById('subjek').value.trim(),
      pesan:  document.getElementById('pesan').value.trim(),
    };

    // Client-side validate first
    if (!validateForm(formData)) return;

    setLoading(true);

    // Build FormData for PHP
    const payload = new FormData();
    Object.entries(formData).forEach(([k, v]) => payload.append(k, v));

    // === AJAX REQUEST ===
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'contact.php', true);
    xhr.timeout = 10000;

    xhr.onload = function() {
      setLoading(false);
      if (xhr.status === 200) {
        try {
          const res = JSON.parse(xhr.responseText);
          if (res.success) {
            showAlert('success', res.message);
            form.reset();
          } else {
            // Show server-side field errors
            if (res.errors) {
              Object.entries(res.errors).forEach(([field, msg]) => {
                showFieldError(field, msg);
              });
            }
            showAlert('error', res.message || 'Terjadi kesalahan, coba lagi.');
          }
        } catch {
          showAlert('error', 'Respons server tidak valid. Coba lagi.');
        }
      } else {
        showAlert('error', `Error ${xhr.status}. Coba beberapa saat lagi.`);
      }
    };

    xhr.onerror   = () => { setLoading(false); showAlert('error', 'Koneksi gagal. Periksa koneksi internet Anda.'); };
    xhr.ontimeout = () => { setLoading(false); showAlert('error', 'Request timeout. Coba lagi.'); };

    xhr.send(payload);
  });

  // Clear error on input
  document.querySelectorAll('#contactForm input, #contactForm textarea').forEach(input => {
    input.addEventListener('input', function() {
      this.classList.remove('error');
      const errEl = document.getElementById('err-' + this.id);
      if (errEl) errEl.textContent = '';
    });
  });

  // ==================================================
  // 10. SMOOTH SCROLL for nav links
  // ==================================================
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offsetTop = target.getBoundingClientRect().top + window.scrollY - 80;
        window.scrollTo({ top: offsetTop, behavior: 'smooth' });
      }
    });
  });

  // ==================================================
  // 11. ACTIVE NAV LINK on scroll
  // ==================================================
  const sections = document.querySelectorAll('section[id]');
  const navLinks  = document.querySelectorAll('.nav-link');

  const activeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navLinks.forEach(link => {
          link.style.color = link.getAttribute('href') === '#' + entry.target.id
            ? 'var(--black)' : '';
        });
      }
    });
  }, { rootMargin: '-40% 0px -40% 0px' });

  sections.forEach(s => activeObserver.observe(s));

  console.log('%c🚀 Portfolio loaded — Alex Naufal', 'color:#2B6CB0;font-size:14px;font-weight:bold;');
});
