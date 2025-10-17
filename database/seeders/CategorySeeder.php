<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Genel',
            'Duyurular',
            'Teknoloji',
            'Yaşam',
            'Eğitim',
            'Spor',
            'Sağlık',
            'Bilim',
            'Sanat',
            'Müzik',
            'Sinema',
            'Kitap',
            'Yemek',
            'Seyahat',
            'Moda',
            'Otomotiv',
            'Oyun',
            'Programlama',
            'Web Tasarım',
            'Mobil Uygulama',
            'Yapay Zeka',
            'Blockchain',
            'Kripto Para',
            'Finans',
            'Ekonomi',
            'Politika',
            'Tarih',
            'Coğrafya',
            'Felsefe',
            'Psikoloji',
        ];

        foreach ($categories as $name) {
            DB::table('categories')->updateOrInsert(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => null, 'parent_id' => null]
            );
        }
    }
}
