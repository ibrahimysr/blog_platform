@extends('layouts.admin')

@section('title', 'Etkinlikler')

@section('content')
	<div class="flex items-center justify-between mb-4">
		<h1 class="text-2xl font-semibold">Etkinlikler</h1>
		<a href="{{ route('admin.events.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Yeni Etkinlik</a>
	</div>
	@if ($events->count() === 0)
		<div class="text-gray-600">Henüz etkinlik yok.</div>
	@else
		<table class="w-full bg-white border">
			<thead>
				<tr class="text-left">
					<th class="p-2 border-b">Başlık</th>
					<th class="p-2 border-b">Tarih</th>
					<th class="p-2 border-b">Kategori</th>
					<th class="p-2 border-b w-40">İşlemler</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($events as $e)
					<tr>
						<td class="p-2 border-b">{{ $e->title }}</td>
						<td class="p-2 border-b">{{ $e->event_date->format('Y-m-d H:i') }}</td>
						<td class="p-2 border-b">{{ optional($e->category)->name }}</td>
						<td class="p-2 border-b">
							<a href="{{ route('admin.events.edit', $e) }}" class="px-2 py-1 border rounded">Düzenle</a>
							<form action="{{ route('admin.events.destroy', $e) }}" method="POST" class="inline">
								@csrf
								@method('DELETE')
								<button class="px-2 py-1 border rounded text-red-600">Sil</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="mt-4">{{ $events->links() }}</div>
	@endif
@endsection
