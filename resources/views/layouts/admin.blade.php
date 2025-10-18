<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Admin Paneli')</title>
	<script src="https://cdn.tailwindcss.com"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/tinymce@6.7.2/tinymce.min.js"></script>
	
	@yield('meta')
</head>
<body class="bg-gray-100">
	<div class="flex min-h-screen">
		<!-- Sidebar -->
		<aside class="w-64 bg-white shadow-sm">
			<div class="p-6">
				<h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
			</div>
			
			<nav class="mt-6">
				<a href="{{ route('admin.posts.index') }}" 
				   class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 border-l-4 {{ request()->routeIs('admin.posts.*') ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent' }}">
					<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
					</svg>
					Blog
				</a>
				
				<a href="{{ route('admin.categories.index') }}" 
				   class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 border-l-4 {{ request()->routeIs('admin.categories.*') ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent' }}">
					<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
					</svg>
					Categori
				</a>
				
				<a href="{{ route('admin.events.index') }}" 
				   class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 border-l-4 {{ request()->routeIs('admin.events.*') ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent' }}">
					<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
					</svg>
					Etkinlikler
				</a>
				
				<a href="/admin/galleries" 
				   class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 border-l-4 {{ request()->routeIs('admin.galleries.*') ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent' }}">
					<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
					</svg>
					Galeri
				</a>
				
				<a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 border-l-4 {{ request()->routeIs('admin.users.*') ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent' }}">
					<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
					</svg>
					Kullanıcılar
				</a>
				
				<a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent">
					<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
					</svg>
					Ayarlar
				</a>
			</nav>
		</aside>

		<!-- Main Content -->
		<div class="flex-1 flex flex-col">
			<!-- Top Header -->
			<header class="bg-white shadow-sm">
				<div class="flex items-center justify-between px-8 py-4">
					<div class="flex items-center space-x-4">
						<button class="text-gray-500 hover:text-gray-700 lg:hidden">
							<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
							</svg>
						</button>
						<div class="relative">
							<input type="search" 
							       placeholder="Search..." 
							       class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600">
							<svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
							</svg>
						</div>
					</div>
					
					<div class="flex items-center space-x-4">
						<button class="relative text-gray-500 hover:text-gray-700">
							<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
							</svg>
							<span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
						</button>
						
						<div class="flex items-center space-x-3">
							<img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=1877F2&color=fff" 
							     class="w-10 h-10 rounded-full" 
							     alt="Profile">
							<div class="hidden md:block">
								<p class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</p>
								<p class="text-xs text-gray-500">Administrator</p>
							</div>
						</div>
						
						<form action="{{ route('logout') }}" method="POST" class="inline">
							@csrf
							<button type="submit" class="text-gray-500 hover:text-gray-700">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
								</svg>
							</button>
						</form>
					</div>
				</div>
			</header>

			<!-- Page Content -->
			<main class="flex-1 overflow-y-auto bg-gray-100 p-8">
				@if (session('status'))
					<div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded mb-6 flex items-start">
						<svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
						</svg>
						<span>{{ session('status') }}</span>
					</div>
				@endif

				@if ($errors->any())
					<div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded mb-6">
						<div class="flex items-start">
							<svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
							</svg>
							<div>
								<h3 class="font-semibold mb-2">Hata oluştu:</h3>
								<ul class="list-disc list-inside space-y-1">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				@endif

				@yield('content')
			</main>
		</div>
	</div>
</body>
</html>