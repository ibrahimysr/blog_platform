@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50 to-pink-50">
	{{-- Animated Background Elements --}}
	<div class="fixed inset-0 overflow-hidden pointer-events-none">
		<div class="absolute top-20 left-10 w-72 h-72 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
		<div class="absolute top-40 right-10 w-72 h-72 bg-pink-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
		<div class="absolute bottom-20 left-1/2 w-72 h-72 bg-blue-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
	</div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @php $hasSidebar = isset($event->user) && $event->user ? true : false; $hasSidebar = $hasSidebar || ($related->count() > 0); @endphp
		{{-- Breadcrumb --}}
		<nav class="flex items-center gap-2 text-sm mb-6 backdrop-blur-sm">
			<a href="{{ route('home') }}" class="text-gray-600 hover:text-purple-600 transition-all duration-300 hover:scale-105">Ana Sayfa</a>
			<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
			</svg>
			<a href="{{ route('events.list') }}" class="text-gray-600 hover:text-purple-600 transition-all duration-300 hover:scale-105">Etkinlikler</a>
			<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
			</svg>
			<span class="text-gray-900 font-semibold">{{ Str::limit($event->title, 40) }}</span>
		</nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Main Content --}}
            <div class="{{ $hasSidebar ? 'lg:col-span-8' : 'lg:col-span-12' }}">
				{{-- Hero Card --}}
				<article class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 hover:shadow-purple-500/10 transition-all duration-500">
					{{-- Featured Image with Overlay --}}
					@if($event->media_url)
						<div class="relative h-[450px] overflow-hidden group">
							<img src="{{ $event->media_url }}" 
							     alt="{{ $event->title }}" 
							     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
							<div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
							
							{{-- Floating Category Badge --}}
							@if($event->category)
								<div class="absolute top-6 left-6">
									<span class="px-5 py-2.5 bg-white/95 backdrop-blur-md text-gray-900 text-sm font-bold rounded-full shadow-lg border border-white/50 hover:scale-105 transition-transform duration-300 inline-flex items-center gap-2">
										<span class="w-2 h-2 bg-purple-600 rounded-full animate-pulse"></span>
										{{ $event->category->name }}
									</span>
								</div>
							@endif

							{{-- Date Badge --}}
							<div class="absolute top-6 right-6 bg-white/95 backdrop-blur-md rounded-2xl p-4 shadow-2xl border border-white/50 text-center min-w-[80px] hover:scale-110 transition-transform duration-300">
								<div class="text-3xl font-black text-gray-900">{{ $event->event_date?->format('d') }}</div>
								<div class="text-xs font-bold text-purple-600 uppercase">{{ $event->event_date?->format('M') }}</div>
								<div class="text-xs text-gray-500">{{ $event->event_date?->format('Y') }}</div>
							</div>

							{{-- Title & Meta Overlay --}}
							<div class="absolute bottom-0 left-0 right-0 p-8">
								<h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight drop-shadow-2xl">
									{{ $event->title }}
								</h1>
								
								{{-- Event Info Cards --}}
								<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
									{{-- Date & Time Card --}}
									<div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/20">
										<div class="flex items-start gap-3">
											<div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
												<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
												</svg>
											</div>
											<div>
												<p class="text-white/70 text-xs font-semibold mb-1">Tarih & Saat</p>
												<p class="text-white font-bold">{{ $event->event_date?->format('d M Y') }}</p>
												<p class="text-white/90 text-sm">{{ $event->event_date?->format('H:i') }}</p>
											</div>
										</div>
									</div>

									{{-- Location Card --}}
									@if($event->location)
										<div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/20">
											<div class="flex items-start gap-3">
												<div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
													<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
													</svg>
												</div>
												<div>
													<p class="text-white/70 text-xs font-semibold mb-1">Konum</p>
													<p class="text-white font-bold">{{ $event->location }}</p>
												</div>
											</div>
										</div>
									@endif
								</div>
							</div>
						</div>
					@else
						{{-- No Image Hero --}}
						<div class="relative h-[300px] bg-gradient-to-br from-purple-600 via-pink-600 to-blue-600 overflow-hidden">
							<div class="absolute inset-0 opacity-20">
								<div class="absolute top-0 left-0 w-full h-full">
									<div class="absolute top-10 left-10 w-40 h-40 bg-white/20 rounded-full blur-3xl"></div>
									<div class="absolute bottom-10 right-10 w-60 h-60 bg-white/20 rounded-full blur-3xl"></div>
								</div>
							</div>
							<div class="relative h-full flex flex-col items-center justify-center p-8 text-center">
								@if($event->category)
									<span class="px-5 py-2.5 bg-white/20 backdrop-blur-md text-white text-sm font-bold rounded-full shadow-lg border border-white/30 mb-6 inline-flex items-center gap-2">
										<span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
										{{ $event->category->name }}
									</span>
								@endif
								<h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight drop-shadow-2xl max-w-3xl">
									{{ $event->title }}
								</h1>
								<div class="flex flex-wrap items-center justify-center gap-4 text-white/90">
									<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
										</svg>
										<span class="font-semibold">{{ $event->event_date?->format('d M Y H:i') }}</span>
									</div>
									@if($event->location)
										<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
											</svg>
											<span class="font-semibold">{{ $event->location }}</span>
										</div>
									@endif
								</div>
							</div>
						</div>
					@endif

					{{-- Content Section --}}
					<div class="p-8 md:p-12">
						{{-- Quick Info Banner --}}
						<div class="mb-8 p-6 bg-gradient-to-r from-purple-50 via-pink-50 to-blue-50 rounded-2xl border border-purple-200/50 shadow-sm">
							<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
								<div class="flex items-center gap-3">
									<div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
										<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
										</svg>
									</div>
									<div>
										<p class="text-xs text-gray-500 font-semibold">BAŞLANGIÇ</p>
										<p class="text-sm font-bold text-gray-900">{{ $event->event_date?->format('H:i') }}</p>
									</div>
								</div>
								<div class="flex items-center gap-3">
									<div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
										<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
										</svg>
									</div>
									<div>
										<p class="text-xs text-gray-500 font-semibold">TARİH</p>
										<p class="text-sm font-bold text-gray-900">{{ $event->event_date?->format('d M Y') }}</p>
									</div>
								</div>
								@if($event->location)
									<div class="flex items-center gap-3">
										<div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center shadow-lg">
											<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
											</svg>
										</div>
										<div class="flex-1 min-w-0">
											<p class="text-xs text-gray-500 font-semibold">KONUM</p>
											<p class="text-sm font-bold text-gray-900 truncate">{{ $event->location }}</p>
										</div>
									</div>
								@endif
							</div>
						</div>

						{{-- Event Description --}}
						<div class="mb-8">
							<h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
								<span class="w-1.5 h-8 bg-gradient-to-b from-purple-600 to-pink-600 rounded-full"></span>
								Etkinlik Hakkında
							</h2>
							<div class="prose prose-lg prose-purple max-w-none prose-headings:font-black prose-p:text-gray-700 prose-p:leading-relaxed">
								@safeHtml($event->description)
							</div>
						</div>

				

            {{-- Sidebar --}}
            @if($hasSidebar)
            <aside class="lg:col-span-4 space-y-6">
				{{-- Organizer Card --}}
				@if($event->user)
					<div class="sticky top-6 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 hover:shadow-purple-500/10 transition-all duration-500">
						<div class="relative h-32 bg-gradient-to-br from-purple-600 via-pink-600 to-rose-600 overflow-hidden">
							<div class="absolute inset-0 opacity-20">
								<div class="absolute top-0 left-0 w-full h-full bg-white/10 rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
							</div>
						</div>
						<div class="relative px-6 pb-6 -mt-16 text-center">
							<div class="w-24 h-24 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-2xl flex items-center justify-center text-white text-3xl font-black mx-auto mb-4 shadow-2xl border-4 border-white transform hover:scale-110 transition-transform duration-300">
								{{ substr($event->user->name, 0, 1) }}
							</div>
							<h3 class="text-xl font-black text-gray-900 mb-1">{{ $event->user->name }}</h3>
							<p class="text-sm text-gray-500 mb-6 font-medium flex items-center justify-center gap-2">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
								</svg>
								Etkinlik Organizatörü
							</p>
							<button class="w-full py-3 px-6 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-bold shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
								<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
								</svg>
								<span>İletişime Geç</span>
							</button>
						</div>
					</div>
                @endif

                {{-- Related Events --}}
				@if($related->count())
					<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-6">
						<h3 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-3">
							<span class="w-1 h-6 bg-gradient-to-b from-purple-600 to-pink-600 rounded-full"></span>
							Benzer Etkinlikler
						</h3>
						<div class="space-y-4">
							@foreach($related as $r)
								<a href="{{ route('events.show', $r) }}" class="group block">
									<div class="flex gap-4 p-3 rounded-xl hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all duration-300">
										<div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-600 text-white rounded-xl flex flex-col items-center justify-center flex-shrink-0 shadow-lg group-hover:shadow-xl group-hover:scale-105 transition-all duration-300">
											<span class="text-xl font-black">{{ $r->event_date?->format('d') }}</span>
											<span class="text-[10px] uppercase font-bold">{{ $r->event_date?->format('M') }}</span>
										</div>
										<div class="flex-1 min-w-0">
											<h4 class="text-sm font-bold text-gray-900 group-hover:text-purple-600 transition-colors line-clamp-2 mb-2">
												{{ $r->title }}
											</h4>
											<div class="flex flex-col gap-1">
												<p class="text-xs text-gray-500 flex items-center gap-1">
													<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
													</svg>
													{{ $r->event_date?->format('H:i') }}
												</p>
												@if($r->location)
													<p class="text-xs text-gray-500 flex items-center gap-1 truncate">
														<svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
														</svg>
														{{ $r->location }}
													</p>
												@endif
											</div>
										</div>
									</div>
								</a>
							@endforeach
						</div>
					</div>
                @endif

                {{-- Removed calendar section per request --}}
            </aside>
            @endif
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