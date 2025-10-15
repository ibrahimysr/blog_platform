@extends('layouts.admin')

@section('title', 'Yazılar')

@section('content')
	<!-- Page Header -->
	<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
		<div>
			<h1 class="text-3xl font-bold text-gray-900">Yazılar</h1>
			<p class="mt-1 text-sm text-gray-500">Tüm blog yazılarınızı yönetin</p>
		</div>
		<div class="mt-4 md:mt-0">
			<a href="{{ route('admin.posts.create') }}" 
			   class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
				<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
				</svg>
				Yeni Yazı
			</a>
		</div>
	</div>

	<!-- Stats Cards -->
	<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
		<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-600">Toplam Yazı</p>
					<p class="text-2xl font-bold text-gray-900 mt-1">{{ $posts->total() }}</p>
				</div>
				<div class="p-3 bg-blue-50 rounded-lg">
					<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
					</svg>
				</div>
			</div>
		</div>
		
		<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-600">Yayınlanan</p>
					<p class="text-2xl font-bold text-green-600 mt-1">{{ $posts->where('status', 'published')->count() }}</p>
				</div>
				<div class="p-3 bg-green-50 rounded-lg">
					<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
					</svg>
				</div>
			</div>
		</div>
		
		<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-600">Taslak</p>
					<p class="text-2xl font-bold text-yellow-600 mt-1">{{ $posts->where('status', 'draft')->count() }}</p>
				</div>
				<div class="p-3 bg-yellow-50 rounded-lg">
					<svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
					</svg>
				</div>
			</div>
		</div>
		
		<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-600">Bu Ay</p>
					<p class="text-2xl font-bold text-purple-600 mt-1">{{ $posts->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
				</div>
				<div class="p-3 bg-purple-50 rounded-lg">
					<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
					</svg>
				</div>
			</div>
		</div>
	</div>

	<!-- Filters -->
	<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
		<div class="flex flex-col md:flex-row md:items-center gap-4">
			<div class="flex-1">
				<div class="relative">
					<input type="search" 
					       placeholder="Yazı başlığı veya içerik ara..." 
					       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
					<svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
					</svg>
				</div>
			</div>
			<div class="flex gap-2">
				<select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
					<option>Tüm Durumlar</option>
					<option>Yayınlanan</option>
					<option>Taslak</option>
				</select>
				<select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
					<option>Tüm Kategoriler</option>
				</select>
			</div>
		</div>
	</div>

	<!-- Posts Table -->
	@if ($posts->count() === 0)
		<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
			<svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
			</svg>
			<h3 class="text-lg font-medium text-gray-900 mb-2">Henüz yazı yok</h3>
			<p class="text-gray-500 mb-6">İlk blog yazınızı oluşturarak başlayın</p>
			<a href="{{ route('admin.posts.create') }}" 
			   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
				<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
				</svg>
				Yeni Yazı Oluştur
			</a>
		</div>
	@else
		<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
							Yazı
						</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
							Kategori
						</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
							Durum
						</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
							Yayın Tarihi
						</th>
						<th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
							İşlemler
						</th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y divide-gray-200">
					@foreach ($posts as $post)
						<tr class="hover:bg-gray-50 transition">
							<td class="px-6 py-4">
								<div class="flex items-center">
									<div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded-lg overflow-hidden">
										@if($post->featured_image)
											<img src="{{ $post->featured_image }}" alt="" class="h-full w-full object-cover">
										@else
											<div class="h-full w-full flex items-center justify-center">
												<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
												</svg>
											</div>
										@endif
									</div>
									<div class="ml-4">
										<a href="{{ route('admin.posts.show', $post) }}" 
										   class="text-sm font-medium text-gray-900 hover:text-blue-600">
											{{ $post->title }}
										</a>
										<div class="text-sm text-gray-500">
											{{ Str::limit($post->excerpt ?? $post->content, 60) }}
										</div>
									</div>
								</div>
							</td>
							<td class="px-6 py-4 whitespace-nowrap">
								@if($post->category)
									<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
										{{ $post->category->name }}
									</span>
								@else
									<span class="text-sm text-gray-400">-</span>
								@endif
							</td>
							<td class="px-6 py-4 whitespace-nowrap">
								@if($post->status === 'published')
									<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
										<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
											<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
										</svg>
										Yayında
									</span>
								@elseif($post->status === 'draft')
									<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
										<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
											<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
										</svg>
										Taslak
									</span>
								@else
									<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
										{{ ucfirst($post->status) }}
									</span>
								@endif
							</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
								{{ optional($post->published_at)->format('d M Y') ?? '-' }}
								<div class="text-xs text-gray-400">
									{{ optional($post->published_at)->format('H:i') }}
								</div>
							</td>
							<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
								<div class="flex items-center justify-end gap-2">
									<a href="{{ route('admin.posts.show', $post) }}" 
									   class="text-gray-600 hover:text-gray-900" 
									   title="Görüntüle">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
										</svg>
									</a>
									<a href="{{ route('admin.posts.edit', $post) }}" 
									   class="text-blue-600 hover:text-blue-900" 
									   title="Düzenle">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
										</svg>
									</a>
									<form method="POST" action="{{ route('admin.posts.destroy', $post) }}" 
									      onsubmit="return confirm('Bu yazıyı silmek istediğinize emin misiniz?');">
										@csrf
										@method('DELETE')
										<button type="submit" 
										        class="text-red-600 hover:text-red-900" 
										        title="Sil">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
											</svg>
										</button>
									</form>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<!-- Pagination -->
		<div class="mt-6">
			{{ $posts->links() }}
		</div>
	@endif
@endsection