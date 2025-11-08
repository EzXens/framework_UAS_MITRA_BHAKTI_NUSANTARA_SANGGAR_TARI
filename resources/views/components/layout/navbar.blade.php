@php
    $menu = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Tentang', 'route' => 'about'],
        ['label' => 'Produk', 'route' => 'products'],
        ['label' => 'Galeri', 'route' => 'gallery'],
    ];
@endphp

<header id="main-header" class="sticky top-0 z-50">
  <style>
    :root{
      /* 🌈 Warna kaca gradasi emas → hijau muda */
      --glass: linear-gradient(120deg, rgba(254, 218, 96, 0.58), rgba(195, 203, 184, 0.72));
      --border: rgba(255,255,255,0.12);
      --text-primary: #ffffff;
      --text-muted: rgba(46,46,46,0.75);
      --accent: #FEDA60;
      --accent-strong: #2E2E2E;
      --link-default: #463b1b;
      --nav-shadow: 0 18px 36px rgba(0,0,0,0.25);
      /* --radius: 18px; */
    }

    /* Header glass wrapper */
    #main-header .glass {
      position: relative;
      background: var(--glass);
      backdrop-filter: blur(14px) saturate(160%);
      -webkit-backdrop-filter: blur(14px) saturate(160%);
      border: 1px solid var(--border);
      box-shadow: var(--nav-shadow);
      border-radius: var(--radius);
      isolation: isolate;
    }

    /* Brand */
    #main-header .brand-title { 
      color: var(--text-primary);
      letter-spacing: 0.08em;
    }

    /* Nav links */
    #main-header .nav-link {
      position: relative;
      color: var(--link-default);
      transition: color .2s ease, transform .18s ease;
    }
    #main-header .nav-link:hover { 
      color: var(--accent);
      transform: translateY(-1px);
    }
    #main-header .nav-link.active { color: var(--text-primary); }

    #main-header .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -0.65rem;
      width: 100%;
      height: 3px;
      border-radius: 999px;
      background: var(--accent);
      transform: scale3d(0, 1, 1);
      transform-origin: center;
      transition: transform .22s ease;
      opacity: 0.95;
    }
    #main-header .nav-link:hover::after,
    #main-header .nav-link.active::after {
      transform: scale3d(1, 1, 1);
    }

    /* Sign-in button */
    #main-header .btn-sign {
      background-color: var(--accent);
      color: var(--accent-strong);
      border-radius: 15px;
      box-shadow: 0 12px 18px rgba(0,0,0,0.18);
      transition: transform .18s ease, box-shadow .18s ease;
    }
    #main-header .btn-sign:hover { 
      filter: brightness(.98);
      transform: translateY(-2px);
      box-shadow: 0 18px 28px rgba(0,0,0,0.2);
    }

    /* Mobile menu overlay */
    #main-header .nav-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.55);
      backdrop-filter: blur(2px);
      -webkit-backdrop-filter: blur(2px);
      opacity: 0;
      transition: opacity .24s ease;
      pointer-events: none;
      z-index: -1;
    }
    #main-header .nav-overlay.active {
      opacity: 1;
      pointer-events: auto;
      z-index: 40;
    }

    /* Mobile nav menu */
    #main-header #nav-menu {
      position: absolute;
      top: calc(100% + 0.75rem);
      left: 0;
      right: 0;
      transform: translateY(-8px);
      opacity: 0;
      pointer-events: none;
      transition: transform .24s ease, opacity .24s ease;
      z-index: 50;
    }
    #main-header #nav-menu.active {
      transform: translateY(0);
      opacity: 1;
      pointer-events: auto;
    }

    #main-header #nav-menu .mobile-surface {
      background: linear-gradient(180deg, rgba(254, 218, 96, 0.85), rgba(195, 203, 184, 0.78));
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--border);
      border-radius: calc(var(--radius) - 6px);
      box-shadow: 0 16px 40px rgba(0,0,0,0.25);
    }

    /* Mobile hamburger */
    #main-header .nav-toggle-line {
      display: block;
      width: 20px;
      height: 2px;
      margin: 4px auto;
      background: var(--accent-strong);
      border-radius: 999px;
      transition: transform .2s ease, opacity .2s ease;
    }

    #main-header .nav-toggle.is-active .nav-toggle-line:nth-child(1) {
      transform: translateY(6px) rotate(45deg);
    }
    #main-header .nav-toggle.is-active .nav-toggle-line:nth-child(2) {
      opacity: 0;
    }
    #main-header .nav-toggle.is-active .nav-toggle-line:nth-child(3) {
      transform: translateY(-6px) rotate(-45deg);
    }

    @media (min-width: 1024px) {
      #main-header .glass { margin-top: 0; }
      #main-header nav ul { gap: 2.5rem; }
    }
    @media (max-width: 1023px) {
      #main-header #nav-menu .nav-link::after { display: none; }
    }
  </style>

  <div class="glass  px-6 lg:px-10  lg:py-5 flex items-center justify-between ">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
          <img src="{{ asset('images/logo/logo.png') }}" alt="Bhakti Nusantara" class="h-12 w-12 object-contain drop-shadow-lg">
          <span class="brand-title text-lg font-semibold">Bhakti Nusantara</span>
      </a>

      <!-- Mobile toggle -->
      <button id="nav-toggle" class="nav-toggle lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-full btn-sign" aria-label="Toggle navigation" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="nav-toggle-line"></span>
          <span class="nav-toggle-line"></span>
          <span class="nav-toggle-line"></span>
      </button>

      <!-- Desktop Nav -->
      <div class="hidden lg:flex items-center gap-12 font-medium text-sm">
          <nav aria-label="Primary navigation">
              <ul class="flex items-center gap-8">
                  @foreach ($menu as $item)
                      <li>
                          <a href="{{ route($item['route']) }}"
                             class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                              {{ $item['label'] }}
                          </a>
                      </li>
                  @endforeach
              </ul>
          </nav>

          <a href="{{ route('login') }}" class="px-6 py-2.5 btn-sign text-sm font-semibold">Sign In</a>
      </div>
  </div>

  <div id="nav-overlay" class="nav-overlay hidden lg:hidden" aria-hidden="true"></div>

  <!-- Mobile Nav -->
  <div class="hidden lg:hidden" id="nav-menu" aria-hidden="true">
      <div class="mobile-surface mx-4 px-6 py-5 flex flex-col gap-3 text-sm font-medium">
          @foreach ($menu as $item)
              <a href="{{ route($item['route']) }}" class="py-2 border-b border-black/10 nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                  {{ $item['label'] }}
              </a>
          @endforeach
          <a href="{{ route('login') }}" class="mt-2 px-4 py-2 btn-sign text-center text-sm font-semibold">Sign In</a>
      </div>
  </div>

  <script>
    (function(){
      const btn = document.getElementById('nav-toggle');
      const menu = document.getElementById('nav-menu');
      const overlay = document.getElementById('nav-overlay');
      const ANIMATION_DELAY = 240;
      let closingTimeout;

      if (!btn || !menu) return;

      const openMenu = () => {
        if (closingTimeout) {
          clearTimeout(closingTimeout);
          closingTimeout = undefined;
        }
        menu.classList.remove('hidden');
        overlay && overlay.classList.remove('hidden');
        requestAnimationFrame(() => {
          menu.classList.add('active');
          btn.classList.add('is-active');
          overlay && overlay.classList.add('active');
        });
        btn.setAttribute('aria-expanded', 'true');
        menu.setAttribute('aria-hidden', 'false');
        overlay && overlay.setAttribute('aria-hidden', 'false');
      };

      const closeMenu = (immediate = false) => {
        if (closingTimeout) {
          clearTimeout(closingTimeout);
          closingTimeout = undefined;
        }
        menu.classList.remove('active');
        btn.classList.remove('is-active');
        overlay && overlay.classList.remove('active');

        const finish = () => {
          menu.classList.add('hidden');
          overlay && overlay.classList.add('hidden');
        };

        if (immediate) finish();
        else closingTimeout = setTimeout(() => { finish(); closingTimeout = undefined; }, ANIMATION_DELAY);

        btn.setAttribute('aria-expanded', 'false');
        menu.setAttribute('aria-hidden', 'true');
        overlay && overlay.setAttribute('aria-hidden', 'true');
      };

      btn.addEventListener('click', () => {
        if (menu.classList.contains('hidden')) openMenu();
        else closeMenu();
      });

      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !menu.classList.contains('hidden')) closeMenu();
      });

      overlay && overlay.addEventListener('click', () => closeMenu());

      window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024 && !menu.classList.contains('hidden')) closeMenu(true);
      });
    })();
  </script>
</header>
