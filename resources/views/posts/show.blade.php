@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-blue-50">
	<div class="fixed inset-0 overflow-hidden pointer-events-none">
		<div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
		<div class="absolute top-40 right-10 w-72 h-72 bg-blue-500/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
		<div class="absolute bottom-20 left-1/2 w-72 h-72 bg-blue-300/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
	</div>

	<div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		<nav class="flex items-center gap-2 text-sm mb-6 backdrop-blur-sm">
			<a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105">Ana Sayfa</a>
			<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
			</svg>
			<a href="{{ route('posts.list') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105">Bloglar</a>
			<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
			</svg>
			<span class="text-gray-900 font-semibold">{{ Str::limit($post->title, 40) }}</span>
		</nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-12">
				{{-- Hero Card --}}
				<article class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 hover:shadow-blue-500/10 transition-all duration-500">
					{{-- Featured Image with Overlay --}}
					@php $featuredImage = $post->media->firstWhere('is_primary', true) ?: $post->media->first(); @endphp
					@if($featuredImage)
						<div class="relative h-[400px] overflow-hidden group">
							<img src="{{ $featuredImage->url }}" 
							     alt="{{ $featuredImage->alt ?? $post->title }}" 
							     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
							<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
							
							{{-- Floating Category Badges --}}
							@if($post->categories->isNotEmpty())
								<div class="absolute top-6 left-6 flex flex-wrap gap-2">
									@foreach($post->categories->take(3) as $category)
										<span class="px-4 py-2 bg-white/95 backdrop-blur-md text-gray-900 text-xs font-bold rounded-full shadow-lg border border-white/50 hover:scale-105 transition-transform duration-300">
											{{ $category->name }}
										</span>
									@endforeach
								</div>
							@endif

							{{-- Title Overlay --}}
							<div class="absolute bottom-0 left-0 right-0 p-8">
								<h1 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight drop-shadow-2xl">
									{{ $post->title }}
								</h1>
								
								{{-- Meta Info --}}
								<div class="flex flex-wrap items-center gap-4 text-white/90">
									<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
										</svg>
										<span class="text-sm">{{ $post->published_at?->format('d M Y') }}</span>
									</div>

									@if(isset($post->reading_time))
										<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
											</svg>
											<span class="text-sm">{{ $post->reading_time }} dk</span>
										</div>
									@endif

									<div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
										</svg>
										<span class="text-sm">{{ number_format($post->views) }}</span>
									</div>
								</div>
							</div>
						</div>
					@endif

					{{-- Content Section --}}
					<div class="p-8 md:p-12">
						{{-- Excerpt --}}
						@if($post->excerpt)
							<div class="relative mb-8 p-6 bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200 rounded-2xl border-l-4 border-blue-500 shadow-sm">
								<div class="absolute top-4 right-4 text-blue-200">
									<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
										<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
									</svg>
								</div>
								<p class="text-lg text-gray-700 leading-relaxed font-medium relative z-10">{{ $post->excerpt }}</p>
							</div>
						@endif

						{{-- Like/Dislike Actions --}}
						<div class="flex items-center justify-between mb-8 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl">
							<div class="flex items-center gap-4">
								<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm">
									<svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
										<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
									</svg>
									<span class="font-bold text-gray-900">{{ $post->likes_count ?? 0 }}</span>
								</div>
								<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm">
									<svg class="w-5 h-5 text-red-600 rotate-180" viewBox="0 0 24 24" fill="currentColor">
										<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
									</svg>
									<span class="font-bold text-gray-900">{{ $post->dislikes_count ?? 0 }}</span>
								</div>
							</div>

							@if(auth()->check())
								<div class="flex items-center gap-3">
									<form method="POST" action="{{ route('posts.react', $post) }}">
										@csrf
										<input type="hidden" name="value" value="1">
										<button class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
											<svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor">
												<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
											</svg>
											<span>Beğen</span>
										</button>
									</form>
									<form method="POST" action="{{ route('posts.react', $post) }}">
										@csrf
										<input type="hidden" name="value" value="-1">
										<button class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
											<svg class="w-5 h-5 rotate-180 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor">
												<path d="M14 9V5a3 3 0 10-6 0v4H5a1 1 0 00-1 1v9a1 1 0 001 1h10a3 3 0 003-3v-6a1 1 0 00-1-1h-3z"/>
											</svg>
											<span>Beğenme</span>
										</button>
									</form>
								</div>
							@else
								<a href="{{ route('login') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
									Oy vermek için giriş yap
								</a>
							@endif
						</div>

						{{-- Main Content --}}
						<div class="prose prose-lg prose-blue max-w-none prose-headings:font-black prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-2xl prose-img:shadow-xl">
							@safeHtml($post->content)
						</div>

						{{-- Additional Media Gallery --}}
						@if($post->media->count() > 1)
							<div class="mt-12 pt-12 border-t border-gray-200">
								<h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
									<span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
									Galeri
								</h3>
								<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
									@foreach($post->media->where('is_primary', false) as $media)
										<div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
											<img src="{{ $media->url }}" 
											     alt="{{ $media->alt }}" 
											     class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-700">
											<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
											@if($media->caption)
												<div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
													<p class="text-white text-sm font-medium">{{ $media->caption }}</p>
												</div>
											@endif
										</div>
									@endforeach
								</div>
							</div>
						@endif

						{{-- Categories Section --}}
						@if($post->categories->isNotEmpty())
							<div class="mt-12 pt-12 border-t border-gray-200">
								<h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
									<span class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
									Kategoriler
								</h3>
								<div class="flex flex-wrap gap-3">
									@foreach($post->categories as $category)
										<a href="{{ route('posts.list', ['category' => $category->id]) }}" 
										   class="group px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 hover:from-blue-600 hover:to-blue-700 text-gray-700 hover:text-white rounded-full font-semibold shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
											<span class="flex items-center gap-2">
												<span class="w-2 h-2 bg-blue-600 group-hover:bg-white rounded-full"></span>
												{{ $category->name }}
											</span>
										</a>
									@endforeach
								</div>
							</div>
						@endif
					</div>
				</article>

				{{-- Comments Section --}}
				<div class="mt-8 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 p-8 md:p-12">
					<h3 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
						<span class="w-1.5 h-10 bg-gradient-to-b from-blue-600 to-blue-700 rounded-full"></span>
						Yorumlar
						<span class="ml-2 px-4 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 text-lg rounded-full font-bold">
							{{ $post->comments->where('status',1)->count() }}
						</span>
					</h3>

					@if($post->comments->where('status',1)->isNotEmpty())
						<div class="space-y-4 mb-8">
							@foreach($post->comments->where('status', 1) as $comment)
								<div class="group bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100">
									<div class="flex items-start gap-4">
										<div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-xl flex items-center justify-center text-white font-bold shadow-lg flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
											{{ substr($comment->user->name, 0, 1) }}
										</div>
										<div class="flex-1 min-w-0">
											<div class="flex items-center gap-3 mb-2 flex-wrap">
												<span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
												<span class="text-sm text-gray-500 flex items-center gap-1">
													<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
													</svg>
													{{ $comment->created_at->format('d M Y, H:i') }}
												</span>
											</div>
											<p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					@else
						<div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 text-center mb-8 border border-gray-200">
							<svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
							</svg>
							<p class="text-gray-600 font-medium">Henüz yorum yok. İlk yorumu sen yap! 💬</p>
						</div>
					@endif

					@if(auth()->check())
						<form method="POST" action="{{ route('posts.comment.store', $post) }}" class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 rounded-2xl p-6 shadow-lg border border-white">
							@csrf
							<label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
								<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
								</svg>
								Yorumunu Yaz
							</label>
							<textarea name="content" rows="4" 
							          class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-white shadow-sm" 
							          placeholder="Düşüncelerini bizimle paylaş...">{{ old('content') }}</textarea>
							<div class="mt-4 flex items-center justify-between">
								@if($errors->has('content'))
									<span class="text-sm text-red-600 font-medium">{{ $errors->first('content') }}</span>
								@else
									<span></span>
								@endif
								<button class="group px-8 py-3 bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white rounded-xl font-bold shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
									<span>Gönder</span>
									<svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
									</svg>
								</button>
							</div>
						</form>
					@else
						<div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-6 rounded-2xl shadow-xl text-center">
							<p class="text-lg font-semibold mb-3">Yorum yapmak için giriş yapmalısın</p>
							<a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-white text-blue-600 rounded-xl font-bold hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
								Giriş Yap
							</a>
						</div>
					@endif
				</div>
			</div>

		</div>
	</div>
</div>

<style>
@keyframes blob {
	0%, 100% { transform: translate(0, 0) scale(1); }
	25% { transform: translate(20px, -20px) scale(1.1); }
	50% { transform: translate(-20px, 20px) scale(0.9); }
	75% { transform: translate(20px, 20px) scale(1.05); }
}

.animate-blob {
	animation: blob 7s infinite;
}

.animation-delay-2000 {
	animation-delay: 2s;
}

.animation-delay-4000 {
	animation-delay: 4s;
}
</style>

@endsection