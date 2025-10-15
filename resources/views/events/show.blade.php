@extends('layouts.app')

@section('title', $event->title)

@section('content')
	<div class="relative bg-gradient-to-br from-gray-50 via-white to-blue-50 rounded-3xl p-8 md:p-12 mb-12 overflow-hidden">
		<div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-30 -mr-32 -mt-32"></div>
		<div class="absolute bottom-0 left-0 w-48 h-48 bg-purple-100 rounded-full filter blur-3xl opacity-30 -ml-24 -mb-24"></div>
		<div class="relative">
			<nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
				<a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Ana Sayfa</a>
				<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
				<a href="{{ route('events.list') }}" class="hover:text-blue-600 transition-colors">Etkinlikler</a>
				<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
				<span class="text-gray-900 font-medium">{{ $event->title }}</span>
			</nav>

			@if($event->category)
				<span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/95 backdrop-blur-sm text-gray-900 text-xs font-bold rounded-full shadow-lg border border-gray-200 mb-3">
					<span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
					{{ $event->category->name }}
				</span>
			@endif

			<h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 leading-tight">{{ $event->title }}</h1>
			<div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
				<div class="flex items-center gap-1">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
					<span>{{ $event->event_date?->format('d M Y H:i') }}</span>
				</div>
				@if($event->location)
					<div class="flex items-center gap-1">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c-4.418 0-8 2.239-8 5v2h16v-2c0-2.761-3.582-5-8-5z"/></svg>
						<span>{{ $event->location }}</span>
					</div>
				@endif
			</div>
		</div>
	</div>

	<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
		<div class="lg:col-span-3">
			@if($event->media_url)
				<div class="mb-8 rounded-2xl overflow-hidden shadow-xl">
					<img src="{{ $event->media_url }}" alt="{{ $event->title }}" class="w-full h-80 object-cover">
				</div>
			@endif
			<div class="prose prose-lg max-w-none">
				{!! nl2br(e($event->description)) !!}
			</div>
		</div>
		<aside class="space-y-6">
			@if($event->user)
				<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
					<div class="text-center">
						<div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">
							{{ substr($event->user->name, 0, 1) }}
						</div>
						<h3 class="text-lg font-bold text-gray-900 mb-1">{{ $event->user->name }}</h3>
						<p class="text-sm text-gray-500 mb-4">Etkinlik Sahibi</p>
					</div>
				</div>
			@endif

			@if($related->count())
				<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
					<h3 class="text-lg font-bold text-gray-900 mb-4">Benzer Etkinlikler</h3>
					<div class="space-y-4">
						@foreach($related as $r)
							<a href="{{ route('events.show', $r) }}" class="flex items-center gap-3 group">
								<div class="w-12 h-12 bg-blue-600 text-white rounded-lg flex flex-col items-center justify-center">
									<span class="text-sm font-bold">{{ $r->event_date?->format('d') }}</span>
									<span class="text-[10px] uppercase">{{ $r->event_date?->format('M') }}</span>
								</div>
								<div class="flex-1 min-w-0">
									<h4 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $r->title }}</h4>
									<p class="text-xs text-gray-500">{{ $r->event_date?->format('d M Y H:i') }}</p>
								</div>
							</a>
						@endforeach
					</div>
				</div>
			@endif
		</aside>
	</div>
@endsection


