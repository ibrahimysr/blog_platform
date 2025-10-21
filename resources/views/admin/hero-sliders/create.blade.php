@extends('layouts.admin')

@section('title', 'Yeni Hero Slider Ekle')

@section('content')
	<!-- Page Header -->
	<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
		<div>
			<h1 class="text-3xl font-bold text-gray-900">Yeni Hero Slider</h1>
			<p class="mt-1 text-sm text-gray-500">Ana sayfa için yeni slider ekleyin</p>
		</div>
		<div class="mt-4 md:mt-0">
			<a href="{{ route('admin.hero-sliders.index') }}" 
			   class="inline-flex items-center px-4 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition shadow-sm">
				<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
				</svg>
				Geri Dön
			</a>
		</div>
	</div>

	<!-- Form -->
	<div class="bg-white rounded-lg shadow-sm border border-gray-200">
		<form action="{{ route('admin.hero-sliders.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
			@csrf
			
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
				<!-- Main Form -->
				<div class="lg:col-span-2 space-y-6">
					<div>
						<label for="title" class="block text-sm font-medium text-gray-700 mb-2">
							Başlık <span class="text-gray-400">(Opsiyonel)</span>
						</label>
						<input type="text" 
							   id="title" 
							   name="title" 
							   value="{{ old('title') }}"
							   placeholder="Slider başlığı"
							   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror">
						@error('title')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>

					<div>
						<label for="description" class="block text-sm font-medium text-gray-700 mb-2">
							Açıklama <span class="text-gray-400">(Opsiyonel)</span>
						</label>
						<textarea id="description" 
								  name="description" 
								  rows="4" 
								  placeholder="Slider açıklaması"
								  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
						@error('description')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">
								Buton Metni <span class="text-gray-400">(Opsiyonel)</span>
							</label>
							<input type="text" 
								   id="button_text" 
								   name="button_text" 
								   value="{{ old('button_text') }}"
								   placeholder="Örn: Detayları Gör"
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('button_text') border-red-500 @enderror">
							@error('button_text')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label for="button_url" class="block text-sm font-medium text-gray-700 mb-2">
								Buton URL <span class="text-gray-400">(Opsiyonel)</span>
							</label>
							<input type="url" 
								   id="button_url" 
								   name="button_url" 
								   value="{{ old('button_url') }}"
								   placeholder="https://example.com"
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('button_url') border-red-500 @enderror">
							@error('button_url')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
								Sıra Numarası
							</label>
							<input type="number" 
								   id="sort_order" 
								   name="sort_order" 
								   value="{{ old('sort_order', 0) }}"
								   min="0"
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-500 @enderror">
							@error('sort_order')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div class="flex items-center">
							<div class="flex items-center h-10">
								<input type="checkbox" 
									   id="is_active" 
									   name="is_active" 
									   value="1" 
									   {{ old('is_active', true) ? 'checked' : '' }}
									   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
								<label for="is_active" class="ml-2 block text-sm text-gray-700">
									Aktif
								</label>
							</div>
						</div>
					</div>
				</div>

				<!-- Image Upload -->
				<div class="space-y-6">
					<!-- Desktop Image -->
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-3">Desktop Resmi <span class="text-red-500">*</span></label>
						
						<!-- Image Type Selection -->
						<div class="flex space-x-4 mb-4">
							<label class="flex items-center">
								<input type="radio" 
									   name="image_type" 
									   value="upload" 
									   {{ old('image_type', 'upload') === 'upload' ? 'checked' : '' }}
									   onchange="toggleImageType()"
									   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
								<span class="ml-2 text-sm text-gray-700">Dosya Yükle</span>
							</label>
							<label class="flex items-center">
								<input type="radio" 
									   name="image_type" 
									   value="url" 
									   {{ old('image_type') === 'url' ? 'checked' : '' }}
									   onchange="toggleImageType()"
									   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
								<span class="ml-2 text-sm text-gray-700">URL Kullan</span>
							</label>
						</div>

						<!-- File Upload -->
						<div id="file-upload-section" class="space-y-3">
							<input type="file" 
								   id="image_file" 
								   name="image_file" 
								   accept="image/*"
								   onchange="previewImage(this)"
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image_file') border-red-500 @enderror">
							@error('image_file')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="text-xs text-gray-500">
								Desteklenen formatlar: JPEG, PNG, JPG, GIF. Maksimum boyut: 10MB
							</p>
						</div>

						<!-- URL Input -->
						<div id="url-input-section" class="space-y-3" style="display: none;">
							<input type="url" 
								   id="image_url" 
								   name="image_url" 
								   value="{{ old('image_url') }}"
								   placeholder="https://example.com/image.jpg"
								   onchange="previewImageUrl(this)"
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image_url') border-red-500 @enderror">
							@error('image_url')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
					</div>

					<div id="image-preview" class="hidden">
						<label class="block text-sm font-medium text-gray-700 mb-2">Desktop Önizleme</label>
						<div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
							<img id="preview-img" src="" alt="Desktop Önizleme" class="w-full h-48 object-cover rounded-lg">
						</div>
					</div>

					<!-- Mobile Image -->
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-3">Mobile Resmi <span class="text-red-500">*</span></label>
						
						<!-- Mobile Image Type Selection -->
						<div class="flex space-x-4 mb-4">
							<label class="flex items-center">
								<input type="radio" 
									   name="mobile_image_type" 
									   value="upload" 
									   {{ old('mobile_image_type', 'upload') === 'upload' ? 'checked' : '' }}
									   onchange="toggleMobileImageType()"
									   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
								<span class="ml-2 text-sm text-gray-700">Dosya Yükle</span>
							</label>
							<label class="flex items-center">
								<input type="radio" 
									   name="mobile_image_type" 
									   value="url" 
									   {{ old('mobile_image_type') === 'url' ? 'checked' : '' }}
									   onchange="toggleMobileImageType()"
									   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
								<span class="ml-2 text-sm text-gray-700">URL Kullan</span>
							</label>
						</div>

						<!-- Mobile File Upload -->
						<div id="mobile-file-upload-section" class="space-y-3">
							<input type="file" 
								   id="mobile_image_file" 
								   name="mobile_image_file" 
								   accept="image/*"
								   onchange="previewMobileImage(this)"
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mobile_image_file') border-red-500 @enderror">
							@error('mobile_image_file')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
							<p class="text-xs text-gray-500">
								Desteklenen formatlar: JPEG, PNG, JPG, GIF. Maksimum boyut: 10MB
							</p>
						</div>

						<!-- Mobile URL Input -->
						<div id="mobile-url-input-section" class="space-y-3" style="display: none;">
							<input type="url" 
								   id="mobile_image_url" 
								   name="mobile_image_url" 
								   value="{{ old('mobile_image_url') }}"
								   placeholder="https://example.com/mobile-image.jpg"
								   onchange="previewMobileImageUrl(this)"
								   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mobile_image_url') border-red-500 @enderror">
							@error('mobile_image_url')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
					</div>

					<div id="mobile-image-preview" class="hidden">
						<label class="block text-sm font-medium text-gray-700 mb-2">Mobile Önizleme</label>
						<div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
							<img id="mobile-preview-img" src="" alt="Mobile Önizleme" class="w-full h-48 object-cover rounded-lg">
						</div>
					</div>
				</div>
			</div>

			<!-- Form Actions -->
			<div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
				<a href="{{ route('admin.hero-sliders.index') }}" 
				   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
					İptal
				</a>
				<button type="submit" 
						class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
					Kaydet
				</button>
			</div>
		</form>
	</div>

	<script>
	function toggleImageType() {
		const fileSection = document.getElementById('file-upload-section');
		const urlSection = document.getElementById('url-input-section');
		const uploadRadio = document.querySelector('input[name="image_type"][value="upload"]');
		
		if (uploadRadio.checked) {
			fileSection.style.display = 'block';
			urlSection.style.display = 'none';
		} else {
			fileSection.style.display = 'none';
			urlSection.style.display = 'block';
		}
	}

	function toggleMobileImageType() {
		const fileSection = document.getElementById('mobile-file-upload-section');
		const urlSection = document.getElementById('mobile-url-input-section');
		const uploadRadio = document.querySelector('input[name="mobile_image_type"][value="upload"]');
		
		if (uploadRadio.checked) {
			fileSection.style.display = 'block';
			urlSection.style.display = 'none';
		} else {
			fileSection.style.display = 'none';
			urlSection.style.display = 'block';
		}
	}

	function previewImage(input) {
		if (input.files && input.files[0]) {
			const reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('preview-img').src = e.target.result;
				document.getElementById('image-preview').classList.remove('hidden');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	function previewImageUrl(input) {
		if (input.value) {
			document.getElementById('preview-img').src = input.value;
			document.getElementById('image-preview').classList.remove('hidden');
		} else {
			document.getElementById('image-preview').classList.add('hidden');
		}
	}

	function previewMobileImage(input) {
		if (input.files && input.files[0]) {
			const reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('mobile-preview-img').src = e.target.result;
				document.getElementById('mobile-image-preview').classList.remove('hidden');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	function previewMobileImageUrl(input) {
		if (input.value) {
			document.getElementById('mobile-preview-img').src = input.value;
			document.getElementById('mobile-image-preview').classList.remove('hidden');
		} else {
			document.getElementById('mobile-image-preview').classList.add('hidden');
		}
	}

	// Initialize on page load
	document.addEventListener('DOMContentLoaded', function() {
		toggleImageType();
		toggleMobileImageType();
	});
	</script>
@endsection
