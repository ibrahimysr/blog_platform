@extends('layouts.admin')

@section('title', 'Yeni Yazı')

@section('content')
	<!-- Page Header -->
	<div class="flex items-center justify-between mb-8">
		<div class="flex items-center space-x-4">
			<a href="{{ route('admin.posts.index') }}" 
			   class="text-gray-500 hover:text-gray-700">
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
				</svg>
			</a>
			<div>
				<h1 class="text-3xl font-bold text-gray-900">Yeni Yazı Oluştur</h1>
				<p class="mt-1 text-sm text-gray-500">Yeni bir blog yazısı ekleyin</p>
			</div>
		</div>
		<div class="flex items-center space-x-3">
			<button type="button" onclick="document.getElementById('post-form').dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }))" 
			        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium">
				Taslak Olarak Kaydet
			</button>
			<button type="submit" form="post-form" 
			        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm">
				Yayınla
			</button>
		</div>
	</div>

	<form id="post-form" method="POST" action="{{ route('admin.posts.store') }}">
		@csrf
		
		<div class="grid grid-cols-12 gap-6">
			<!-- Main Content -->
			<div class="col-span-12 lg:col-span-8 space-y-6">
				<!-- Basic Info Card -->
				<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
					<h2 class="text-lg font-semibold text-gray-900 mb-4">Temel Bilgiler</h2>
					
					<div class="space-y-4">
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-2">
								Başlık <span class="text-red-500">*</span>
							</label>
							<input type="text" 
							       name="title" 
							       value="{{ old('title') }}" 
							       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
							       placeholder="Yazı başlığını girin">
							@error('title')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label class="block text-sm font-medium text-gray-700 mb-2">
								Kısa İsim (Slug)
							</label>
							<input type="text" 
							       name="slug" 
							       value="{{ old('slug') }}" 
							       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
							       placeholder="ornek-yazi-basligi">
							<p class="mt-1 text-xs text-gray-500">URL'de görünecek kısa isim. Boş bırakırsanız otomatik oluşturulur.</p>
							@error('slug')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label class="block text-sm font-medium text-gray-700 mb-2">
								Özet
							</label>
							<textarea name="excerpt" 
							          rows="3" 
							          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
							          placeholder="Yazınızın kısa bir özetini girin">{{ old('excerpt') }}</textarea>
							<p class="mt-1 text-xs text-gray-500">Liste görünümünde ve sosyal medyada görünecek özet.</p>
							@error('excerpt')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
					</div>
				</div>

				<!-- Content Card -->
				<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
					<h2 class="text-lg font-semibold text-gray-900 mb-4">İçerik</h2>
					
					<div>
						<textarea name="content" 
						          id="content-editor"
						          rows="15" 
						          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
						          placeholder="Yazı içeriğini buraya girin...">{{ old('content') }}</textarea>
						@error('content')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<!-- Media Card -->
				<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
					<div class="flex items-center justify-between mb-4">
						<h2 class="text-lg font-semibold text-gray-900">Medya Dosyaları</h2>
						<button type="button" 
						        id="add-media" 
						        class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
							<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
							</svg>
							Medya Ekle
						</button>
					</div>
					
					<div id="media-list" class="space-y-3">
						<!-- Media items will be added here dynamically -->
					</div>
					
					<div id="media-empty" class="text-center py-8 text-gray-500">
						<svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
						</svg>
						<p class="text-sm">Henüz medya eklenmedi</p>
						<p class="text-xs text-gray-400 mt-1">Görsel veya video eklemek için yukarıdaki butona tıklayın</p>
					</div>
				</div>
			</div>

			<!-- Sidebar -->
			<div class="col-span-12 lg:col-span-4 space-y-6">
				<!-- Publish Settings -->
				<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
					<h3 class="text-sm font-semibold text-gray-900 mb-4">Yayın Ayarları</h3>
					
					<div class="space-y-4">
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-2">
								Durum
							</label>
							<select name="status" 
							        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
								<option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Taslak</option>
								<option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Yayınlandı</option>
								<option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Arşivlendi</option>
							</select>
						</div>

						<div>
							<label class="block text-sm font-medium text-gray-700 mb-2">
								Yayın Tarihi
							</label>
							<input type="datetime-local" 
							       name="published_at" 
							       value="{{ old('published_at') }}" 
							       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
							<p class="mt-1 text-xs text-gray-500">Boş bırakırsanız şimdi yayınlanır</p>
						</div>

						<div>
							<label class="block text-sm font-medium text-gray-700 mb-2">
								Okuma Süresi (dk)
							</label>
							<input type="number" 
							       min="0" 
							       name="reading_time" 
							       value="{{ old('reading_time', 5) }}" 
							       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
						</div>
					</div>
				</div>

				<!-- Categories -->
				<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
					<h3 class="text-sm font-semibold text-gray-900 mb-4">Kategoriler</h3>
					
					<div class="space-y-2 max-h-64 overflow-y-auto">
						@forelse ($categories as $category)
							<label class="flex items-center p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
								<input type="checkbox" 
								       name="category_ids[]" 
								       value="{{ $category->id }}" 
								       {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
								       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
								<span class="ml-2 text-sm text-gray-700">{{ $category->name }}</span>
							</label>
						@empty
							<p class="text-sm text-gray-500 text-center py-4">Henüz kategori yok</p>
							<a href="{{ route('admin.categories.create') }}" 
							   class="block text-center text-sm text-blue-600 hover:text-blue-700">
								Kategori Oluştur
							</a>
						@endforelse
					</div>
				</div>

				<!-- SEO Preview -->
				<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
					<h3 class="text-sm font-semibold text-gray-900 mb-4">SEO Önizleme</h3>
					
					<div class="space-y-2">
						<div class="text-sm text-blue-600 truncate" id="seo-url">
							{{ url('/blog/') }}/ornek-yazi
						</div>
						<div class="text-base font-medium text-gray-900" id="seo-title">
							Yazı Başlığı
						</div>
						<div class="text-sm text-gray-600 line-clamp-2" id="seo-desc">
							Yazı özeti buraya gelecek...
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<script>
		let mediaIndex = 0;

		// Add media button handler
		document.getElementById('add-media').addEventListener('click', function () {
			const mediaList = document.getElementById('media-list');
			const emptyState = document.getElementById('media-empty');
			
			if (emptyState) {
				emptyState.style.display = 'none';
			}
			
			const div = document.createElement('div');
			div.className = 'media-item bg-gray-50 border border-gray-200 rounded-lg p-4';
			div.innerHTML = `
				<div class="flex items-start justify-between mb-3">
					<h4 class="text-sm font-medium text-gray-700">Medya #${mediaIndex + 1}</h4>
					<button type="button" onclick="this.closest('.media-item').remove(); checkMediaEmpty();" 
					        class="text-red-600 hover:text-red-700">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
						</svg>
					</button>
				</div>
				<div class="grid grid-cols-2 gap-3">
					<div class="col-span-2">
						<label class="block text-xs font-medium text-gray-700 mb-1">Tür</label>
						<select name="media[${mediaIndex}][type]" 
						        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
							<option value="0">Görsel</option>
							<option value="1">Video</option>
							<option value="2">Diğer</option>
						</select>
					</div>
					<div class="col-span-2">
						<label class="block text-xs font-medium text-gray-700 mb-1">Bağlantı (URL)</label>
						<input type="url" 
						       name="media[${mediaIndex}][url]" 
						       placeholder="https://example.com/image.jpg" 
						       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
					</div>
					<div>
						<label class="block text-xs font-medium text-gray-700 mb-1">Alt Metin</label>
						<input type="text" 
						       name="media[${mediaIndex}][alt]" 
						       placeholder="Görsel açıklaması" 
						       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
					</div>
					<div>
						<label class="block text-xs font-medium text-gray-700 mb-1">Sıra</label>
						<input type="number" 
						       name="media[${mediaIndex}][sort_order]" 
						       value="0" 
						       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
					</div>
					<div class="col-span-2">
						<label class="block text-xs font-medium text-gray-700 mb-1">Açıklama</label>
						<input type="text" 
						       name="media[${mediaIndex}][caption]" 
						       placeholder="Opsiyonel açıklama" 
						       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm" />
					</div>
					<div class="col-span-2">
						<label class="inline-flex items-center">
							<input type="checkbox" 
							       name="media[${mediaIndex}][is_primary]" 
							       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
							<span class="ml-2 text-sm text-gray-700">Kapak görseli olarak kullan</span>
						</label>
					</div>
				</div>
			`;
			mediaList.appendChild(div);
			mediaIndex++;
		});

		function checkMediaEmpty() {
			const mediaList = document.getElementById('media-list');
			const emptyState = document.getElementById('media-empty');
			if (mediaList.children.length === 0 && emptyState) {
				emptyState.style.display = 'block';
			}
		}

		// SEO Preview updates
		document.querySelector('input[name="title"]')?.addEventListener('input', function(e) {
			document.getElementById('seo-title').textContent = e.target.value || 'Yazı Başlığı';
		});

		document.querySelector('input[name="slug"]')?.addEventListener('input', function(e) {
			const slug = e.target.value || 'ornek-yazi';
			document.getElementById('seo-url').textContent = '{{ url("/blog/") }}/' + slug;
		});

		document.querySelector('textarea[name="excerpt"]')?.addEventListener('input', function(e) {
			document.getElementById('seo-desc').textContent = e.target.value || 'Yazı özeti buraya gelecek...';
		});

		// TinyMCE Editor
		tinymce.init({
			selector: '#content-editor',
			height: 500,
			menubar: false,
			plugins: [
				'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
				'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
				'insertdatetime', 'media', 'table', 'help', 'wordcount'
			],
			toolbar: 'undo redo | blocks | ' +
				'bold italic backcolor | alignleft aligncenter ' +
				'alignright alignjustify | bullist numlist outdent indent | ' +
				'removeformat | help',
			content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
			language: 'tr',
			license_key: 'gpl',
			setup: function (editor) {
				editor.on('change', function () {
					editor.save();
				});
			}
		});
	</script>
@endsection