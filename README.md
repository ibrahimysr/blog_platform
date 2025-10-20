## Blog Platform (Laravel 10)

Bu depoda Laravel tabanlı bir blog ve içerik platformu bulunmaktadır. Yazılar, kategoriler, yorumlar, reaksiyonlar, etkinlikler, galeri ve ana sayfa kahraman görselleri (hero slider) yönetimi içerir. Admin paneli ile içerikler yönetilebilir.

### Teknolojiler ve Gereksinimler
- PHP: ^8.1
- Laravel: ^10.x (`laravel/framework` ^10.10)
- Node.js: (opsiyonel, Vite ^5 ile derleme)
- Veritabanı: MySQL/MariaDB (veya Laravel'in desteklediği herhangi bir sürücü)

### Kurulum
1) Depoyu klonlayın ve bağımlılıkları yükleyin:
```bash
composer install
```

2) Ortam dosyasını oluşturun ve uygulama anahtarını üretin:
```bash
cp .env.example .env
php artisan key:generate
```

3) .env ayarları:
- `APP_URL` değerini kendi URL'inize göre güncelleyin
- Veritabanı bağlantısını (`DB_*`) yapılandırın

4) Veritabanı tablolarını oluşturun ve örnek verilerle doldurun:
```bash
php artisan migrate --seed
```
Seeder, bir admin kullanıcısı oluşturur ve admin rolünü atar:
- E-posta: `admin@example.com`
- Şifre: `password`

5) Uygulamayı başlatın:
```bash
php artisan serve
```

### Varlıklar (Assets) ve Stil
- Proje, Blade şablonlarında TailwindCSS'i CDN ile kullanır.
- `vite` ve `laravel-vite-plugin` tanımlıdır; özel JS/CSS derlemek istiyorsanız `npm i` ve `npm run dev/build` kullanabilirsiniz (opsiyoneldir).

### Dosya Yüklemeleri ve Depolama
Galeri ve Hero Slider görselleri, doğrudan `public/` altında saklanır:
- `public/gallery_images`
- `public/gallery_thumbnails`
- `public/hero_slider_images`

Bu klasörlerin mevcut olduğundan ve web sunucusunun yazma izni bulunduğundan emin olun. Uygulama yoksa gerekli klasörleri kendisi oluşturur. Storage link ihtiyacı yoktur (dosyalar doğrudan `public/` altında tutulur), ancak genel kullanım için şu komut faydalıdır:
```bash
php artisan storage:link
```

### Giriş, Kayıt ve Yönetim Paneli
- Giriş: `/login`
- Kayıt: `/register`
- Çıkış: POST `/logout`
- Profil: `/profil`
- Admin Paneli: `/admin`
  - Yetkilendirme: `auth` + `admin` middleware (kullanıcıya `admin` rolü atanmış olmalı)

### Öne Çıkan Özellikler
- Yazılar: kategoriler, medya, öne çıkarma, okunma süresi, görüntülenme sayaçları
- Yorumlar: kayıtlı kullanıcılar yorum bırakabilir
- Reaksiyonlar: beğeni/beğenmeme
- Etkinlikler: yaklaşan/geçmiş etkinlik listeleri
- Galeri: URL veya dosya yükleme, küçük görseller (thumbnail), sıralama, öne çıkarma
- Hero Slider: URL veya dosya yükleme, aktiflik, sıralama; ana sayfada slider

### Başlıca Rotalar
Kamuya açık:
- `/` ana sayfa
- `/yazilar` yazı listesi (arama/sıralama/kategori filtreleri)
- `/yazilar/{post:slug}` yazı detayı (yorum/reaksiyon işlemleri)
- `/etkinlikler`, `/etkinlik/{event:slug}`
- `/galeri`, `/galeri/{gallery:slug}`
- Hakkımızda sayfaları: `/hakkımızda`, `/hakkımızda/misyonumuz`, `/hakkımızda/projelerimiz`, `/hakkımızda/ekibimiz`, `/hakkımızda/iletisim`, `/hakkımızda/turkab-uyesi-kimdir`, `/hakkımızda/temsilciliklerimiz`, `/hakkımızda/neden-kurulduk`

Yönetim (admin):
- `/admin` gösterge paneli
- `/admin/posts` (CRUD)
- `/admin/categories` (CRUD)
- `/admin/events` (CRUD)
- `/admin/galleries` (liste + CRUD)
- `/admin/users` (CRUD)
- `/admin/hero-sliders` (CRUD)

### Veritabanı ve Modeller
- Çekirdek modeller: `Post`, `Category`, `Comment`, `Reaction`, `Event`, `Gallery`, `HeroSlider`, `PostMedia`, `PostViewLog`, `PostViewStat`, `Role`, `User`
- Migrasyonlar `database/migrations` altında; `--seed` ile kategoriler ve admin kullanıcısı oluşturulur.

### Geliştirme Notları
- Admin erişimi için seeder'daki kullanıcıyla giriş yapın veya kendi kullanıcınıza `admin` rolünü atayın.
- Görsel yükleme klasörleri yazılabilir olmalıdır.
- Tailwind CDN kullanıldığı için ekstra derleme gerekmeyebilir; özel stil/JS için Vite kullanılabilir.

### Testler
PHPUnit yapılandırması `phpunit.xml` içerisinde. Örnek testler `tests/` klasöründe bulunur.

### Lisans
MIT
