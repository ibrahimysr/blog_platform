@extends('layouts.app')

@section('title', 'Hakkımızda - DETA - TÜRKAB')

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
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                <span>DETA</span>
            </div>
            
            <h1 class="text-5xl lg:text-6xl font-black text-gray-900 mb-6">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
                    Dijital Demokrasi ve Toplum<br>Araştırma Merkezi
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Dijital çağın toplumsal, siyasal ve etik dönüşümünü bilimsel yöntemlerle inceleyen düşünce ve araştırma merkezi
            </p>
        </div>

        {{-- Main Content --}}
        <div class="max-w-5xl mx-auto">
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
                
                {{-- DETA Logo Section --}}
                    <div class="text-center mb-12">
                    <div class="inline-flex items-center space-x-4 mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                            <h2 class="text-3xl font-black text-gray-900">DETA</h2>
                            <p class="text-lg text-gray-600 font-semibold">Dijital Demokrasi ve Toplum Araştırma Merkezi</p>
                        </div>
                        </div>
                    </div>

                {{-- Introduction --}}
                    <div class="mb-12">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-50 rounded-2xl p-8 border border-blue-200">
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            Dijital Demokrasi ve Toplum Araştırma Merkezi (DETA), Kardeşlik Derneği (TÜRKAB - Kardeşlik Hareketi) bünyesinde faaliyet gösteren; dijital çağın toplumsal, siyasal ve etik dönüşümünü bilimsel yöntemlerle inceleyen bir düşünce ve araştırma merkezidir.
                        </p>
                        
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Merkez, demokrasinin dijitalleşme sürecinde karşılaştığı fırsatları ve riskleri analiz ederek, katılımcı, şeffaf ve veri temelli bir yönetişim kültürünün geliştirilmesine katkı sunmayı amaçlamaktadır.
                            </p>
                        </div>
                    </div>

                {{-- DETA Description --}}
                <div class="mb-12">
                    <div class="bg-white rounded-2xl p-8 border border-blue-200">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            DETA, derneğin temel ilkeleri olan <span class="font-bold text-blue-700">eşitlik, katılım, hesap verebilirlik ve etik sorumluluk</span> çerçevesinde; bilimsel araştırmalar, toplumsal analizler ve politika geliştirme çalışmaları yürütür. Bu yönüyle merkez, hem akademi hem sivil toplum hem de politika üretim çevreleri arasında köprü işlevi gören özgün bir yapıdır.
                        </p>
                    </div>
                </div>

                {{-- Misyon --}}
                <div class="mb-12">
                    <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Misyonumuz
                    </h3>
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200">
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            Dijital Demokrasi ve Toplum Araştırma Merkezi'nin misyonu, dijital dönüşümün demokratik değerlerle uyumlu biçimde toplumsal yaşama entegre edilmesini sağlamaktır. Bu doğrultusunda DETA:
                        </p>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Dijital katılım, yurttaş temsili ve e-demokrasi modelleri üzerine bilimsel araştırmalar yürütür.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Siyasi ve toplumsal karar süreçlerinin veri temelli analizini yapar.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Dijitalleşmenin insan hakları, etik ve yönetişim üzerindeki etkilerini değerlendirir.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Bilgiye dayalı politika önerileri geliştirir.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Genç araştırmacılar, akademisyenler ve sivil toplum aktörleri için ortak çalışma platformları oluşturur.</span>
                            </li>
                        </ul>
                        <p class="text-gray-700 leading-relaxed mt-6 italic">
                            Merkez, her araştırmasında bilimsel tarafsızlık, toplumsal fayda ve etik sorumluluk ilkelerini esas alır.
                            </p>
                        </div>
                    </div>

                {{-- Vizyon --}}
                <div class="mb-12">
                    <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Vizyonumuz
                    </h3>
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200">
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            DETA'nın vizyonu, dijital çağın sunduğu olanakları demokratik katılımın güçlenmesi yönünde değerlendiren öncü bir düşünce merkezi olmaktır. Bu vizyon doğrultusunda merkez:
                        </p>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Dijital teknolojilerin yurttaş odaklı kullanımını teşvik eder.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Demokratik süreçlerin şeffaf, hesap verebilir ve katılımcı biçimde yeniden tasarlanmasına katkı sağlar.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Toplumsal veri analizine dayalı karar alma kültürünün yerleşmesini hedefler.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Dijital etik, mahremiyet ve güvenlik konularında ulusal ölçekte referans niteliğinde çalışmalar üretir.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Geleceğin demokrasisini yalnızca tartışan değil, tasarlayan ve modelleyen bir araştırma ekosistemi oluşturmayı amaçlar.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Değerler ve İlkeler --}}
                <div class="mb-12">
                    <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Değerlerimiz ve İlkelerimiz
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                </div>
                                <h4 class="font-black text-gray-900">Bilimsel Tarafsızlık</h4>
                            </div>
                            <p class="text-gray-700">Araştırmalarda nesnel, ölçülebilir ve ampirik veri temelli yaklaşımlar benimsenir.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                <h4 class="font-black text-gray-900">Katılımcılık</h4>
                            </div>
                            <p class="text-gray-700">Tüm toplumsal kesimlerin görüş ve deneyimlerine yer verilir.</p>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                                <h4 class="font-black text-gray-900">Şeffaflık</h4>
                            </div>
                            <p class="text-gray-700">Bulgular kamuya açık biçimde paylaşılır, hesap verebilirlik esastır.</p>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                </div>
                                <h4 class="font-black text-gray-900">Etik Sorumluluk</h4>
                            </div>
                            <p class="text-gray-700">İnsan haklarına, özel verilerin gizliliğine ve akademik dürüstlüğe tam bağlılık.</p>
                        </div>
                            </div>

                    <div class="mt-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                            <h4 class="font-black text-gray-900">Toplumsal Fayda</h4>
                        </div>
                        <p class="text-gray-700">Üretilen bilgi, yalnızca akademik çevrelerde değil, toplumun tamamında karşılık bulmalıdır.</p>
                    </div>
                </div>

                {{-- Çalışma Alanları --}}
                <div class="mb-8">
                    <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
                        Çalışma Alanlarımız
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Dijital Demokrasi ve Katılım Modelleri</h4>
                            </div>
                            </div>

                        <div class="bg-white rounded-xl p-6 border border-slate-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                <h4 class="font-bold text-gray-900">Siyaset, Toplum ve Teknoloji İlişkisi</h4>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Seçmen Davranışları ve Kamuoyu Araştırmaları</h4>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Sosyal Medya, Algoritmalar ve Dezenformasyon</h4>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Dijital Güvenlik, Mahremiyet ve Etik</h4>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Yapay Zekâ ve Demokratik Yönetişim</h4>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 md:col-span-2">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Yerel Demokrasi ve Dijital Katılım Platformları</h4>
                            </div>
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
