@extends('layouts.app')

@section('title', 'Neden Kurulduk? - TÜRKAB')

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
            <span class="text-gray-900 font-semibold">Neden Kurulduk?</span>
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
                    Neden Kurulduk?
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                TÜRKAB'ın kuruluş amacı, misyonu ve vizyonu
            </p>
        </div>

        {{-- Main Content --}}
        <div class="max-w-5xl mx-auto">
            <div class="space-y-12">
                
                {{-- Neden Kurulduk Section --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
                    <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-1.5 h-10 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Neden Kurulduk?
                    </h2>
                    
                    <div class="space-y-6 text-gray-700 leading-relaxed">
                        <p class="text-lg">
                            TÜRKAB olarak, ülkemizdeki ve farklı kökenlerden gelen tüm vatandaşlar arasında <strong class="text-blue-700 font-bold">kardeşlik bilincini oluşturmayı</strong>, saygı ve sevgi bağlarını güçlendirmeyi, milli ve manevi duygularla donanmış bir toplum ve gençlik inşa etmeyi, bu bilinci uluslararası düzeyde temsil etmeyi ve yardımlaşma ruhunu yaymayı hedefleyen bir <strong class="text-blue-700 font-bold">seferberlik hareketi</strong> olarak yola çıktık.
                        </p>
                        
                        <p class="text-lg">
                            Kadim kültür mirasımızın farkındalığını sağlamak, farklı ırklardan T.C. vatandaşları ve yabancı uyruklu fertlerin birlikte yaşama bilincini artırmak, inanç ve ahlak değerlerini öğretmek, araştırmak ve yaygınlaştırmak yoluyla sosyal yapımızı güçlendirmek ve yeni nesilleri kendi medeniyetimiz ekseninde yetiştirmeye katkı sağlamak için yola çıkmış bir <strong class="text-blue-700 font-bold">fikir ve aksiyon hareketi</strong>yiz.
                        </p>
                        
                        <p class="text-lg">
                            Dil, din, düşünce, eğitim, sanat, edebiyat gibi alanlarda <strong class="text-blue-700 font-bold">nitelikli düşünceler, ürünler, anlayışlar ve projeler</strong> üretmek, nitelikli düşünceyi öne çıkarmak ve topluma yaygınlaştırmak için çalışıyoruz.
                        </p>
                        
                        <p class="text-lg">
                            Hudutları kalemle değil, <strong class="text-blue-700 font-bold">gönülle çizilen kardeşlik bilincini</strong> toplumun tüm fertlerine yaymak, kadim mirasımızın sorumluluğunu yerine getirmek ve ulusal/uluslararası huzuru sağlamak için ortam yaratmak ana şiarımızdır.
                        </p>
                    </div>
                </div>

                {{-- Misyonumuz Section --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
                    <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-1.5 h-10 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Misyonumuz
                    </h2>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            <strong class="text-blue-700 font-bold">Dinini, Tarihini, Kültürünü, Değerlerini ve En Önemlisi Kardeşlik Bilincini ve Hukukunu Bilen</strong>, <strong class="text-blue-700 font-bold">Çağın Gerektirdiği Bilgi ve Görgüyü Edinmiş</strong>, <strong class="text-blue-700 font-bold">Teknolojiyi Üst Düzeyde Kullanabilen</strong>, <strong class="text-blue-700 font-bold">Özgüveni Yüksek, İletişime Açık, Kendisini Güncelleyebilen, Okuyan, Araştıran, Kendisine Sürekli Daha İleri Hedefler Belirleyen</strong>, <strong class="text-blue-700 font-bold">Doğuyu da Batıyı da Tanıyan, Görevini Layıkıyla Yerine Getirebilecek Donanıma Sahip</strong> ve <strong class="text-blue-700 font-bold">İyiliği Emreden Kötülükten Sakındıran, Çevresine Örnek, Ahlaklı, Şuurlu ve Vatansever Nesiller Yetiştirmek</strong>.
                        </p>
                    </div>
                </div>

                {{-- Vizyonumuz Section --}}
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
                    <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-1.5 h-10 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Vizyonumuz
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black text-gray-900">Ülkemize Öncü</h3>
                            </div>
                            <p class="text-gray-700">Türkiye'de öncü ve lider bir sivil toplum kuruluşu olmak</p>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black text-gray-900">Dünyaya Örnek</h3>
                            </div>
                            <p class="text-gray-700">Dünyaya örnek teşkil eden bir model oluşturmak</p>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black text-gray-900">Donanımlı Nesiller</h3>
                            </div>
                            <p class="text-gray-700">Donanımlı ve inançlı nesiller yetiştirmek</p>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black text-gray-900">İdeal Toplum</h3>
                            </div>
                            <p class="text-gray-700">Kardeşlik bilinci ile ideal bir toplum oluşturmak</p>
                        </div>
                    </div>
                </div>

                {{-- Call to Action --}}
                <div class="text-center">
                    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-3xl p-8 text-white">
                        <h3 class="text-2xl font-black mb-4">Bize Katılın</h3>
                        <p class="text-lg mb-6">TÜRKAB'ın misyonuna ortak olun ve kardeşlik hareketinin bir parçası olun.</p>
                        <a href="#" class="inline-flex items-center px-8 py-4 bg-white text-blue-700 font-bold rounded-full hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                            <span>Hemen Katıl</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
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
