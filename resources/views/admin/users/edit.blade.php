
@extends('layouts.admin')

@section('title', 'Kullanıcıyı Düzenle')

@section('content')
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.users.index') }}" 
               class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kullanıcıyı Düzenle</h1>
                <p class="mt-1 text-sm text-gray-500">Mevcut kullanıcıyı güncelleyin</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <button type="submit" form="user-form" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm">
                <svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Güncelle
            </button>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        @if ($errors->any())
            <div class="bg-red-50 text-red-800 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="user-form" method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Ad <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name"
                           name="name" 
                           value="{{ old('name', $user->name) }}" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Kullanıcı adını girin">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        E-posta <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="email"
                           name="email" 
                           value="{{ old('email', $user->email) }}" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                           placeholder="E-posta adresini girin">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Yeni Şifre
                    </label>
                    <input type="password" 
                           id="password"
                           name="password" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                           placeholder="Değiştirmek istemezseniz boş bırakın">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                        Avatar URL
                    </label>
                    <input type="text" 
                           id="avatar"
                           name="avatar" 
                           value="{{ old('avatar', $user->avatar) }}" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('avatar') border-red-500 @enderror"
                           placeholder="Avatar URL'sini girin">
                    @error('avatar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                 <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">
                     Rol
                 </label>
                 <select id="role_id" 
                         name="role_id" 
                         class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role_id') border-red-500 @enderror">
                     <option value="">— Seçiniz —</option>
                     @foreach ($roles as $r)
                         <option value="{{ $r->id }}" {{ old('role_id', optional($user->roles->first())->id) == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                     @endforeach
                 </select>
                 @error('role_id')
                     <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                 @enderror
            </div>
        </form>
    </div>
@endsection

