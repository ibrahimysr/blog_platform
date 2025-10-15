@extends('layouts.admin')

@section('title', $post->title)

@section('content')
	<h1 class="text-2xl font-semibold mb-1">{{ $post->title }}</h1>
	<div class="text-sm text-gray-600 mb-4">{{ $post->slug }} • Durum: {{ $post->status }} • {{ optional($post->published_at)->format('Y-m-d H:i') }}</div>
	<div class="prose max-w-none mb-6">{!! nl2br(e($post->content)) !!}</div>
	@if ($post->media->count())
		<div class="grid grid-cols-3 gap-3 mb-6">
			@foreach ($post->media as $m)
				<div class="border rounded p-2">
					<div class="text-xs text-gray-500">{{ ['Görsel','Video','Diğer'][$m->type] ?? 'Medya' }}</div>
					<div class="truncate">{{ $m->url }}</div>
				</div>
			@endforeach
		</div>
	@endif
	<div class="flex items-center gap-2">
		<a href="{{ route('admin.posts.edit', $post) }}" class="px-3 py-2 border rounded">Düzenle</a>
		<a href="{{ route('admin.posts.index') }}" class="px-3 py-2 border rounded">Geri</a>
	</div>
@endsection
