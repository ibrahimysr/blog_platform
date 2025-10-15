@extends('layouts.admin')

@section('title', 'Yazıyı Düzenle')

@section('content')
	<h1 class="text-2xl font-semibold mb-4">Yazıyı Düzenle</h1>
    @if ($errors->any())
    <div class="bg-red-50 text-red-800 px-4 py-3 rounded mb-4">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
	<form method="POST" action="{{ route('admin.posts.update', $post) }}" class="space-y-4">
		@csrf
		@method('PUT')
		<div>
			<label class="block text-sm mb-1">Başlık</label>
			<input name="title" value="{{ old('title', $post->title) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Kısa İsim (Slug)</label>
			<input name="slug" value="{{ old('slug', $post->slug) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Özet</label>
			<textarea name="excerpt" class="w-full border rounded px-3 py-2" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
		</div>
		<div>
			<label class="block text-sm mb-1">İçerik</label>
			<textarea name="content" class="w-full border rounded px-3 py-2" rows="8">{{ old('content', $post->content) }}</textarea>
		</div>
		<div class="grid grid-cols-3 gap-4">
			<div>
				<label class="block text-sm mb-1">Durum</label>
				<select name="status" class="w-full border rounded px-3 py-2">
					<option value="0" @selected($post->status==0)>Taslak</option>
					<option value="1" @selected($post->status==1)>Yayınlandı</option>
					<option value="2" @selected($post->status==2)>Arşivlendi</option>
				</select>
			</div>
			<div>
				<label class="block text-sm mb-1">Yayın Tarihi</label>
				<input type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
			</div>
			<div>
				<label class="block text-sm mb-1">Okuma Süresi</label>
				<input type="number" min="0" name="reading_time" value="{{ old('reading_time', $post->reading_time) }}" class="w-full border rounded px-3 py-2">
			</div>
		</div>
		<div>
			<label class="block text-sm mb-1">Kategoriler</label>
			<select name="category_ids[]" multiple class="w-full border rounded px-3 py-2">
				@foreach ($categories as $category)
					<option value="{{ $category->id }}" @selected($post->categories->contains($category->id))>{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="space-y-2">
			<div class="font-medium">Medya</div>
			<div id="media-list" class="space-y-2">
				@foreach ($post->media as $i => $m)
					<div class="media-item grid grid-cols-6 gap-2">
						<select name="media[{{ $i }}][type]" class="border rounded px-2 py-1">
							<option value="0" @selected($m->type==0)>Görsel</option>
							<option value="1" @selected($m->type==1)>Video</option>
							<option value="2" @selected($m->type==2)>Diğer</option>
						</select>
						<input name="media[{{ $i }}][url]" value="{{ $m->url }}" class="col-span-2 border rounded px-2 py-1" placeholder="Bağlantı (URL)" />
						<input name="media[{{ $i }}][alt]" value="{{ $m->alt }}" class="border rounded px-2 py-1" placeholder="Alt Metin" />
						<input name="media[{{ $i }}][caption]" value="{{ $m->caption }}" class="border rounded px-2 py-1" placeholder="Açıklama" />
						<input type="number" name="media[{{ $i }}][sort_order]" value="{{ $m->sort_order }}" class="border rounded px-2 py-1" />
						<label class="inline-flex items-center gap-1"><input type="checkbox" name="media[{{ $i }}][is_primary]" @checked($m->is_primary) /> Primary</label>
					</div>
				@endforeach
			</div>
			<button type="button" id="add-media" class="px-3 py-1 border rounded">Medya Ekle</button>
		</div>
		<div>
			<button class="px-4 py-2 bg-blue-600 text-white rounded">Güncelle</button>
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
				<input name="media[${idx}][url]" placeholder="URL" class="col-span-2 border rounded px-2 py-1" />
				<input name="media[${idx}][alt]" placeholder="Alt" class="border rounded px-2 py-1" />
				<input name="media[${idx}][caption]" placeholder="Caption" class="border rounded px-2 py-1" />
				<input type="number" name="media[${idx}][sort_order]" value="0" class="border rounded px-2 py-1" />
				<label class="inline-flex items-center gap-1"><input type="checkbox" name="media[${idx}][is_primary]" /> Primary</label>
			`;
			document.getElementById('media-list').appendChild(div);
		});
	</script>
@endsection
