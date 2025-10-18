@extends('layouts.app')

@section('title', 'Temsilciliklerimiz - TÜRKAB')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-blue-50">
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-blue-300/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-blue-200/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm mb-6 backdrop-blur-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105">Ana Sayfa</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('about.index') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105">Hakkımızda</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-semibold">Temsilciliklerimiz</span>
        </nav>

        {{-- Hero Section --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full text-white text-sm font-bold shadow-lg backdrop-blur-sm mb-8">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span>TÜRKAB</span>
            </div>
            
            <h1 class="text-5xl lg:text-6xl font-black text-gray-900 mb-6">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
                    Temsilciliklerimiz
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Türkiye'nin dört bir yanında ve yurt dışında faaliyet gösteren temsilciliklerimiz
            </p>
        </div>

        {{-- Main Content --}}
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Yurt İçi Temsilcilikler --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-black text-gray-900">Yurt İçi Temsilciliklerimiz</h2>
                        </div>
                        <p class="text-gray-600">Türkiye'nin 20 farklı ilinde faaliyet gösteren temsilciliklerimiz</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @php
                        $domesticCities = [
                            'İstanbul', 'Ankara', 'İzmir', 'Mersin', 'Adana',
                            'Kahramanmaraş', 'Malatya', 'Adıyaman', 'Gaziantep', 'Şanlıurfa',
                            'Diyarbakır', 'Bingöl', 'Şırnak', 'Muş', 'Van',
                            'Giresun', 'Afyon', 'Isparta', 'Batman', 'Hatay'
                        ];
                        @endphp
                        
                        @foreach($domesticCities as $index => $city)
                        <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300 hover:scale-105">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                            </div>
                            <span class="text-gray-800 font-semibold">{{ $city }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Yurt Dışı Temsilcilikler --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-black text-gray-900">Yurt Dışı Temsilciliklerimiz</h2>
                        </div>
                        <p class="text-gray-600">6 farklı ülkede faaliyet gösteren temsilciliklerimiz</p>
                    </div>

                    <div class="space-y-3">
                        @php
                        $internationalCountries = [
                            'Suudi Arabistan', 'İran', 'Almanya', 'İngiltere', 'Filistin', 'Fransa'
                        ];
                        @endphp
                        
                        @foreach($internationalCountries as $index => $country)
                        <div class="flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-all duration-300 hover:scale-105">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold">{{ $index + 1 }}</span>
                            </div>
                            <span class="text-gray-800 font-semibold text-lg">{{ $country }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Statistics Section --}}
            <div class="mt-12 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-black text-gray-900 mb-4">Temsilcilik İstatistiklerimiz</h3>
                    <p class="text-gray-600">Geniş coğrafyada faaliyet gösteren temsilcilik ağımız</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
                        <div class="text-4xl font-black text-blue-600 mb-2">20</div>
                        <p class="text-gray-700 font-semibold">Yurt İçi Temsilcilik</p>
                        <p class="text-sm text-gray-500 mt-1">Türkiye genelinde</p>
                    </div>
                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
                        <div class="text-4xl font-black text-blue-600 mb-2">6</div>
                        <p class="text-gray-700 font-semibold">Yurt Dışı Temsilcilik</p>
                        <p class="text-sm text-gray-500 mt-1">Uluslararası</p>
                    </div>
                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
                        <div class="text-4xl font-black text-blue-600 mb-2">26</div>
                        <p class="text-gray-700 font-semibold">Toplam Temsilcilik</p>
                        <p class="text-sm text-gray-500 mt-1">Geniş ağ</p>
                    </div>
                </div>
            </div>

            {{-- Call to Action --}}
            <div class="text-center mt-12">
                <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-3xl p-8 text-white">
                    <h3 class="text-2xl font-black mb-4">Temsilciliğimizle İletişime Geçin</h3>
                    <p class="text-lg mb-6">Size en yakın temsilciliğimizle iletişime geçerek TÜRKAB faaliyetlerine katılabilirsiniz.</p>
                    <a href="#" class="inline-flex items-center px-8 py-4 bg-white text-blue-700 font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <span>İletişime Geçin</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -20px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(20px, 20px) scale(1.05); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
@endsection
