@php
  $menu = [
    ['label' => 'Beranda', 'route' => 'home'],
    ['label' => 'Produk', 'route' => 'products'],
    ['label' => 'Kelas', 'route' => 'classes.public'],
    ['label' => 'Galeri', 'route' => 'gallery'],
    ['label' => 'Tentang', 'route' => 'about'],
    ['label' => 'Kontak', 'route' => 'contact'],
  ];
@endphp

<header id="main-header" class="sticky top-0 z-50">
  <style>
    :root {
      /* 🎨 Warna navbar hitam dengan aksen emas */
      --glass: linear-gradient(135deg, rgba(30, 30, 30, 0.98), rgba(46, 46, 46, 0.95));
      --border: rgba(254, 218, 96, 0.15);
      --text-primary: #FEDA60;
      --text-secondary: #E2B136;
      --text-white: #ffffff;
      --accent: #FEDA60;
      --accent-strong: #2E2E2E;
      --link-default: #E2B136;
      --nav-shadow: 0 4px 24px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(254, 218, 96, 0.1);
      /* --radius: 18px; */
    }

    /* Header glass wrapper */
    #main-header .glass {
      position: relative;
      background: var(--glass);
      backdrop-filter: blur(14px) saturate(160%);
      -webkit-backdrop-filter: blur(14px) saturate(160%);
      border-bottom: 1px solid var(--border);
      box-shadow: var(--nav-shadow);
      border-radius: var(--radius);
      isolation: isolate;
    }

    /* Brand */
    #main-header .brand-title {
      color: var(--text-primary);
      letter-spacing: 0.08em;
      text-shadow: 0 0 20px rgba(254, 218, 96, 0.3);
    }

    /* Nav links */
    #main-header .nav-link {
      position: relative;
      color: var(--link-default);
      transition: color .2s ease, transform .18s ease;
    }

    #main-header .nav-link:hover {
      color: var(--text-primary);
      transform: translateY(-1px);
    }

    #main-header .nav-link.active {
      color: var(--text-primary);
      text-shadow: 0 0 10px rgba(254, 218, 96, 0.5);
    }

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
      box-shadow: 0 12px 18px rgba(0, 0, 0, 0.18);
      transition: transform .18s ease, box-shadow .18s ease;
    }

    #main-header .btn-sign:hover {
      filter: brightness(.98);
      transform: translateY(-2px);
      box-shadow: 0 18px 28px rgba(0, 0, 0, 0.2);
    }

    /* Mobile menu overlay */
    #main-header .nav-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
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
      background: linear-gradient(180deg, rgba(30, 30, 30, 0.98), rgba(46, 46, 46, 0.95));
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--border);
      border-radius: calc(var(--radius) - 6px);
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5);
    }

    /* Mobile hamburger */
    #main-header .nav-toggle svg {
      transition: transform 0.3s ease;
    }

    #main-header .nav-toggle.is-active svg {
      transform: rotate(45deg);
    }
    
    #main-header .btn-login-gold {
      background: linear-gradient(135deg, #FEDA60, #F5B347);
      color: #2E2E2E;
      border-radius: 14px;
      box-shadow: 0 0 12px rgba(254, 218, 96, 0.55), 
                  0 6px 16px rgba(0, 0, 0, 0.35);
      letter-spacing: 0.5px;
      transition: all .25s ease;
    }

    #main-header .btn-login-gold:hover {
      filter: brightness(1.05);
      transform: scale(1.1);
      box-shadow: 0 0 18px rgba(254, 218, 96, 0.75),
                  0 10px 24px rgba(0, 0, 0, 0.4);
    }

    @media (min-width: 1024px) {
      #main-header .glass {
        margin-top: 0;
      }

      #main-header nav ul {
        gap: 2.5rem;
      }
    }

    @media (max-width: 1023px) {
      #main-header #nav-menu .nav-link::after {
        display: none;
      }
    }
  </style>

  <div class="glass px-6 py-4 lg:px-10 lg:py-5">
    <div class="max-w-7xl mx-auto w-full px-6">
      <!-- Container with 3-column layout for desktop -->
      <div class="flex items-center justify-between lg:grid lg:grid-cols-3 lg:gap-8">
        <!-- Logo - Left -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
          <img src="{{ asset('images/logo/logo.png') }}" alt="Bhakti Nusantara"
            class="h-15 w-15 object-contain drop-shadow-lg">
          <span class="brand-title text-lg font-semibold">Bhakti Nusantara</span>
        </a>

        <!-- Desktop Nav - Center -->
        <nav aria-label="Primary navigation" class="hidden lg:flex justify-center font-medium text-sm relative">
          <!-- Highlight Pill Removed -->

          <ul class="flex items-center gap-2 relative z-10 text-base font-semibold" id="nav-links-container">
            @foreach ($menu as $item)
              <li>
                @if(isset($item['anchor']))
                  <a href="{{ $item['anchor'] }}" class="nav-link">{{ $item['label'] }}</a>
                @else
                  <a href="{{ route($item['route']) }}"
                    class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                    {{ $item['label'] }}
                  </a>
                @endif
              </li>
            @endforeach
          </ul>
        </nav>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const navContainer = document.querySelector('nav[aria-label="Primary navigation"]');
                const highlight = document.getElementById('nav-highlight');
                const links = document.querySelectorAll('#nav-links-container .nav-link');
                const activeLink = document.querySelector('#nav-links-container .nav-link.active');

                function updateHighlight(target) {
                    if (!target) {
                        highlight.style.opacity = '0';
                        return;
                    }
                    
                    const rect = target.getBoundingClientRect();
                    const navRect = navContainer.getBoundingClientRect();
                    
                    highlight.style.width = `${rect.width}px`;
                    highlight.style.height = `${rect.height}px`;
                    highlight.style.transform = `translate(${rect.left - navRect.left}px, ${rect.top - navRect.top}px)`;
                    highlight.style.opacity = '1';
                }

                if (activeLink) {
                    // Initial position without transition
                    const rect = activeLink.getBoundingClientRect();
                    const navRect = navContainer.getBoundingClientRect();
                    highlight.style.width = `${rect.width}px`;
                    highlight.style.height = `${rect.height}px`;
                    highlight.style.transform = `translate(${rect.left - navRect.left}px, ${rect.top - navRect.top}px)`;
                    highlight.style.opacity = '1';
                    
                    // Force reflow to apply initial position immediately
                    highlight.offsetHeight; 
                }

                links.forEach(link => {
                    link.addEventListener('mouseenter', (e) => updateHighlight(e.target));
                });

                navContainer.addEventListener('mouseleave', () => {
                    if (activeLink) {
                        updateHighlight(activeLink);
                    } else {
                        highlight.style.opacity = '0';
                    }
                });
            });
        </script>

        <!-- User menu untuk yang sudah login -->
        @auth
          <div class="hidden lg:flex items-center justify-end gap-4 font-medium text-lg">
            <div class="relative group">
              <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition-all">
                @if(auth()->user()->profile_picture)
                  <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}"
                    class="w-8 h-8 rounded-full object-cover">
                @else
                  <div
                    class="w-8 h-8 rounded-full bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center text-[#2E2E2E] font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                  </div>
                @endif
                <span class="text-sm text-[#FEDA60] font-bold">{{ auth()->user()->name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="w-4 h-4 text-[#FEDA60] group-hover:rotate-180 transition-transform">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </button>

              <!-- dropdown menu -->
              <div
                class="absolute right-0 top-full mt-2 w-56 rounded-2xl bg-[#1E1E1E] border border-[#FEDA60]/20 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <div class="p-3 border-b border-[#FEDA60]/20">
                  <p class="text-xs text-gray-400 uppercase tracking-wider">Akun</p>
                  <p class="text-sm text-white font-semibold">{{ auth()->user()->name }}</p>
                  <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                </div>
                <div class="p-2">
                  @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                      class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#FEDA60]/10 text-[#FEDA60]' : '' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                      </svg>
                      Dashboard Admin
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                      class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 " viewBox="0 0 24 24"><path fill="#ffffff" d="M12 4a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7ZM6.5 7.5a5.5 5.5 0 1 1 11 0a5.5 5.5 0 0 1-11 0ZM3 19a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v3H3v-3Zm5-3a3 3 0 0 0-3 3v1h14v-1a3 3 0 0 0-3-3H8Z"/></svg>
                      Kelola User
                    </a>
                    <a href="{{ route('products.index') }}"
                      class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                      </svg>
                      Kelola Produk
                    </a>
                    <a href="{{ route('classes.index') }}"
                      class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                      </svg>
                      Kelola Kelas
                    </a>
                    <a href="{{ route('admin.gallery.carousel.index') }}"
                      class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                      </svg>
                      Kelola Galeri
                    </a>
                        <a href="{{ route('admin.dispensations.index') }}"
                          class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all {{ request()->routeIs('admin.dispensations.*') ? 'bg-[#FEDA60]/10 text-[#FEDA60]' : '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v9a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 16.5v-9zM7.5 8.25h9M7.5 12h9M7.5 15.75h4.5" />
                          </svg>
                          Kelola Surat
                        </a>
                        <a href="{{ route('admin.dashboard') }}#homepage-texts" 
                          class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5v15m6-15v15m-11.581.313c.498.492 1.173.922 2.026 1.176.855.254 1.747.247 2.654-.02l6.501-2.335c.92-.33 1.539-1.152 1.539-2.076V6.75c0-.933-.619-1.745-1.539-2.076L7.097 2.171c-.907-.266-1.799-.273-2.654.02-.852.254-1.528.684-2.026 1.176" />
                          </svg>
                          Kelola Homepage
                        </a>
                  @else
                    <a href="{{ route('user.dashboard') }}"
                      class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all {{ request()->routeIs('user.dashboard') ? 'bg-[#FEDA60]/10 text-[#FEDA60]' : '' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                      </svg>
                      Dashboard Saya
                    </a>
                  @endif
                </div>
                <div class="p-2 border-t border-[#FEDA60]/20">
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                      class="flex items-center gap-3 w-full px-3 py-2 rounded-xl text-sm text-gray-300 hover:bg-red-500/10 hover:text-red-400 transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                      </svg>
                      Logout
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endauth
        
        @guest
          <div class="hidden lg:flex items-center justify-end">
            <a href="{{ route('login') }}"
              class="btn-login-gold px-6 py-2.5 text-sm font-semibold rounded-xl transition-all">
              <span>Login</span>
            </a>
          </div>
        @endguest


        <!-- Mobile toggle -->
        <button id="nav-toggle"
          class="nav-toggle lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-2xl btn-sign"
          aria-label="Toggle navigation" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-black">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div id="nav-overlay" class="nav-overlay hidden lg:hidden" aria-hidden="true"></div>

  <!-- Mobile Nav -->
  <div class="hidden lg:hidden" id="nav-menu" aria-hidden="true">
    <div class="mobile-surface mx-4 px-6 py-5 flex flex-col gap-3 text-sm font-medium">
      @foreach ($menu as $item)
        @if(isset($item['anchor']))
          <a href="{{ $item['anchor'] }}" class="py-2 border-b border-[#FEDA60]/20 nav-link">{{ $item['label'] }}</a>
        @else
          <a href="{{ route($item['route']) }}"
            class="py-2 border-b border-[#FEDA60]/20 nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
            {{ $item['label'] }}
          </a>
        @endif
      @endforeach
      
      @guest
        <a href="{{ route('login') }}"
          class="py-3 px-4 rounded-2xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] text-center font-bold shadow-lg mb-2">
          Login
        </a>
      @endguest

      @auth
        <div class="py-2 border-b border-[#FEDA60]/20 text-[#FEDA60] font-medium">Hai, {{ auth()->user()->name }}</div>
        @if(auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}"
            class="py-3 px-4 rounded-2xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] text-center font-bold shadow-lg flex items-center justify-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'ring-2 ring-[#FEDA60]' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
              class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            Dashboard Admin
          </a>
          <a href="{{ route('products.index') }}"
            class="py-2 border-b border-[#FEDA60]/20 nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Kelola
            Produk</a>
          <a href="{{ route('classes.index') }}"
            class="py-2 border-b border-[#FEDA60]/20 nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">Kelola
            Kelas</a>
          <a href="{{ route('admin.dispensations.index') }}"
            class="py-2 border-b border-[#FEDA60]/20 nav-link {{ request()->routeIs('admin.dispensations.*') ? 'active' : '' }}">Kelola
            Surat</a>
          <a href="{{ route('admin.dashboard') }}#homepage-texts"
            class="py-2 border-b border-[#FEDA60]/20 nav-link">Kelola Homepage</a>
        @else
          <a href="{{ route('user.dashboard') }}"
            class="py-3 px-4 rounded-2xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] text-center font-bold shadow-lg flex items-center justify-center gap-2 {{ request()->routeIs('user.dashboard') ? 'ring-2 ring-[#FEDA60]' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
              class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            Dashboard Saya
          </a>
        @endif
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full mt-2 px-4 py-2 btn-sign text-center text-sm font-semibold">Logout</button>
        </form>
      @endauth
    </div>
  </div>

  <script>
    (function () {
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
