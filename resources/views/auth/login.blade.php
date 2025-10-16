<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Giriş Yap</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">
	<div class="w-full max-w-sm bg-white border rounded p-6">
		<h1 class="text-xl font-semibold mb-4">Giriş Yap</h1>
		@if ($errors->any())
			<div class="bg-red-50 text-red-800 px-4 py-3 rounded mb-4">
				{{ $errors->first() }}
			</div>
		@endif
		<form method="POST" action="{{ route('login.post') }}" class="space-y-4">
			@csrf
			<div>
				<label class="block text-sm mb-1">E-posta</label>
				<input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" />
			</div>
			<div>
				<label class="block text-sm mb-1">Şifre</label>
				<input type="password" name="password" value="" class="w-full border rounded px-3 py-2" />
			</div>
			<button class="w-full px-4 py-2 bg-blue-600 text-white rounded">Giriş</button>
		</form>
		<div class="mt-4 text-sm text-gray-600">
			Hesabın yok mu? <a class="text-blue-600 hover:underline" href="{{ route('register') }}">Kayıt ol</a>
		</div>
	</div>
</body>
</html>
