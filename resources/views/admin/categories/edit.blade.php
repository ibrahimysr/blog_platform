@extends('layouts.admin')

@section('title', 'Kategoriyi Düzenle')

@section('content')
	<h1 class="text-2xl font-semibold mb-4">Kategoriyi Düzenle</h1>
	@if ($errors->any())
		<div class="bg-red-50 text-red-800 px-4 py-3 rounded mb-4">{{ $errors->first() }}</div>
	@endif
	<form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-4">
		@csrf
		@method('PUT')
		<div>
			<label class="block text-sm mb-1">Ad</label>
			<input name="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Slug</label>
			<input name="slug" value="{{ old('slug', $category->slug) }}" class="w-full border rounded px-3 py-2">
		</div>
		<div>
			<label class="block text-sm mb-1">Üst Kategori</label>
			<select name="parent_id" class="w-full border rounded px-3 py-2">
				<option value="">— Yok —</option>
				@foreach ($parents as $p)
					<option value="{{ $p->id }}" @selected($category->parent_id==$p->id)>{{ $p->name }}</option>
				@endforeach
			</select>
		</div>
		<div>
			<label class="block text-sm mb-1">Açıklama</label>
			<textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $category->description) }}</textarea>
		</div>
		<button class="px-4 py-2 bg-blue-600 text-white rounded">Güncelle</button>
	</form>
@endsection
