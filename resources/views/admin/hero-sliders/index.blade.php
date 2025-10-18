@extends('layouts.admin')

@section('title', 'Hero Slider Yönetimi')

@section('content')
	<!-- Page Header -->
	<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
		<div>
			<h1 class="text-3xl font-bold text-gray-900">Hero Slider</h1>
			<p class="mt-1 text-sm text-gray-500">Ana sayfa slider'larını yönetin</p>
		</div>
		<div class="mt-4 md:mt-0">
			<a href="{{ route('admin.hero-sliders.create') }}" 
			   class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
				<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
				</svg>
				Yeni Slider
			</a>
		</div>
	</div>

	<!-- Stats Cards -->
	<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
		<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-600">Toplam Slider</p>
					<p class="text-2xl font-bold text-gray-900 mt-1">{{ $sliders->count() }}</p>
				</div>
				<div class="p-3 bg-blue-50 rounded-lg">
					<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
					</svg>
				</div>
			</div>
		</div>
		
		<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-600">Aktif Slider</p>
					<p class="text-2xl font-bold text-green-600 mt-1">{{ $sliders->where('is_active', true)->count() }}</p>
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
					<p class="text-sm font-medium text-gray-600">Pasif Slider</p>
					<p class="text-2xl font-bold text-red-600 mt-1">{{ $sliders->where('is_active', false)->count() }}</p>
				</div>
				<div class="p-3 bg-red-50 rounded-lg">
					<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
					</svg>
				</div>
			</div>
		</div>
		
		<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-600">Butonlu Slider</p>
					<p class="text-2xl font-bold text-purple-600 mt-1">{{ $sliders->whereNotNull('button_text')->whereNotNull('button_url')->count() }}</p>
				</div>
				<div class="p-3 bg-purple-50 rounded-lg">
					<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-.94-2.688M8.05 19.95l2.688.94M19.05 8.05l-2.688-.94M4.05 15.95l.94 2.688"/>
					</svg>
				</div>
			</div>
		</div>
	</div>

	@if(session('success'))
		<div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
			{{ session('success') }}
		</div>
	@endif

	<!-- Sliders Table -->
	<div class="bg-white rounded-lg shadow-sm border border-gray-200">
		@if($sliders->count() > 0)
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resim</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Açıklama</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buton</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sıra</th>
							<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						@foreach($sliders as $slider)
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap">
									@if($slider->image)
										@if(str_starts_with($slider->image, 'http'))
											<img src="{{ $slider->image }}" 
												 alt="{{ $slider->title }}" 
												 class="w-16 h-12 object-cover rounded-lg">
										@else
											<img src="{{ asset($slider->image) }}" 
												 alt="{{ $slider->title }}" 
												 class="w-16 h-12 object-cover rounded-lg">
										@endif
									@else
										<div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
											<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
											</svg>
										</div>
									@endif
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="text-sm font-medium text-gray-900">
										{{ $slider->title ?: 'Başlık Yok' }}
									</div>
								</td>
								<td class="px-6 py-4">
									<div class="text-sm text-gray-500 max-w-xs truncate">
										{{ $slider->description ?: 'Açıklama Yok' }}
									</div>
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									@if($slider->button_text && $slider->button_url)
										<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
											{{ $slider->button_text }}
										</span>
									@else
										<span class="text-sm text-gray-400">-</span>
									@endif
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									@if($slider->is_active)
										<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
											Aktif
										</span>
									@else
										<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
											Pasif
										</span>
									@endif
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
										{{ $slider->sort_order }}
									</span>
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
									<div class="flex space-x-2">
										<a href="{{ route('admin.hero-sliders.show', $slider) }}" 
										   class="text-blue-600 hover:text-blue-900">
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
											</svg>
										</a>
										<a href="{{ route('admin.hero-sliders.edit', $slider) }}" 
										   class="text-indigo-600 hover:text-indigo-900">
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
											</svg>
										</a>
										<form action="{{ route('admin.hero-sliders.destroy', $slider) }}" 
											  method="POST" 
											  class="inline"
											  onsubmit="return confirm('Bu slider\'ı silmek istediğinizden emin misiniz?')">
											@csrf
											@method('DELETE')
											<button type="submit" class="text-red-600 hover:text-red-900">
												<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
		@else
			<div class="text-center py-12">
				<svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
				</svg>
				<h3 class="mt-2 text-sm font-medium text-gray-900">Henüz slider yok</h3>
				<p class="mt-1 text-sm text-gray-500">İlk slider'ınızı eklemek için yukarıdaki butonu kullanın.</p>
			</div>
		@endif
	</div>
@endsection
