@extends('layouts.app')

@section('title', 'Biz Kimiz? - TÜRKAB')

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
            <span class="text-gray-900 font-semibold">Hakkımızda</span>
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
                    Biz Kimiz?
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Milli ve manevi duygularla süslenmiş bir toplum ve gençlik inşa etme hayaliyle yola çıktık.
            </p>
        </div>

        {{-- Main Content --}}
        <div class="max-w-5xl mx-auto">
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
                    {{-- TÜRKAB Logo Section --}}
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center space-x-4 mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <h2 class="text-3xl font-black text-gray-900">TÜRKAB</h2>
                                <p class="text-lg text-gray-600 font-semibold">TÜRKİYE KARDEŞLİK BİRLİĞİ</p>
                            </div>
                        </div>
                    </div>

                    {{-- Who We Are Section --}}
                    <div class="mb-12">
                        <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                            Biz Kimiz?
                        </h3>
                        <div class="space-y-6 text-gray-700 leading-relaxed">
                            <p class="text-lg">
                                Bizler, milli ve manevi duygularla süslenmiş bir toplum ve gençlik inşa etmek, oluşan bu kardeşlik bilincini uluslararası düzeyde temsilini ve tesisini sağlamak hayaliyle yola çıkmış insanlarız.
                            </p>
                            <p class="text-lg">
                                Türkiye'nin 20 ilinde il ve ilçe temsilcilikleri bulunan, 6 yurt dışı temsilciliği bulunan, yaklaşık 10.000 gönüllü üyesi olan bir sivil toplum kuruluşuyuz. Türkiye Kardeşlik Birliği, 2017 yılında Gaziantep'te kurulmuş olup, daha sonra genel merkezi Ankara'ya taşınmıştır.
                            </p>
                        </div>
                    </div>

                    {{-- Our Slogan --}}
                    <div class="mb-12 p-8 bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200 rounded-2xl border-l-4 border-blue-500">
                        <h3 class="text-2xl font-black text-gray-900 mb-4 flex items-center gap-3">
                            <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                            Sloganımız
                        </h3>
                        <p class="text-3xl font-black text-blue-800 text-center">
                            "Yeni Neslin Kardeşlik Hareketi"
                        </p>
                    </div>

                    {{-- What We Want --}}
                    <div class="mb-12">
                        <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                            Biz Ne İstiyoruz?
                        </h3>
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 border border-gray-200">
                            <p class="text-lg text-gray-700 leading-relaxed">
                                Fikri hür, vicdanı hür, geleceğe gayretle kanatlanan, değerlerine bağlı, kendi kökleri üzerinde yükselen ve dünyanın bütün meydan okumalarına karşı göğsünü siper ederek dünyadaki bütün haksızlıklara karşı meydan okuyan bir gençlik yetiştirmek istiyoruz. Biyolojik bağları olan bir kardeşlik değil, müşterek manevi değerler ile birbirine bağlı bir kardeşlik hayalindeyiz.
                            </p>
                        </div>
                    </div>

                    {{-- Our Projects --}}
                    <div class="mb-12">
                        <h3 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-3">
                            <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                            Projelerimiz
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900">Medeniyet Kardeşliği</h4>
                                </div>
                                <p class="text-gray-700">Farklı kültürler arasında köprü kuran, medeniyetler arası diyalogu güçlendiren projelerimiz.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900">Kampüs Kardeşliği</h4>
                                </div>
                                <p class="text-gray-700">Üniversite öğrencileri arasında kardeşlik bağlarını güçlendiren kampüs etkinlikleri.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900">Fikir Mektebi</h4>
                                </div>
                                <p class="text-gray-700">Gençlerin düşünce dünyasını zenginleştiren, fikir üretimini teşvik eden eğitim programları.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900">Lider Anne</h4>
                                </div>
                                <p class="text-gray-700">Annelerin toplumsal liderlik rollerini güçlendiren, aile değerlerini destekleyen projeler.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900">Kardeşlik Umresi</h4>
                                </div>
                                <p class="text-gray-700">Manevi değerleri güçlendiren, kardeşlik bağlarını pekiştiren umre organizasyonları.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900">Kardeşlik Merkezi</h4>
                                </div>
                                <p class="text-gray-700">Toplumsal dayanışmayı güçlendiren, sosyal yardımlaşmayı destekleyen merkezler.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 md:col-span-2">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-black text-gray-900">Ortadoğu Siyaset Okulu</h4>
                                </div>
                                <p class="text-gray-700">Bölgesel siyasi gelişmeleri analiz eden, genç liderler yetiştiren akademik programlar.</p>
                            </div>
                        </div>
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
