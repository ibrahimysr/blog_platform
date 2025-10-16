@extends('layouts.admin')

@section('title', 'Yönetim Paneli')

@section('content')
	<h1 class="text-2xl font-semibold mb-4">Yönetim Paneli</h1>
	<div class="grid grid-cols-3 gap-4">
		<a href="{{ route('admin.posts.index') }}" class="p-4 bg-white border rounded">
			<div class="font-medium">Bloglar</div>
			<div class="text-sm text-gray-500">Bloglarınızı yönetin</div>
		</a>
		<div class="p-4 bg-white border rounded">
			<div class="font-medium">Kategoriler</div>
			<div class="text-sm text-gray-500">Yakında</div>
		</div>
		<div class="p-4 bg-white border rounded">
			<div class="font-medium">Etkinlikler</div>
			<div class="text-sm text-gray-500">Yakında</div>
		</div>
	</div>
@endsection
