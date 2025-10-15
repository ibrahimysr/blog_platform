<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Admin')</title>
	<script src="https://cdn.tailwindcss.com"></script>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@yield('meta')
</head>
<body class="min-h-screen bg-white text-gray-900">
	<nav class="bg-white border-b">
		<div class="container mx-auto px-4 py-3 flex items-center justify-between">
			<a href="{{ route('admin.dashboard') }}" class="font-semibold">Yönetim</a>
			<div class="space-x-4">
				<a href="{{ route('admin.posts.index') }}">Yazılar</a>
				<a href="#">Kategoriler</a>
				<a href="#">Etkinlikler</a>
			</div>
		</div>
	</nav>
	@if (session('status'))
		<div class="container mx-auto px-4 py-2">
			<div class="bg-green-50 text-green-800 px-4 py-2 rounded">
				{{ session('status') }}
			</div>
		</div>
	@endif
	<div class="container mx-auto px-4 py-6">
		<div class="grid grid-cols-12 gap-6">
			<aside class="col-span-3">
				<ul class="space-y-2">
					<li><a href="{{ route('admin.posts.index') }}">Yazılar</a></li>
					<li><a href="#">Kategoriler</a></li>
					<li><a href="#">Etkinlikler</a></li>
				</ul>
			</aside>
			<main class="col-span-9">
				@yield('content')
			</main>
		</div>
	</div>
	<footer class="border-t mt-10">
		<div class="container mx-auto px-4 py-6 text-sm text-gray-500">
			© {{ date('Y') }} Admin
		</div>
	</footer>
</body>
</html>
