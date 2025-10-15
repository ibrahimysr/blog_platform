@extends('layouts.admin')

@section('title', 'Yeni Yazı')

@section('content')
	<h1 class="text-2xl font-semibold mb-4">Yeni Yazı</h1>
    @if ($errors->any())
    <div class="bg-red-50 text-red-800 px-4 py-3 rounded mb-4">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
	<form method="POST" action="{{ route('admin.posts.store') }}" class="space-y-4">
		@csrf
		<div>
			<label class="block text-sm mb-1">Başlık</label>
			<input name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Kısa İsim (Slug)</label>
			<input name="slug" value="{{ old('slug') }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Özet</label>
			<textarea name="excerpt" class="w-full border rounded px-3 py-2" rows="3">{{ old('excerpt') }}</textarea>
		</div>
		<div>
			<label class="block text-sm mb-1">İçerik</label>
			<textarea name="content" class="w-full border rounded px-3 py-2" rows="8">{{ old('content') }}</textarea>
		</div>
		<div class="grid grid-cols-3 gap-4">
			<div>
				<label class="block text-sm mb-1">Durum</label>
				<select name="status" class="w-full border rounded px-3 py-2">
					<option value="0">Taslak</option>
					<option value="1">Yayınlandı</option>
					<option value="2">Arşivlendi</option>
				</select>
			</div>
			<div>
				<label class="block text-sm mb-1">Yayın Tarihi</label>
				<input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full border rounded px-3 py-2">
			</div>
			<div>
				<label class="block text-sm mb-1">Okuma Süresi</label>
				<input type="number" min="0" name="reading_time" value="{{ old('reading_time', 0) }}" class="w-full border rounded px-3 py-2">
			</div>
		</div>
		<div>
			<label class="block text-sm mb-1">Kategoriler</label>
			<select name="category_ids[]" multiple class="w-full border rounded px-3 py-2">
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="space-y-2">
			<div class="font-medium">Medya</div>
			<div id="media-list" class="space-y-2"></div>
			<button type="button" id="add-media" class="px-3 py-1 border rounded">Medya Ekle</button>
		</div>
		<div>
			<button class="px-4 py-2 bg-blue-600 text-white rounded">Oluştur</button>
		</div>
	</form>
	<script>
		document.getElementById('add-media').addEventListener('click', function () {
			const idx = document.querySelectorAll('#media-list .media-item').length;
			const div = document.createElement('div');
			div.className = 'media-item grid grid-cols-6 gap-2';
			div.innerHTML = `
				<select name="media[${idx}][type]" class="border rounded px-2 py-1">
					<option value="0">Görsel</option>
					<option value="1">Video</option>
					<option value="2">Diğer</option>
				</select>
				<input name="media[${idx}][url]" placeholder="Bağlantı (URL)" class="col-span-2 border rounded px-2 py-1" />
				<input name="media[${idx}][alt]" placeholder="Alt Metin" class="border rounded px-2 py-1" />
				<input name="media[${idx}][caption]" placeholder="Açıklama" class="border rounded px-2 py-1" />
				<input type="number" name="media[${idx}][sort_order]" value="0" class="border rounded px-2 py-1" />
				<label class="inline-flex items-center gap-1"><input type="checkbox" name="media[${idx}][is_primary]" /> Kapak</label>
			`;
			document.getElementById('media-list').appendChild(div);
		});
	</script>
@endsection
