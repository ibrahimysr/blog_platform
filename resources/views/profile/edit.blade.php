@extends('layouts.app')

@section('title', 'Profilim')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="max-w-2xl mx-auto space-y-8">
        <div>
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <img src="{{ $user->avatar ?: 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=1877F2&color=fff' }}" class="w-28 h-28 rounded-2xl object-cover" alt="Avatar">
                    </div>
                    <h2 class="mt-4 text-xl font-black text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <h3 class="text-2xl font-black text-gray-900 mb-6">Profil Bilgileri</h3>

                @if (session('status'))
                    <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 px-5 py-4 rounded-xl text-emerald-800 font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 px-5 py-4 rounded-xl text-red-800 font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ad Soyad</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">E-posta</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-600">
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Yeni Şifre</label>
                            <input type="password" name="password" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-600" placeholder="İsteğe bağlı">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Yeni Şifre (Tekrar)</label>
                            <input type="password" name="password_confirmation" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-600">
                        </div>
                    </div>

                    

                    <div class="pt-2">
                        <button class="w-full md:w-auto inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:shadow-xl transition-all">
                            Kaydet
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


