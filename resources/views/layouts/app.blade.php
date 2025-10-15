<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Blog')</title>
	<script src="https://cdn.tailwindcss.com"></script>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@yield('meta')
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
	<nav class="bg-white border-b">
		<div class="container mx-auto px-4 py-3 flex items-center justify-between">
			<a href="/" class="font-semibold">Blog</a>
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
	<main class="container mx-auto px-4 py-6">
		@yield('content')
	</main>
	<footer class="border-t mt-10">
		<div class="container mx-auto px-4 py-6 text-sm text-gray-500">
			© {{ date('Y') }} Blog
		</div>
	</footer>
</body>
</html>
