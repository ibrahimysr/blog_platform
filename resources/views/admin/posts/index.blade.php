@extends('layouts.admin')

@section('title', 'Yazılar')

@section('content')
	<div class="flex items-center justify-between mb-4">
		<h1 class="text-2xl font-semibold">Yazılar</h1>
		<a href="{{ route('admin.posts.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Yeni Yazı</a>
	</div>

	@if ($posts->count() === 0)
		<div class="text-gray-600">Henüz yazı yok.</div>
	@else
		<div class="space-y-3">
			@foreach ($posts as $post)
				<div class="p-4 bg-white rounded border flex items-center justify-between">
					<div>
						<a href="{{ route('admin.posts.show', $post) }}" class="font-medium">{{ $post->title }}</a>
						<div class="text-sm text-gray-500">{{ $post->slug }} • Durum: {{ $post->status }} • {{ optional($post->published_at)->format('Y-m-d H:i') }}</div>
					</div>
					<div class="flex items-center gap-2">
						<a href="{{ route('admin.posts.edit', $post) }}" class="px-2 py-1 border rounded">Düzenle</a>
						<form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
							@csrf
							@method('DELETE')
							<button type="submit" class="px-2 py-1 border rounded text-red-600">Sil</button>
						</form>
					</div>
				</div>
			@endforeach
		</div>

		<div class="mt-6">
			{{ $posts->links() }}
		</div>
	@endif
@endsection
