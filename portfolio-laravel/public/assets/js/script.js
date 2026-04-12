/**
 * script.js — Portfolio Interactive Logic (Laravel Edition)
 * Perubahan dari versi PHP native:
 *  - AJAX POST ke route('/contact') dengan X-CSRF-TOKEN header
 *  - projectData dibaca dari window.projectData (di-inject Blade)
 *  - Error handling response Laravel ValidationException (422)
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

  function animateCursor() {
    followerX += (mouseX - followerX) * 0.12;
    followerY += (mouseY - followerY) * 0.12;
    follower.style.left = followerX + 'px';
    follower.style.top  = followerY + 'px';
    requestAnimationFrame(animateCursor);
  }
  animateCursor();

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
  // 4. SCROLL REVEAL
  // ==================================================
  const revealEls = document.querySelectorAll('[data-reveal]');

  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const delay = entry.target.dataset.delay || 0;
        setTimeout(() => {
          entry.target.classList.add('revealed');
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
    bar.style.width = bar.dataset.width + '%';
  }

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
      const step   = target / (1800 / 16);
      let current  = 0;
      const interval = setInterval(() => {
        current += step;
        if (current >= target) { current = target; clearInterval(interval); }
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
  const filterBtns     = document.querySelectorAll('.filter-btn');
  const portfolioCards = document.querySelectorAll('.portfolio-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.dataset.filter;
      portfolioCards.forEach(card => {
        const match = filter === 'all' || card.dataset.category === filter;
        card.classList.toggle('hidden', !match);
      });
    });
  });

  // ==================================================
  // 8. PROJECT MODAL
  // (Data dari window.projectData yang di-inject Blade)
  // ==================================================
  const modal         = document.getElementById('projectModal');
  const modalContent  = document.getElementById('modalContent');
  const modalClose    = document.getElementById('modalClose');
  const modalBackdrop = document.getElementById('modalBackdrop');

  window.openProject = function(id) {
    const p = (window.projectData || {})[id];
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
        <button class="btn btn-primary" onclick="closeProject()"><span>Tutup</span></button>
      </div>
    `;

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
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeProject(); });

  // ==================================================
  // 9. AJAX CONTACT FORM — Laravel Edition
  // Menggunakan Fetch API + X-CSRF-TOKEN dari meta tag
  // ==================================================
  const form      = document.getElementById('contactForm');
  const formAlert = document.getElementById('formAlert');
  const submitBtn = document.getElementById('submitBtn');
  const btnText   = document.getElementById('btnText');
  const btnIcon   = document.getElementById('btnIcon');
  const btnLoader = document.getElementById('btnLoader');

  // Ambil CSRF token dari meta tag (di-inject oleh Blade layout)
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

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

  // Client-side validation (cermin aturan Laravel)
  function validateForm(data) {
    let valid = true;
    if (!data.nama || data.nama.length < 2)   { showFieldError('nama',   'Nama minimal 2 karakter.'); valid = false; }
    if (!data.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email)) { showFieldError('email', 'Format email tidak valid.'); valid = false; }
    if (!data.subjek || data.subjek.length < 3) { showFieldError('subjek', 'Subjek minimal 3 karakter.'); valid = false; }
    if (!data.pesan || data.pesan.length < 10)  { showFieldError('pesan',  'Pesan minimal 10 karakter.'); valid = false; }
    return valid;
  }

  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors();

    const formData = {
      nama:   document.getElementById('nama').value.trim(),
      email:  document.getElementById('email').value.trim(),
      subjek: document.getElementById('subjek').value.trim(),
      pesan:  document.getElementById('pesan').value.trim(),
    };

    if (!validateForm(formData)) return;

    setLoading(true);

    try {
      const response = await fetch('/contact', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept':        'application/json',
          'X-CSRF-TOKEN':  csrfToken,          // ← wajib untuk Laravel
        },
        body: JSON.stringify(formData),
      });

      const res = await response.json();

      if (response.ok && res.success) {
        // ---- Sukses ----
        showAlert('success', res.message);
        form.reset();

      } else if (response.status === 422) {
        // ---- Laravel ValidationException → tampilkan per-field ----
        const errs = res.errors || {};
        Object.entries(errs).forEach(([field, messages]) => {
          showFieldError(field, Array.isArray(messages) ? messages[0] : messages);
        });
        showAlert('error', res.message || 'Mohon periksa kembali isian form.');

      } else {
        // ---- Error lainnya ----
        showAlert('error', res.message || `Error ${response.status}. Coba lagi.`);
      }

    } catch (err) {
      showAlert('error', 'Koneksi gagal. Periksa koneksi internet Anda.');
      console.error('Contact form error:', err);
    } finally {
      setLoading(false);
    }
  });

  // Hapus error saat user mengetik ulang
  document.querySelectorAll('#contactForm input, #contactForm textarea').forEach(input => {
    input.addEventListener('input', function() {
      this.classList.remove('error');
      const errEl = document.getElementById('err-' + this.id);
      if (errEl) errEl.textContent = '';
    });
  });

  // ==================================================
  // 10. SMOOTH SCROLL
  // ==================================================
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        window.scrollTo({
          top: target.getBoundingClientRect().top + window.scrollY - 80,
          behavior: 'smooth'
        });
      }
    });
  });

  // ==================================================
  // 11. ACTIVE NAV LINK ON SCROLL
  // ==================================================
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');

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

  console.log('%c🚀 Portfolio loaded — Titanio Francy Naddiansa (Laravel)', 'color:#2B6CB0;font-size:14px;font-weight:bold;');
});
