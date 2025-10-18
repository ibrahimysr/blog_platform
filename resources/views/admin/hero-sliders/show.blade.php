@extends('layouts.admin')

@section('title', 'Hero Slider Detayı')

@section('content')
	<!-- Page Header -->
	<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
		<div>
			<h1 class="text-3xl font-bold text-gray-900">Hero Slider Detayı</h1>
			<p class="mt-1 text-sm text-gray-500">Slider bilgilerini görüntüleyin</p>
		</div>
		<div class="mt-4 md:mt-0 flex space-x-3">
			<a href="{{ route('admin.hero-sliders.edit', $heroSlider) }}" 
			   class="inline-flex items-center px-4 py-2.5 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition shadow-sm">
				<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
				</svg>
				Düzenle
			</a>
			<a href="{{ route('admin.hero-sliders.index') }}" 
			   class="inline-flex items-center px-4 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition shadow-sm">
				<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
				</svg>
				Geri Dön
			</a>
		</div>
	</div>

	<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
		<!-- Slider Information -->
		<div class="lg:col-span-2">
			<div class="bg-white rounded-lg shadow-sm border border-gray-200">
				<div class="px-6 py-4 border-b border-gray-200">
					<h3 class="text-lg font-medium text-gray-900">Slider Bilgileri</h3>
				</div>
				<div class="p-6 space-y-6">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<label class="block text-sm font-medium text-gray-500 mb-1">Başlık</label>
							<p class="text-sm text-gray-900">{{ $heroSlider->title ?: 'Başlık yok' }}</p>
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-500 mb-1">Durum</label>
							@if($heroSlider->is_active)
								<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
									Aktif
								</span>
							@else
								<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
									Pasif
								</span>
							@endif
						</div>
					</div>

					<div>
						<label class="block text-sm font-medium text-gray-500 mb-1">Açıklama</label>
						<p class="text-sm text-gray-900">{{ $heroSlider->description ?: 'Açıklama yok' }}</p>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<label class="block text-sm font-medium text-gray-500 mb-1">Buton Metni</label>
							<p class="text-sm text-gray-900">{{ $heroSlider->button_text ?: 'Buton metni yok' }}</p>
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-500 mb-1">Buton URL</label>
							@if($heroSlider->button_url)
								<a href="{{ $heroSlider->button_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
									{{ $heroSlider->button_url }}
									<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
									</svg>
								</a>
							@else
								<p class="text-sm text-gray-500">Buton URL'i yok</p>
							@endif
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
						<div>
							<label class="block text-sm font-medium text-gray-500 mb-1">Sıra Numarası</label>
							<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
								{{ $heroSlider->sort_order }}
							</span>
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-500 mb-1">Oluşturulma</label>
							<p class="text-sm text-gray-900">{{ $heroSlider->created_at->format('d.m.Y H:i') }}</p>
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-500 mb-1">Son Güncelleme</label>
							<p class="text-sm text-gray-900">{{ $heroSlider->updated_at->format('d.m.Y H:i') }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Image and Actions -->
		<div class="space-y-6">
			<!-- Slider Image -->
			<div class="bg-white rounded-lg shadow-sm border border-gray-200">
				<div class="px-6 py-4 border-b border-gray-200">
					<h3 class="text-lg font-medium text-gray-900">Slider Resmi</h3>
				</div>
				<div class="p-6">
					@if($heroSlider->image)
						<div class="aspect-w-16 aspect-h-9">
							@if(str_starts_with($heroSlider->image, 'http'))
								<img src="{{ $heroSlider->image }}" 
									 alt="{{ $heroSlider->title }}" 
									 class="w-full h-64 object-cover rounded-lg">
							@else
								<img src="{{ asset($heroSlider->image) }}" 
									 alt="{{ $heroSlider->title }}" 
									 class="w-full h-64 object-cover rounded-lg">
							@endif
						</div>
					@else
						<div class="text-center py-12">
							<svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
							</svg>
							<p class="mt-2 text-sm text-gray-500">Resim yüklenmemiş</p>
						</div>
					@endif
				</div>
			</div>

			<!-- Actions -->
			<div class="bg-white rounded-lg shadow-sm border border-gray-200">
				<div class="px-6 py-4 border-b border-gray-200">
					<h3 class="text-lg font-medium text-gray-900">İşlemler</h3>
				</div>
				<div class="p-6 space-y-3">
					<a href="{{ route('admin.hero-sliders.edit', $heroSlider) }}" 
					   class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
						<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
						</svg>
						Düzenle
					</a>
					
					<form action="{{ route('admin.hero-sliders.destroy', $heroSlider) }}" 
						  method="POST" 
						  onsubmit="return confirm('Bu slider\'ı silmek istediğinizden emin misiniz?')">
						@csrf
						@method('DELETE')
						<button type="submit" 
								class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
							<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
							</svg>
							Sil
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
