@extends('layouts.app')

@section('title', 'Türkab Üyesi Kimdir? - TÜRKAB')

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
            <span class="text-gray-900 font-semibold">Türkab Üyesi Kimdir?</span>
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
                    Türkab Üyesi Kimdir?
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Bir Türkab mensubu; çevresinde yürüyen ahlak olarak anılmalıdır.
            </p>
        </div>

        {{-- Main Content --}}
        <div class="max-w-5xl mx-auto">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
                
                {{-- TÜRKAB Philosophy Section --}}
                <div class="mb-12">
                    <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-1.5 h-10 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        TÜRKAB'ın Temel Felsefesi
                    </h2>
                    
                    <div class="space-y-6 text-gray-700 leading-relaxed">
                        <p class="text-lg">
                            Türkab olarak günün derdinin ötesinde bir kelam etmenin çabası içerisindeyiz. Riyaset derdi, siyaset derdi, ticaret derdi... Asıl dert ise <strong class="text-blue-700 font-bold">Risâlet derdi</strong>dir.
                        </p>
                        
                        <p class="text-lg">
                            Risalet derdi, bu topraklara <strong class="text-blue-700 font-bold">Ehli Sünnet ve'l Cemaat</strong> yoluyla ulaşmıştır. Bu yol, <strong class="text-blue-700 font-bold">marifet derdi</strong>, <strong class="text-blue-700 font-bold">hikmet derdi</strong> ve <strong class="text-blue-700 font-bold">hakikat derdi</strong>nden bahseder.
                        </p>
                        
                        <p class="text-lg">
                            Riyaset, siyaset, ticaret ve her ne olursa olsun, <strong class="text-blue-700 font-bold">hakikate hizmet ederse</strong> anlamı, değeri ve önemi vardır. Yani, bizim aradığımız <strong class="text-blue-700 font-bold">hakikattir</strong>.
                        </p>
                        
                        <div class="bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200 rounded-2xl p-6 border-l-4 border-blue-500">
                            <p class="text-xl font-bold text-blue-800 text-center">
                                "Bizim sevdamız hakikatedir."
                            </p>
                        </div>
                        
                        <p class="text-lg">
                            Çünkü davamız haktır, taptığımız Hakk'tır. Çünkü, gelişimiz Hakk'tandır ve yine dönüşümüz Hakk'adır.
                        </p>
                        
                        <p class="text-lg">
                            Ve bu Hakk ve hakikat çerçevesinde Türkab'a düşen büyük bir görev vardır kıymetli kardeşlerim:
                        </p>
                    </div>
                </div>

                {{-- Ethics Section --}}
                <div class="mb-12">
                    <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-1.5 h-10 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Ahlak
                    </h2>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200">
                        <div class="space-y-6">
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">1</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">Özüyle, sözüyle, hal ve hareketiyle, tavır ve davranışıyla ahlak.</strong>
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">2</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">Hakikatten süzülen ahlak.</strong>
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">3</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">Hakk'ın hakkını ve Hakk'ın hatırını en üstte tutan bir ahlak.</strong>
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">4</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">Kul hakkını bununla kaynaştıran bir ahlak.</strong>
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">5</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">Haramı-helali, marufu-münkeri bununla buluşturan bir ahlak.</strong>
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">6</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">Muamelatı çepeçevre kuşatan bir ahlak.</strong>
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">7</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">İbadeti en ulu tezyinatla süsleyen bir ahlak.</strong>
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold text-sm">8</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <strong class="text-blue-700">İmanı en güzel cila ile parlatan bir ahlak.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Conclusion Section --}}
                <div class="text-center">
                    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-3xl p-8 text-white">
                        <h3 class="text-2xl font-black mb-4">Sonuç</h3>
                        <p class="text-lg mb-4">
                            Bu manada bir Türkab mensubu <strong>yürüyen ahlak</strong> olmalıdır.
                        </p>
                        <p class="text-xl font-bold">
                            "Bir Türkab mensubu, çevresinde yürüyen ahlak olarak anılmalıdır."
                        </p>
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
