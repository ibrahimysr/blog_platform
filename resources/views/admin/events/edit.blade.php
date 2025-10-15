@extends('layouts.admin')

@section('title', 'Etkinliği Düzenle')

@section('content')
	<h1 class="text-2xl font-semibold mb-4">Etkinliği Düzenle</h1>
	@if ($errors->any())
		<div class="bg-red-50 text-red-800 px-4 py-3 rounded mb-4">{{ $errors->first() }}</div>
	@endif
	<form method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-4">
		@csrf
		@method('PUT')
		<div>
			<label class="block text-sm mb-1">Başlık</label>
			<input name="title" value="{{ old('title', $event->title) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Slug</label>
			<input name="slug" value="{{ old('slug', $event->slug) }}" class="w-full border rounded px-3 py-2" placeholder="(boş bırakabilirsiniz)">
		</div>
		<div>
			<label class="block text-sm mb-1">Tarih</label>
			<input type="datetime-local" name="event_date" value="{{ old('event_date', optional($event->event_date)->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Kategori</label>
			<select name="category_id" class="w-full border rounded px-3 py-2">
				<option value="">— Yok —</option>
				@foreach ($categories as $c)
					<option value="{{ $c->id }}" @selected($event->category_id==$c->id)>{{ $c->name }}</option>
				@endforeach
			</select>
		</div>
		<div>
			<label class="block text-sm mb-1">Konum</label>
			<input name="location" value="{{ old('location', $event->location) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Medya URL</label>
			<input name="media_url" value="{{ old('media_url', $event->media_url) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Açıklama</label>
			<textarea name="description" class="w-full border rounded px-3 py-2" rows="6">{{ old('description', $event->description) }}</textarea>
		</div>
		<button class="px-4 py-2 bg-blue-600 text-white rounded">Güncelle</button>
	</form>
@endsection
