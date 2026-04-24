# Kualitas Kode: Website Jurusan R&K

## 1. PHP Standards
- **PHP 8.3** — gunakan fitur modern (typed properties, enums, match, readonly)
- **PSR-12** — standar formatting PHP
- **Strict Types** — setiap file PHP baru HARUS mulai dengan `declare(strict_types=1);`

## 2. Laravel Conventions

### Controllers
- Controller HARUS ringan — max 10-15 baris per method
- Logika bisnis di **Repository** atau **Service**
- WAJIB gunakan **Resource Controllers** (`--resource`) untuk CRUD

### Models
- Definisikan `$fillable` eksplisit
- Definisikan relasi yang jelas (`hasMany`, `belongsTo`, dll)
- Gunakan **Eloquent Accessors/Mutators** jika diperlukan
- Letakkan scope query di Model (`scopeActive`, `scopePublished`)

### Form Requests
- SELALU buat Form Request terpisah untuk Create dan Update
- Naming: `Store{Model}Request`, `Update{Model}Request`
- Letakkan pesan error kustom di `messages()` method

### Migrations
- Naming: deskriptif (`create_blogs_table`, `add_slug_to_blogs_table`)
- SELALU include `$table->timestamps()` dan `$table->softDeletes()` jika relevan
- Definisikan foreign keys dengan `constrained()->cascadeOnDelete()`

## 3. Code Quality Tools

### Linter
```bash
# Pint (Laravel code style fixer)
./vendor/bin/pint --test    # Check only
./vendor/bin/pint           # Auto-fix
```

### Tests
```bash
php artisan test            # Run all tests
php artisan test --filter=BlogTest   # Run specific
```

## 4. Activity Logging
- Install `spatie/laravel-activitylog`
- Log setiap aksi admin: create, update, delete
- Berguna untuk audit trail: "siapa mengubah apa dan kapan"

## 5. Naming Conventions

| Item | Convention | Contoh |
|------|-----------|--------|
| Model | Singular, PascalCase | `Blog`, `ProgramStudi` |
| Controller | PascalCase + Controller | `BlogController` |
| Migration | snake_case, deskriptif | `create_blogs_table` |
| View | snake_case | `blog_detail.blade.php` |
| Route | kebab-case | `/program-studi` |
| Variable | camelCase | `$blogPost` |
| Database table | snake_case, plural | `blogs`, `program_studis` |
| Database column | snake_case | `created_at`, `is_active` |

## 6. Git Commit Messages
Format: `type: deskripsi singkat`
- `feat: tambah CRUD berita`
- `fix: perbaiki pagination galeri`
- `refactor: pisahkan BlogRepository`
- `style: format kode dengan Pint`
- `docs: update README`
