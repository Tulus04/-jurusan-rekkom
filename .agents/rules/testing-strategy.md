# Testing Strategy: Website Jurusan R&K

## Prinsip
Test bukan beban — investasi. Test yang baik mencegah regresi saat refactor & memberi confidence.

---

## 1. Test Pyramid

```
        /\
       /  \   E2E (sedikit, mahal)
      /----\
     /      \  Feature Test (banyak)
    /--------\
   /          \  Unit Test (paling banyak)
  /____________\
```

- **Unit**: model, repository, service, helper — TIDAK butuh DB
- **Feature**: HTTP request flow, controller, full stack
- **E2E**: Browser test (Dusk) — opsional untuk CMS

---

## 2. Lokasi & Naming

```
tests/
├── Unit/
│   ├── Models/
│   │   └── BeritaTest.php
│   ├── Repositories/
│   │   └── BeritaRepositoryTest.php
│   └── Helpers/
│       └── RupiahHelperTest.php
└── Feature/
    ├── Admin/
    │   ├── BeritaCrudTest.php
    │   └── LoginTest.php
    └── Frontend/
        ├── HomePageTest.php
        └── BeritaIndexTest.php
```

### Naming Test Method
```php
public function test_admin_can_create_berita(): void
public function test_form_kontak_rejects_spam_via_honeypot(): void
public function test_breadcrumb_displays_on_every_inner_page(): void
```

Format: `test_{actor}_{verb}_{object}` atau `test_{situation}_{expected_outcome}`.

---

## 3. Factory Wajib

Setiap Model PUNYA factory di `database/factories/`.

```php
// database/factories/BeritaFactory.php
class BeritaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul'             => fake()->sentence(),
            'slug'              => fake()->slug(),
            'ringkasan'         => fake()->paragraph(),
            'konten'            => fake()->paragraphs(5, true),
            'gambar'            => 'berita/sample.jpg',
            'is_published'      => true,
            'tanggal_publikasi' => now(),
            'penulis_id'        => User::factory(),
        ];
    }
    
    public function draft(): self
    {
        return $this->state(fn () => ['is_published' => false]);
    }
}
```

### Pemakaian
```php
$berita = Berita::factory()->create();
$beritas = Berita::factory(10)->published()->create();
```

---

## 4. Database Refresh

Pakai `RefreshDatabase` untuk Feature Test:

```php
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeritaCrudTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_admin_can_create_berita(): void
    {
        $admin = User::factory()->create();
        
        $response = $this->actingAs($admin)
            ->post(route('admin.berita.store'), [
                'judul'   => 'Test Berita',
                'konten'  => 'Konten test',
                'gambar'  => UploadedFile::fake()->image('foto.jpg'),
            ]);
        
        $response->assertRedirect(route('admin.berita.index'));
        $this->assertDatabaseHas('beritas', ['judul' => 'Test Berita']);
    }
}
```

---

## 5. Coverage Target

| Modul | Target |
|-------|--------|
| Model accessor/scope | 80% |
| Repository | 80% |
| Form Request rules | 70% |
| Controller (happy path) | 60% |
| Helper | 90% |
| View (rendering) | minimal smoke test |

```bash
# Run with coverage
php artisan test --coverage

# Target threshold (gagal kalau dibawah)
php artisan test --coverage --min=60
```

---

## 6. Test Categories

### Wajib Test
- [ ] Auth flow (login, logout, password reset)
- [ ] CRUD per modul (create/read/update/delete)
- [ ] Form validation (Form Request rules)
- [ ] Authorization (admin route ditolak guest)
- [ ] Activity log tercatat saat mutasi

### Nice-to-Have
- [ ] Search/filter di DataTables
- [ ] Pagination
- [ ] File upload validation
- [ ] Edge case (empty data, large data)

### Skip (kecuali kritis)
- View rendering detail (UI bisa berubah)
- Third-party library internal

---

## 7. Mocking

### Hindari Mock Berlebihan
Mock hanya untuk:
- External API (HTTP client)
- Filesystem (kalau test E2E lambat)
- Email/SMS (jangan kirim beneran)

```php
Storage::fake('public');
Mail::fake();
Http::fake();
```

### Hindari Mock untuk
- Database — pakai RefreshDatabase + Factory
- Eloquent model — query asli lebih tepercaya

---

## 8. Test Pattern (AAA)

```php
public function test_xxx(): void
{
    // ARRANGE — setup data
    $admin = User::factory()->create();
    $berita = Berita::factory()->create();
    
    // ACT — eksekusi
    $response = $this->actingAs($admin)
        ->delete(route('admin.berita.destroy', $berita));
    
    // ASSERT — verifikasi
    $response->assertOk();
    $this->assertSoftDeleted($berita);
}
```

---

## 9. CI/CD Integration

`.github/workflows/test.yml`:
```yaml
name: Tests
on: [push, pull_request]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - run: composer install --no-progress
      - run: cp .env.example .env
      - run: php artisan key:generate
      - run: php artisan test
      - run: php vendor/laravel/pint/builds/pint --test
```

---

## 10. Larangan

- ❌ JANGAN test trivial getter/setter (waste)
- ❌ JANGAN test framework/library (Laravel sudah test sendiri)
- ❌ JANGAN test dengan production DB
- ❌ JANGAN commit test yang gagal
- ❌ JANGAN skip test "akan ditambahkan nanti" — buat sekarang
