# Activity Log: Website Jurusan R&K

## Prinsip
Pakai `spatie/laravel-activitylog` untuk audit trail semua aksi admin (siapa, kapan, ngapain).

---

## 1. Format Pesan Standar

### Pattern
```
[Aksi] [Modul]: [Identifier]
```

### Contoh
```php
// ✅ BENAR
activity()->causedBy(auth()->user())->performedOn($berita)
    ->log('Tambah Berita: '.$berita->judul);

activity()->causedBy(auth()->user())->performedOn($berita)
    ->log('Edit Berita: '.$berita->judul);

activity()->causedBy(auth()->user())
    ->log('Hapus Berita: '.$judul);  // setelah delete, $berita sudah tidak ada

activity()->causedBy(auth()->user())
    ->log('Upload Gambar Berita: '.$filename);

activity()->causedBy(auth()->user())
    ->log('Login Admin: '.auth()->user()->email);
```

### ❌ JANGAN
```php
// Pesan tidak konsisten
->log('berita ditambahkan')
->log('Berhasil menambah berita baru')
->log('add berita')
```

---

## 2. Aksi Standar (Vocabulary)

| Aksi | Kapan |
|------|-------|
| `Tambah` | Setelah create sukses |
| `Edit` | Setelah update sukses |
| `Hapus` | Setelah delete (soft/hard) |
| `Restore` | Restore dari soft delete |
| `Publish` | Toggle status published true |
| `Unpublish` | Toggle status published false |
| `Upload` | Upload file (image inline, dokumen) |
| `Login` | User berhasil login |
| `Logout` | User logout |
| `Reset Password` | Password di-reset |

---

## 3. Wajib Disertakan

### `causedBy()` — siapa yang melakukan
```php
->causedBy(auth()->user())
```
WAJIB ada untuk semua action admin.

### `performedOn()` — model target
```php
->performedOn($berita)  // jika action terkait model spesifik
```
Wajib jika ada model target. Skip kalau action umum (login, upload tanpa relasi model).

### `withProperties()` — detail tambahan
```php
->withProperties([
    'old_judul' => $oldJudul,
    'new_judul' => $newJudul,
    'ip'        => request()->ip(),
])
```
Pakai untuk detail yang berguna saat audit.

---

## 4. Auto-Logging via Trait

### Setup di Model
```php
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Berita extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = ['judul', 'is_published'];
    protected static $logOnlyDirty = true;
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'is_published'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Tambah Berita: '.$this->judul,
                'updated' => 'Edit Berita: '.$this->judul,
                'deleted' => 'Hapus Berita: '.$this->judul,
                default   => $eventName,
            });
    }
}
```

Dengan trait ini, manual `activity()->log(...)` di Controller TIDAK perlu lagi (otomatis ter-log).

---

## 5. Subject Type Filter

```php
// Get semua aktivitas berita
Activity::forSubject(Berita::class)->latest()->get();

// Get aktivitas user tertentu
Activity::causedBy($user)->latest()->limit(20)->get();
```

---

## 6. Display di Admin Dashboard

```blade
{{-- Log terbaru di dashboard --}}
@foreach(Spatie\Activitylog\Models\Activity::latest()->limit(10)->get() as $log)
    <div>
        <strong>{{ $log->causer->name ?? 'System' }}</strong>
        {{ $log->description }}
        <small>{{ $log->created_at->diffForHumans() }}</small>
    </div>
@endforeach
```

---

## 7. Cleanup (Production)

Activity log bisa membengkak. Jadwalkan cleanup di `app/Console/Kernel.php`:

```php
$schedule->command('activitylog:clean --days=180')->monthly();
```

Atau via config `config/activitylog.php`:
```php
'delete_records_older_than_days' => 180,
```

---

## 8. JANGAN Log

- Read action (hanya log mutasi)
- Action publik tanpa user (kecuali login attempt)
- Bulk operation per-row (log summary saja)
- Data sensitif (password, token) — pakai `$logExcept`
