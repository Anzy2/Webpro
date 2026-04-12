<nav class="navbar" id="navbar">
  <div class="nav-inner">
    <a href="{{ route('home') }}#hero" class="nav-logo">TFN<span>.</span></a>
    <ul class="nav-links">
      <li><a href="#about"     class="nav-link">Tentang</a></li>
      <li><a href="#skills"    class="nav-link">Skill</a></li>
      <li><a href="#portfolio" class="nav-link">Portofolio</a></li>
      <li><a href="#contact"   class="nav-link">Kontak</a></li>
    </ul>
    <a href="{{ asset('assets/cv/cv-Titanio Francy Naddiansa.pdf') }}"
       download
       class="btn btn-outline nav-cv">
      <i data-feather="download" class="btn-icon"></i> Download CV
    </a>
    <button class="hamburger" id="hamburger" aria-label="menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
