@extends('layouts.app')

@section('title', 'Etkinlikler')

@section('content')
	<div class="relative rounded-3xl p-8 md:p-12 mb-10 overflow-hidden bg-gradient-to-br from-gray-50 via-white to-blue-50">
		<div class="absolute -top-24 -right-24 w-72 h-72 bg-blue-100 rounded-full blur-3xl opacity-40"></div>
		<div class="absolute -bottom-24 -left-24 w-60 h-60 bg-purple-100 rounded-full blur-3xl opacity-40"></div>
		<div class="relative">
			<h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-3 leading-tight">Etkinlikler</h1>
			<p class="text-gray-600 text-lg max-w-2xl">Yaklaşan etkinlikler ve geçmiş kayıtlar.</p>
			<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-3">
				<form class="col-span-1 md:col-span-1">
					<div class="relative">
						<input name="q" value="{{ request('q') }}" type="search" placeholder="Etkinlik ara" class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
						<svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
					</div>
				</form>
				<form class="col-span-1">
					<select name="category" onchange="this.form.submit()" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
						<option value="">Tüm Kategoriler</option>
						@foreach($categories as $c)
							<option value="{{ $c->id }}" {{ request('category')==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
						@endforeach
					</select>
				</form>
				<form class="col-span-1">
					<select name="when" onchange="this.form.submit()" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
						<option value="upcoming" {{ request('when','upcoming')==='upcoming' ? 'selected' : '' }}>Yaklaşan</option>
						<option value="past" {{ request('when')==='past' ? 'selected' : '' }}>Geçmiş</option>
					</select>
				</form>
			</div>
		</div>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
		@forelse($events as $event)
			<div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-xl transition-all">
				<a href="{{ route('events.show', $event) }}" class="block relative h-40 bg-gradient-to-br from-blue-50 to-purple-50">
					@if($event->media_url)
						<img src="{{ $event->media_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
					@else
						<div class="w-full h-full flex items-center justify-center">
							<svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
						</div>
					@endif
					<div class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/95 rounded-full text-xs font-bold text-gray-900">
						<span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
						{{ $event->category?->name ?? 'Genel' }}
					</div>
				</a>
				<div class="p-6">
					<a href="{{ route('events.show', $event) }}" class="block">
						<h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-700 transition-colors line-clamp-2">{{ $event->title }}</h3>
					</a>
					<p class="text-sm text-gray-600 line-clamp-2 mt-2">{{ Str::limit(strip_tags($event->description), 110) }}</p>
					<div class="mt-4 flex items-center justify-between text-sm text-gray-600">
						<div class="flex items-center gap-2">
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
							<span>{{ $event->event_date->format('d M Y H:i') }}</span>
						</div>
						@if($event->location)
							<div class="flex items-center gap-2">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c-4.418 0-8 2.239-8 5v2h16v-2c0-2.761-3.582-5-8-5z"/></svg>
								<span>{{ $event->location }}</span>
							</div>
						@endif
				</div>
				<a href="{{ route('events.show', $event) }}" class="inline-flex items-center text-blue-600 font-semibold text-sm hover:text-blue-700">
					Detaylar
					<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</a>
			</div>
		@empty
			<div class="col-span-full text-center py-16 text-gray-500">Etkinlik bulunamadı.</div>
		@endforelse
	</div>

	<div class="mt-10">{{ $events->links() }}</div>
@endsection


