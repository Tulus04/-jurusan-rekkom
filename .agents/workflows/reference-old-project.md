# Workflow: Referensi Proyek Lama

## Tujuan
Ketika membangun fitur baru, SELALU cek terlebih dahulu apakah fitur tersebut sudah pernah diimplementasikan di proyek lama. Ini menghemat waktu dan memastikan konsistensi.

---

## Lokasi Referensi

```
C:\Users\riki\Documents\PBL_Jurusan_R&K\
│
├── jurusanpolitani-main\               ← 🏆 PROYEK LAMA (Laravel)
│   ├── app\Models\                     → 21 model Eloquent
│   │   ├── Academic.php               (Akreditasi)
│   │   ├── Announcement.php           (Pengumuman)
│   │   ├── Blog.php                   (Berita)
│   │   ├── Category.php              (Kategori Berita)
│   │   ├── Contact.php               (Kontak)
│   │   ├── Curriculum.php            (Kurikulum)
│   │   ├── Document.php              (Dokumen/Pedoman)
│   │   ├── Faq.php                   (FAQ)
│   │   ├── Filter.php                (Filter Galeri)
│   │   ├── Gallery.php               (Galeri)
│   │   ├── Graduation.php            (Wisuda)
│   │   ├── Leave.php                 (Cuti)
│   │   ├── Organization.php          (Struktur Organisasi)
│   │   ├── Partner.php               (Partner/Kerja Sama)
│   │   ├── Program.php               (Program Studi)
│   │   ├── Repository.php            (Repository TA)
│   │   ├── Research.php              (Penelitian)
│   │   ├── Scholarship.php           (Beasiswa)
│   │   ├── Slider.php                (Slider/Hero)
│   │   ├── Team.php                  (Tim Dosen/Staff)
│   │   └── User.php                  (User Admin)
│   │
│   ├── resources\views\front\          → 31 Blade views frontend
│   ├── resources\views\back\           → 19 folder CRUD admin
│   └── routes\web.php                  → 227 baris routing lengkap
│
├── Eterna\                             ← 🎨 TEMPLATE FRONTEND
│   ├── Eterna\                        → File HTML template asli
│   └── ss pbl lama\                   → 24 screenshot referensi visual
│       ├── beranda*.png               → Homepage (hero, prodi, berita)
│       ├── tampilan menu tentang*.png → Tentang Jurusan
│       ├── tampilan menu visi*.png    → Visi Misi
│       ├── tampilan struktur*.png     → Struktur Organisasi
│       ├── tampilan menu akreditasi*  → Akreditasi Program Studi
│       ├── tampilan berita*.png       → List Berita (grid)
│       ├── tampilan menu jadwal*.png  → Jadwal Perkuliahan
│       ├── tampilan menu pedoman*.png → Pedoman Akademik
│       ├── tampilan menu beasiswa*.png→ Beasiswa (card grid)
│       ├── tampilan menu kegiatan*.png→ Kegiatan (list)
│       ├── tampilan menu pengajaran*  → Pengajaran (Tridharma)
│       ├── tampilan menu pengabdian*  → Pengabdian Masyarakat
│       └── tampilan menu hubungi*.png → Hubungi Kami (map+form)
│
├── coreui_admin\                       ← 🔧 TEMPLATE ADMIN
│   └── coreui-free-bootstrap-admin-template-main\
│
├── Data Jurusan R&K\                   ← 📊 DATA KONTEN
│   ├── Struktur Organisasi\           → Foto pejabat + bagan
│   │   ├── Suswanto.jpeg             (Ketua Jurusan)
│   │   ├── Ida-Maratul-Khamidah.jpeg (Sekretaris)
│   │   ├── 36.-Arif-Yani-Budiman.jpeg(Administrasi)
│   │   ├── struktur-organisasi.png   (Bagan organisasi)
│   │   └── 170cmX80cm[1].pdf        (Print bagan)
│   ├── akreditasi prodi\             → Sertifikat akreditasi
│   │   ├── tg\                       (Teknologi Geomatika)
│   │   ├── trpl\                     (Rekayasa Perangkat Lunak)
│   │   ├── trgs\                     (Rekayasa Geomatika Survei)
│   │   └── sia\                      (Sistem Informasi Akuntansi)
│   └── dokumentasi\                   → Foto kegiatan
│       ├── pengajaran\               (Foto seminar/workshop)
│       └── pengabdian\               (Foto pengabdian masyarakat)
│
└── website-jurusan\                    ← 🚀 PROYEK SAAT INI
```

---

## Cara Referensi

### Saat Membangun Fitur Baru:
1. **Cek Model lama**: Buka `jurusanpolitani-main/app/Models/` → pelajari `$fillable`, relasi
2. **Cek Routing lama**: Buka `jurusanpolitani-main/routes/web.php` → upgrade ke `Route::resource()`
3. **Cek Views lama**: Buka `jurusanpolitani-main/resources/views/` → rebuild dengan Bootstrap 5
4. **Cek Screenshot**: Buka `Eterna/ss pbl lama/` → gunakan sebagai referensi visual
5. **Cek Data**: Buka `Data Jurusan R&K/` → gunakan untuk seeder/konten awal

### Contoh: Membangun Modul Berita
```
1. Buka jurusanpolitani-main/app/Models/Blog.php
   → Pelajari $fillable: title, content, image, category_id, slug, author
   → Pelajari relasi: belongsTo(Category)

2. Buka jurusanpolitani-main/routes/web.php
   → Cari route berita: GET /berita, GET /berita/{slug}
   
3. Buka Eterna/ss pbl lama/tampilan berita html.png
   → Layout: grid 3x3, card dengan gambar, pagination
   
4. Rebuild dengan standar baru (Bootstrap 5, Form Request, Activity Log)
```

---

## Referensi Admin Proyek Kating

Proyek kating menggunakan **Jobick Admin Template** (DexignLab) + jQuery + MetisMenu.
Kita **TIDAK** akan copy template ini. Kita gunakan **CoreUI Free** sebagai gantinya.

### Pola Controller Kating → Pola Kita

```
KATING (Lama)                          KITA (Baru)
─────────────────────────────────────────────────────────
$guarded = []                    →     $fillable = [...]
Validasi di Controller           →     Form Request terpisah
Model::find($id)                 →     Route Model Binding
Delete via GET                   →     DELETE method + SweetAlert2
datatables()->of(Model::all())   →     Yajra DataTables (dipertahankan)
Summernote WYSIWYG               →     Summernote (dipertahankan)
return redirect()->route()       →     return redirect()->route() + toast
native confirm()                 →     SweetAlert2
Route manual (7 baris/modul)     →     Route::resource() (1 baris/modul)
Tanpa Activity Log               →     Spatie Activity Log
```

### Mapping 26 Controller Kating → Modul Kita

| Controller Kating | Priority | Modul Baru | Perubahan |
|-------------------|----------|------------|-----------|
| SliderController | P1 | Admin\SliderController | +FormRequest +ActivityLog |
| BlogController | P1 | Admin\BlogController | +FormRequest +ActivityLog +slug-fix |
| TeamController | P1 | Admin\TeamController | +FormRequest +ActivityLog |
| CategoryController | P1 | Admin\CategoryController | +FormRequest |
| GalleryController | P1 | Admin\GalleryController | +FormRequest +ActivityLog |
| ContactController | P1 | Admin\ContactController | +FormRequest |
| PartnerController | P2 | Admin\PartnerController | +FormRequest +ActivityLog |
| DocumentController | P2 | Admin\DocumentController | +FormRequest |
| CurriculumController | P2 | Admin\CurriculumController | +FormRequest +Excel |
| AnnouncementController | P2 | Admin\AnnouncementController | +FormRequest |
| FaqController | P2 | Admin\FaqController | +FormRequest |
| ScholarshipController | P2 | Admin\ScholarshipController | +FormRequest |
| OrganizationController | P2 | Admin\OrganizationController | +FormRequest |
| ResearchController | P3 | Admin\ResearchController | +FormRequest |
| UserController | P1 | Admin\UserController | +FormRequest +Policies |
| VisionController | P3 | Content-based (static page) | Simplify |
| StructureController | P3 | Content-based (static page) | Simplify |
| AcreditationController | P3 | Admin\AcreditationController | +FormRequest |
| FilterController | P1 | Merged into GalleryController | Simplify |
| GraduationController | P3 | Content-based | Simplify |
| LeaveController | P3 | Content-based | Simplify |
| RepositoryController | P3 | Content-based | Simplify |
| StoryController | P3 | Content-based | Simplify |
| JobController | P3 | Content-based | Simplify |
| TuitionController | P3 | Content-based | Simplify |
| ServiceController | P3 | Content-based | Simplify |

### Database Schema yang Dipertahankan

Skema tabel berikut sudah matang dan akan di-adopt ke proyek baru (dengan penambahan `$table->softDeletes()`):

- `sliders`: title, content, link, image
- `blogs`: name→title, slug, content, images→image (single)
- `teams`: name, image, nip, position, interest, email, description, education, more
- `contacts`: address, email, phone, coordinate, tiktok, facebook, instagram, youtube, linkedin
- `programs`: name, image, description, url, strata
- `galleries`: name, image, description, filter_id
- `partners`: name, image, link, description
- `announcements`: title, slug, content, image
