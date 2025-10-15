@extends('layouts.admin')

@section('title', 'Kategoriler')

@section('content')
	<div class="flex items-center justify-between mb-4">
		<h1 class="text-2xl font-semibold">Kategoriler</h1>
		<a href="{{ route('admin.categories.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Yeni Kategori</a>
	</div>
	@if ($categories->count() === 0)
		<div class="text-gray-600">Henüz kategori yok.</div>
	@else
		<table class="w-full bg-white border">
			<thead>
				<tr class="text-left">
					<th class="p-2 border-b">Ad</th>
					<th class="p-2 border-b">Slug</th>
					<th class="p-2 border-b">Üst Kategori</th>
					<th class="p-2 border-b w-40">İşlemler</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $cat)
					<tr>
						<td class="p-2 border-b">{{ $cat->name }}</td>
						<td class="p-2 border-b">{{ $cat->slug }}</td>
						<td class="p-2 border-b">{{ optional($cat->parent)->name }}</td>
						<td class="p-2 border-b">
							<a href="{{ route('admin.categories.edit', $cat) }}" class="px-2 py-1 border rounded">Düzenle</a>
							<form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline">
								@csrf
								@method('DELETE')
								<button class="px-2 py-1 border rounded text-red-600">Sil</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="mt-4">{{ $categories->links() }}</div>
	@endif
@endsection
