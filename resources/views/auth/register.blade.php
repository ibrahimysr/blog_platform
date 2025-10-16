@extends('layouts.app')

@section('title', 'Kayıt Ol')

@section('content')
<div class="min-h-[calc(100vh-20rem)] flex items-center justify-center py-12">
    <div class="w-full max-w-md">
        <!-- Register Card -->
        <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden border border-white/20">
            <!-- Header -->
            <div class="bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-600 px-8 py-10 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-3xl flex items-center justify-center mx-auto mb-4 logo-glow">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-black text-white mb-2 tracking-tight">Aramıza Katılın!</h1>
                    <p class="text-white/90 font-medium">Yeni hesap oluşturun</p>
                </div>
            </div>

            <!-- Form -->
            <div class="px-8 py-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 px-5 py-4 rounded-xl flex items-start space-x-3 animate-pulse">
                        <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-red-800 font-medium text-sm">{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Name Input -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wide">AD SOYAD</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required
                                class="input-modern w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-300"
                                placeholder="Ahmet Yılmaz"
                            />
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wide">E-POSTA ADRESİ</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required
                                class="input-modern w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-300"
                                placeholder="ornek@email.com"
                            />
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wide">ŞİFRE</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                required
                                class="input-modern w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-300"
                                placeholder="En az 8 karakter"
                            />
                        </div>
                        <p class="text-xs text-gray-500 pl-1">Şifreniz en az 8 karakter içermelidir</p>
                    </div>

                    <!-- Password Confirmation Input -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wide">ŞİFRE (TEKRAR)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                required
                                class="input-modern w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-300"
                                placeholder="Şifrenizi tekrar girin"
                            />
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="pt-2">
                        <label class="flex items-start space-x-3 cursor-pointer group">
                            <input type="checkbox" required class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 focus:ring-2 transition-all mt-0.5 flex-shrink-0">
                            <span class="text-sm text-gray-600 leading-relaxed">
                                <a href="#" class="text-purple-600 font-semibold hover:underline">Kullanım Şartları</a> ve 
                                <a href="#" class="text-purple-600 font-semibold hover:underline">Gizlilik Politikası</a>'nı okudum ve kabul ediyorum.
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary w-full text-white px-6 py-4 rounded-xl font-bold text-base tracking-wide shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center justify-center space-x-2 mt-6">
                        <span>HESAP OLUŞTUR</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t-2 border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 font-semibold">VEYA</span>
                    </div>
                </div>

            

                <!-- Login Link -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600 font-medium">
                        Zaten hesabınız var mı? 
                        <a href="{{ route('login') }}" class="text-purple-600 font-bold hover:text-purple-700 transition-colors hover:underline">
                            Giriş Yapın
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="mt-8 grid grid-cols-3 gap-4">
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-gray-600">Güvenli</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-gray-600">Hızlı</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-gray-600">Ücretsiz</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .glass-effect {
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection