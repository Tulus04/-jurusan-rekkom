# Keamanan: Website Jurusan R&K

## 1. Authentication & Authorization

### Authentication (Login)
- Menggunakan **Laravel Breeze** (session-based)
- Hanya admin yang bisa login (tidak ada registrasi publik)
- Login route: `/login`
- Dashboard route: `/admin/dashboard`

### Authorization (Akses)
- Gunakan **Laravel Middleware** untuk proteksi route admin
- Route group admin: `Route::middleware('auth')->prefix('admin')->group(...)`
- Jika ada multi-role di masa depan: gunakan **Laravel Gates/Policies**

## 2. Data Protection

### Eloquent
- SELALU definisikan `$fillable` di setiap Model (mass assignment protection)
- Gunakan `$hidden` untuk field sensitif (`password`, `remember_token`)
- JANGAN pernah gunakan `$guarded = []`

### Input Validation
- SELALU gunakan **Form Request** untuk validasi (`php artisan make:request`)
- JANGAN validasi di Controller langsung
- Contoh:
```php
class StoreBlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
```

## 3. Environment

### .env
- JANGAN pernah commit `.env` ke Git
- Pastikan `.env` ada di `.gitignore`
- Semua credential (DB, mail, API keys) di `.env`
- Gunakan `config()` helper, BUKAN `env()` langsung di kode

### File Upload
- Validasi tipe file (image: jpg, jpeg, png, max 2MB)
- Simpan di `storage/app/public/` (bukan di `public/` langsung)
- Gunakan `php artisan storage:link` untuk symlink

## 4. CSRF Protection
- Blade form SELALU pakai `@csrf`
- AJAX request HARUS include CSRF token di header

## 5. SQL Injection Prevention
- SELALU gunakan Eloquent ORM atau Query Builder
- JANGAN pernah raw query tanpa parameter binding:
  ```php
  // ❌ SALAH
  DB::select("SELECT * FROM users WHERE email = '$email'");
  
  // ✅ BENAR
  DB::select("SELECT * FROM users WHERE email = ?", [$email]);
  // Atau lebih baik:
  User::where('email', $email)->first();
  ```
