@extends('layouts.app')

@section('title', 'Etkinlikler')

@section('content')
	{{-- Hero Section --}}
	<div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-purple-900 rounded-3xl p-8 md:p-16 mb-12 overflow-hidden">
		{{-- Animated Background Elements --}}
		<div class="absolute inset-0 opacity-20">
			<div class="absolute top-0 right-0 w-96 h-96 bg-blue-500 rounded-full filter blur-[100px] animate-pulse"></div>
			<div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-500 rounded-full filter blur-[100px] animate-pulse" style="animation-delay: 1s;"></div>
			<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-cyan-500 rounded-full filter blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>
		</div>

		{{-- Grid Pattern Overlay --}}
		<div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.03)_1px,transparent_1px)] bg-[size:64px_64px]"></div>
		
		<div class="relative z-10">
			{{-- Badge --}}
			<div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full mb-6 shadow-2xl">
				<div class="w-2 h-2 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full animate-pulse"></div>
				<span class="text-sm font-bold text-white">Etkinlik Takvimi</span>
			</div>
			
			{{-- Main Heading --}}
			<h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-4 leading-[1.1]">
				Etkinlikler &
				<span class="relative inline-block">
					<span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Deneyimler</span>
					<svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 5.5C50 1 100 1 199 5.5" stroke="url(#gradient)" stroke-width="3" stroke-linecap="round"/>
						<defs>
							<linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
								<stop offset="0%" style="stop-color:#60a5fa"/>
								<stop offset="50%" style="stop-color:#a78bfa"/>
								<stop offset="100%" style="stop-color:#f472b6"/>
							</linearGradient>
						</defs>
					</svg>
				</span>
			</h1>
			<p class="text-white/80 text-lg md:text-xl max-w-2xl mb-8 leading-relaxed">
				Yaklaşan etkinlikler, eğlenceli deneyimler ve unutulmaz anılar sizi bekliyor.
			</p>

			{{-- Search & Filters --}}
			<div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-4xl">
				<form class="col-span-1 md:col-span-2">
					<div class="relative group">
						<input name="q" 
						       value="{{ request('q') }}" 
						       type="search" 
						       placeholder="Etkinlik ara..." 
						       class="w-full pl-12 pr-4 py-4 rounded-xl border-2 border-white/20 bg-white/10 backdrop-blur-xl text-white placeholder:text-white/60 focus:outline-none focus:ring-4 focus:ring-white/20 focus:border-white/40 transition-all duration-300">
						<svg class="w-5 h-5 text-white/60 absolute left-4 top-1/2 -translate-y-1/2 group-focus-within:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
						</svg>
					</div>
				</form>
				<form class="col-span-1">
					<select name="category" 
					        onchange="this.form.submit()" 
					        class="w-full px-4 py-4 rounded-xl border-2 border-white/20 bg-white/10 backdrop-blur-xl text-white font-bold focus:outline-none focus:ring-4 focus:ring-white/20 focus:border-white/40 cursor-pointer transition-all duration-300 appearance-none">
						<option value="" class="bg-slate-900 text-white">📁 Tüm Kategoriler</option>
						@foreach($categories as $c)
							<option value="{{ $c->id }}" class="bg-slate-900 text-white" {{ request('category')==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
						@endforeach
					</select>
				</form>
			</div>
		</div>
	</div>

	{{-- Upcoming Events Section --}}
	<div class="mb-16">
		<div class="flex items-center justify-between mb-8">
			<div>
				<div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 rounded-full mb-3">
					<span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
					<span class="text-sm font-bold text-emerald-700">Aktif</span>
				</div>
				<h2 class="text-3xl md:text-4xl font-black text-gray-900">
					Devam Eden / Yaklaşan Etkinlikler
				</h2>
			</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
			@forelse($upcomingEvents as $event)
				<article class="group bg-white rounded-2xl overflow-hidden border-2 border-gray-100 hover:border-blue-500 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
					{{-- Image --}}
					<a href="{{ route('events.show', $event) }}" class="block relative h-56 overflow-hidden">
						@if($event->media_url)
							<img src="{{ $event->media_url }}" 
							     alt="{{ $event->title }}" 
							     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:rotate-2">
						@else
							<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100">
								<svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
							</div>
						@endif

						{{-- Gradient Overlay --}}
						<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
						
						{{-- Category Badge --}}
						<div class="absolute top-4 left-4 z-10">
							<span class="inline-flex items-center gap-2 px-4 py-2 bg-white/95 backdrop-blur-sm rounded-full text-xs font-black shadow-xl group-hover:scale-110 transition-transform duration-300">
								<span class="w-2 h-2 bg-gradient-to-r from-emerald-500 to-green-500 rounded-full animate-pulse"></span>
								{{ $event->category?->name ?? 'Genel' }}
							</span>
						</div>

						{{-- Status Badge --}}
						<div class="absolute top-4 right-4 z-10">
							<span class="px-3 py-1.5 bg-emerald-500 text-white text-xs font-bold rounded-full shadow-lg">
								🔴 CANLI
							</span>
						</div>

						{{-- View More Indicator --}}
						<div class="absolute bottom-4 right-4 w-12 h-12 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 shadow-xl">
							<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
							</svg>
						</div>
					</a>

					{{-- Content --}}
					<div class="p-6">
						<a href="{{ route('events.show', $event) }}" class="block mb-3">
							<h3 class="text-xl font-black text-gray-900 line-clamp-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 group-hover:bg-clip-text transition-all duration-300 leading-tight">
								{{ $event->title }}
							</h3>
						</a>
						<p class="text-sm text-gray-600 line-clamp-2 mb-5 leading-relaxed">
							{{ Str::limit(strip_tags($event->description), 110) }}
						</p>

						{{-- Meta Info --}}
						<div class="space-y-3 mb-5 pb-5 border-b-2 border-gray-100">
							<div class="flex items-center gap-3 text-sm">
								<div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl flex items-center justify-center">
									<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
									</svg>
								</div>
								<div>
									<div class="text-xs text-gray-500 font-medium">Tarih & Saat</div>
									<div class="text-sm font-bold text-gray-900">{{ $event->event_date->format('d M Y H:i') }}</div>
								</div>
							</div>

							@if($event->location)
								<div class="flex items-center gap-3 text-sm">
									<div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center">
										<svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
										</svg>
									</div>
									<div>
										<div class="text-xs text-gray-500 font-medium">Konum</div>
										<div class="text-sm font-bold text-gray-900">{{ $event->location }}</div>
									</div>
								</div>
							@endif
						</div>

						{{-- Action Button --}}
						<a href="{{ route('events.show', $event) }}" 
						   class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-blue-500/30 hover:scale-105 transition-all duration-300">
							<span>Detayları Gör</span>
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
							</svg>
						</a>
					</div>
				</article>
			@empty
				<div class="col-span-full">
					<div class="text-center py-20 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 rounded-3xl border-2 border-dashed border-gray-300 relative overflow-hidden">
						<div class="absolute inset-0 bg-[linear-gradient(rgba(59,130,246,.03)_1px,transparent_1px),linear-gradient(90deg,rgba(59,130,246,.03)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
						<div class="relative z-10">
							<div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
								<svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
							</div>
							<h3 class="text-2xl font-black text-gray-900 mb-2">Yaklaşan Etkinlik Yok</h3>
							<p class="text-gray-600">Yeni etkinlikler için takipte kalın.</p>
						</div>
					</div>
				</div>
			@endforelse
		</div>
	</div>

	{{-- Past Events Section --}}
	<div class="mt-16">
		<div class="flex items-center justify-between mb-8">
			<div>
				<div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-slate-50 border border-gray-200 rounded-full mb-3">
					<span class="w-2 h-2 bg-gray-400 rounded-full"></span>
					<span class="text-sm font-bold text-gray-600">Arşiv</span>
				</div>
				<h2 class="text-3xl md:text-4xl font-black text-gray-900">
					Geçmiş Etkinlikler
				</h2>
			</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
			@forelse($pastEvents as $event)
				<article class="group bg-white rounded-2xl overflow-hidden border-2 border-gray-100 hover:border-gray-300 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
					{{-- Image with Grayscale Effect --}}
					<a href="{{ route('events.show', $event) }}" class="block relative h-56 overflow-hidden">
						@if($event->media_url)
							<img src="{{ $event->media_url }}" 
							     alt="{{ $event->title }}" 
							     class="w-full h-full object-cover grayscale-[50%] group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
						@else
							<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-slate-100">
								<svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
								</svg>
							</div>
						@endif

						{{-- Subtle Overlay --}}
						<div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-gray-900/10 to-transparent"></div>
						
						{{-- Category Badge --}}
						<div class="absolute top-4 left-4 z-10">
							<span class="inline-flex items-center gap-2 px-4 py-2 bg-white/95 backdrop-blur-sm rounded-full text-xs font-black shadow-lg">
								<span class="w-2 h-2 bg-gray-500 rounded-full"></span>
								{{ $event->category?->name ?? 'Genel' }}
							</span>
						</div>

						{{-- Completed Badge --}}
						<div class="absolute top-4 right-4 z-10">
							<span class="px-3 py-1.5 bg-gray-600 text-white text-xs font-bold rounded-full shadow-lg">
								✓ TAMAMLANDI
							</span>
						</div>
					</a>

					{{-- Content --}}
					<div class="p-6">
						<a href="{{ route('events.show', $event) }}" class="block mb-3">
							<h3 class="text-xl font-black text-gray-900 line-clamp-2 group-hover:text-gray-700 transition-colors duration-300 leading-tight">
								{{ $event->title }}
							</h3>
						</a>
						<p class="text-sm text-gray-600 line-clamp-2 mb-5 leading-relaxed">
							{{ Str::limit(strip_tags($event->description), 110) }}
						</p>

						{{-- Meta Info --}}
						<div class="space-y-3 mb-5 pb-5 border-b-2 border-gray-100">
							<div class="flex items-center gap-3 text-sm">
								<div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
									<svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
									</svg>
								</div>
								<div>
									<div class="text-xs text-gray-500 font-medium">Tarih & Saat</div>
									<div class="text-sm font-bold text-gray-700">{{ $event->event_date->format('d M Y H:i') }}</div>
								</div>
							</div>

							@if($event->location)
								<div class="flex items-center gap-3 text-sm">
									<div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
										<svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
										</svg>
									</div>
									<div>
										<div class="text-xs text-gray-500 font-medium">Konum</div>
										<div class="text-sm font-bold text-gray-700">{{ $event->location }}</div>
									</div>
								</div>
							@endif
						</div>

						{{-- Action Button --}}
						<a href="{{ route('events.show', $event) }}" 
						   class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 hover:scale-105 transition-all duration-300">
							<span>Detayları Gör</span>
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
							</svg>
						</a>
					</div>
				</article>
			@empty
				<div class="col-span-full">
					<div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
						<div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
							<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
							</svg>
						</div>
						<h3 class="text-2xl font-black text-gray-700 mb-2">Geçmiş Etkinlik Yok</h3>
						<p class="text-gray-500">Henüz tamamlanmış etkinlik bulunmuyor.</p>
					</div>
				</div>
			@endforelse
		</div>
	</div>
@endsection