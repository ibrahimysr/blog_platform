<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Blog')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('asset/logo.jpeg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('meta')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        @font-face {
            font-family: 'Glaser Stencil';
            src: url('{{ asset("fonts/glaser-stencil.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .glaser-font {
            font-family: 'Glaser Stencil', sans-serif;
            letter-spacing: 0.1em;
        }
        
        body {
            background: #ffffff;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before { content: none; }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #1877F2, #42A5F5);
            transform: translateX(-50%);
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 3px;
        }
        
        .nav-link:hover::before {
            width: 100%;
        }
        
        .nav-link:hover {
            transform: translateY(-2px);
            color: #1877F2;
        }
        
        .logo-glow {
            animation: glow 3s ease-in-out infinite;
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(24, 119, 242, 0.5); }
            50% { box-shadow: 0 0 30px rgba(24, 119, 242, 0.8), 0 0 40px rgba(66, 165, 245, 0.6); }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #1877F2 0%, #42A5F5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1877F2 0%, #42A5F5 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(24, 119, 242, 0.4);
        }
        
        .dropdown-menu {
            animation: slideDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .alert-show {
            animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .avatar-ring {
            position: relative;
        }
        
        .avatar-ring::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1877F2, #42A5F5);
            z-index: -1;
            animation: rotate 3s linear infinite;
        }
        
        @keyframes rotate {
            100% { transform: rotate(360deg); }
        }
        
        .footer-gradient {
            background: linear-gradient(135deg, #1e1e2e 0%, #2d2d44 100%);
            position: relative;
        }
        
        .footer-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #1877F2, #42A5F5, transparent);
        }
        
        .social-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
            filter: drop-shadow(0 5px 15px rgba(24, 119, 242, 0.5));
        }
        
        .mobile-menu-slide {
            animation: slideInLeft 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .input-modern {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .input-modern:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(24, 119, 242, 0.2);
        }
        
        /* Hero Slider Styles */
        .hero-slider-container {
            position: relative;
            overflow: hidden;
        }
        
        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-image: var(--desktop-bg);
            display: block;
            text-decoration: none;
            cursor: pointer;
        }
        
        .hero-slide.active {
            opacity: 1;
        }
        
        .hero-slide:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease-in-out;
        }
        
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .slider-dot.active {
            background-color: white;
            transform: scale(1.2);
        }
        
        .slider-dot:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        /* Mobile responsive background images */
        @media (max-width: 768px) {
            .hero-slide {
                background-image: var(--mobile-bg);
            }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header / Navigation -->
    <header class="glass-effect sticky top-0 z-50 content-wrapper">
        <nav class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 rounded-2xl overflow-hidden transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <img src="{{ asset('asset/logo.jpeg') }}" alt="TÜRKAB Logo" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-black text-black glaser-font">DETA</span>
                        <span class="text-xs font-semibold text-gray-600 hidden lg:block leading-tight">Dijital Demokrasi Toplum ve Araştırma Merkezi</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-10">
                    <a href="/" class="nav-link text-gray-700 hover:text-blue-600 font-semibold text-sm tracking-wide">ANA SAYFA</a>
                    <a href="{{ route('posts.list') }}" class="nav-link text-gray-700 hover:text-blue-600 font-semibold text-sm tracking-wide">BLOGLAR</a>
                    <a href="{{ route('galleries.index') }}" class="nav-link text-gray-700 hover:text-blue-600 font-semibold text-sm tracking-wide">GALERİ</a>
                    <a href="{{ route('events.list') }}" class="nav-link text-gray-700 hover:text-blue-600 font-semibold text-sm tracking-wide">ETKİNLİKLER</a>
                    
                    <!-- Hakkımızda Dropdown -->
                    <div class="relative dropdown">
                        <button id="about-menu-btn" class="nav-link text-gray-700 hover:text-blue-600 font-semibold text-sm tracking-wide flex items-center">
                            HAKKIMIZDA
                            <svg class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="about-menu" class="dropdown-menu hidden absolute left-0 mt-4 w-64 glass-effect rounded-2xl shadow-2xl py-2 border border-white/20 overflow-hidden">
                            <a href="{{ route('about.index') }}" class="flex items-center space-x-3 px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium">Biz Kimiz?</span>
                            </a>
                            <a href="{{ route('about.member') }}" class="flex items-center space-x-3 px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="font-medium">Türkab Üyesi Kimdir?</span>
                            </a>
                            <a href="{{ route('about.representatives') }}" class="flex items-center space-x-3 px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-medium">Temsilciliklerimiz</span>
                            </a>
                            <a href="{{ route('about.why-founded') }}" class="flex items-center space-x-3 px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                <span class="font-medium">Neden Kurulduk?</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Menu / Auth -->
                <div class="hidden md:flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-sm tracking-wide transition-all">
                            GİRİŞ YAP
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-white px-6 py-3 rounded-xl font-bold text-sm tracking-wide shadow-lg">
                            KAYIT OL
                        </a>
                    @else
                        <div class="relative dropdown">
                            <button id="user-menu-btn" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 transition-all">
                                <div class="avatar-ring w-11 h-11 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="font-semibold text-sm">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="user-menu" class="dropdown-menu hidden absolute right-0 mt-4 w-56 glass-effect rounded-2xl shadow-2xl py-2 border border-white/20 overflow-hidden">
                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="font-medium">Profilim</span>
                                </a>
                                
                                <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center space-x-3 px-5 py-3 text-red-600 hover:bg-red-50 transition-all w-full">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span class="font-semibold">Çıkış Yap</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-all">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-6 mobile-menu-slide">
                <div class="flex flex-col space-y-2 mt-4">
                    <a href="/" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-3 px-4 rounded-lg font-semibold text-sm transition-all">Ana Sayfa</a>
                    <a href="{{ route('posts.list') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-3 px-4 rounded-lg font-semibold text-sm transition-all">Bloglar</a>
                    <a href="{{ route('galleries.index') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-3 px-4 rounded-lg font-semibold text-sm transition-all">Galeri</a>
                    <a href="{{ route('events.list') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-3 px-4 rounded-lg font-semibold text-sm transition-all">Etkinlikler</a>
                    
                    <!-- Mobile Hakkımızda Section -->
                    <div class="border-t border-gray-200 my-2"></div>
                    <div class="text-gray-500 text-xs font-bold uppercase tracking-wide px-4 py-2">Hakkımızda</div>
                    <a href="{{ route('about.index') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-2 px-6 rounded-lg font-medium text-sm transition-all">Biz Kimiz?</a>
                    <a href="{{ route('about.member') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-2 px-6 rounded-lg font-medium text-sm transition-all">Türkab Üyesi Kimdir?</a>
                    <a href="{{ route('about.representatives') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-2 px-6 rounded-lg font-medium text-sm transition-all">Temsilciliklerimiz</a>
                    <a href="{{ route('about.why-founded') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-2 px-6 rounded-lg font-medium text-sm transition-all">Neden Kurulduk?</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-3 px-4 rounded-lg font-semibold text-sm transition-all">Giriş Yap</a>
                        <a href="{{ route('register') }}" class="btn-primary text-white px-4 py-3 rounded-lg text-center font-bold text-sm">Kayıt Ol</a>
                    @else
                        <div class="flex items-center space-x-3 py-3 px-4">
                            <div class="avatar-ring w-8 h-8 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="font-semibold text-sm text-gray-700">{{ Auth::user()->name }}</span>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 py-3 px-4 rounded-lg font-semibold text-sm transition-all">Profilim</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:bg-red-50 py-3 px-4 rounded-lg w-full text-left font-semibold text-sm transition-all">Çıkış Yap</button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- Alert Messages -->
    @if (session('status'))
        <div class="container mx-auto px-4 lg:px-8 mt-6 content-wrapper">
            <div class="alert-show glass-effect border-l-4 border-green-500 px-6 py-4 rounded-2xl shadow-xl flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-gray-800 font-medium">{{ session('status') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-500 hover:text-gray-700 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mx-auto px-4 lg:px-8 mt-6 content-wrapper">
            <div class="alert-show glass-effect border-l-4 border-red-500 px-6 py-4 rounded-2xl shadow-xl flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-gray-800 font-medium">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-500 hover:text-gray-700 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 lg:px-8 py-12 content-wrapper">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-gradient mt-auto content-wrapper">
        <div class="container mx-auto px-4 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6 floating">
                        <div class="w-12 h-12 rounded-2xl overflow-hidden">
                            <img src="{{ asset('asset/logo.jpeg') }}" alt="TÜRKAB Logo" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-white glaser-font">Deta</span>
                            <span class="text-xs font-semibold text-gray-300 hidden lg:block leading-tight">Dijital Demokrasi Toplum ve Araştırma Merkezi</span>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed text-lg">TÜRKAB'ın resmi blog platformu. Kardeşlik bilincini yayan, milli ve manevi değerleri paylaşan içeriklerle topluluğumuzla bağlantı kurun.</p>
                    <div class="flex space-x-5">
                        <a href="#" class="social-icon w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="social-icon w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="social-icon w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 16.892c-2.102.144-6.784.144-8.883 0C5.282 16.736 5.017 15.622 5 12c.017-3.629.285-4.736 2.558-4.892 2.099-.144 6.782-.144 8.883 0C18.718 7.264 18.982 8.378 19 12c-.018 3.629-.285 4.736-2.559 4.892zM10 9.658l4.917 2.338L10 14.342V9.658z"/></svg>
                        </a>
                        <a href="#" class="social-icon w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-white mb-6 text-lg tracking-wide">HIZLI LİNKLER</h3>
                    <ul class="space-y-3">
                        <li><a href="/" class="text-gray-300 hover:text-white transition-all hover:translate-x-2 inline-block">Ana Sayfa</a></li>
                        <li><a href="{{ route('about.index') }}" class="text-gray-300 hover:text-white transition-all hover:translate-x-2 inline-block">Hakkımızda</a></li>
                        <li><a href="{{ route('about.member') }}" class="text-gray-300 hover:text-white transition-all hover:translate-x-2 inline-block">Türkab Üyesi Kimdir?</a></li>
                        <li><a href="{{ route('about.representatives') }}" class="text-gray-300 hover:text-white transition-all hover:translate-x-2 inline-block">Temsilciliklerimiz</a></li>
                        <li><a href="{{ route('about.why-founded') }}" class="text-gray-300 hover:text-white transition-all hover:translate-x-2 inline-block">Neden Kurulduk?</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="font-bold text-white mb-6 text-lg tracking-wide">BÜLTEN</h3>
                    <p class="text-gray-300 text-sm mb-6 leading-relaxed">TÜRKAB'ın güncel haberlerinden ve etkinliklerinden haberdar olmak için abone olun.</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Email adresiniz" class="input-modern w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent backdrop-blur-sm">
                        <button type="submit" class="btn-primary w-full text-white px-4 py-3 rounded-xl font-bold text-sm tracking-wide shadow-lg">
                            ABONE OL
                        </button>
                    </form>
                </div>
            </div>


         
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert-show');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s, transform 0.5s';
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(100px)';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // User dropdown: click-to-toggle and click-outside to close
        (function(){
            const btn = document.getElementById('user-menu-btn');
            const menu = document.getElementById('user-menu');
            if (!btn || !menu) return;
            btn.addEventListener('click', function(e){
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
            menu.addEventListener('click', function(e){
                e.stopPropagation();
            });
            document.addEventListener('click', function(){
                if (!menu.classList.contains('hidden')) menu.classList.add('hidden');
            });
        })();

        // About dropdown: click-to-toggle and click-outside to close
        (function(){
            const btn = document.getElementById('about-menu-btn');
            const menu = document.getElementById('about-menu');
            if (!btn || !menu) return;
            btn.addEventListener('click', function(e){
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
            menu.addEventListener('click', function(e){
                e.stopPropagation();
            });
            document.addEventListener('click', function(){
                if (!menu.classList.contains('hidden')) menu.classList.add('hidden');
            });
        })();

        // Hero Slider JavaScript
        (function() {
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.querySelector('.slider-prev');
            const nextBtn = document.querySelector('.slider-next');
            
            if (slides.length === 0) return;
            
            // Set CSS variables for responsive background images
            slides.forEach(slide => {
                const desktopImg = slide.dataset.desktop;
                const mobileImg = slide.dataset.mobile;
                
                if (desktopImg) {
                    slide.style.setProperty('--desktop-bg', `url('${desktopImg}')`);
                }
                if (mobileImg) {
                    slide.style.setProperty('--mobile-bg', `url('${mobileImg}')`);
                }
            });
            
            let currentSlide = 0;
            let slideInterval;
            
            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                });
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
                currentSlide = index;
            }
            
            function nextSlide() {
                const next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }
            
            function prevSlide() {
                const prev = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(prev);
            }
            
            function startSlider() {
                slideInterval = setInterval(nextSlide, 5000); // 5 saniyede bir değişir
            }
            
            function stopSlider() {
                clearInterval(slideInterval);
            }
            
            // Event listeners
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    stopSlider();
                    nextSlide();
                    startSlider();
                });
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    stopSlider();
                    prevSlide();
                    startSlider();
                });
            }
            
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopSlider();
                    showSlide(index);
                    startSlider();
                });
            });
            
            // Pause on hover
            const sliderContainer = document.querySelector('.hero-slider-container');
            if (sliderContainer) {
                sliderContainer.addEventListener('mouseenter', stopSlider);
                sliderContainer.addEventListener('mouseleave', startSlider);
            }
            
            // Start slider
            startSlider();
        })();
    </script>
</body>
</html>