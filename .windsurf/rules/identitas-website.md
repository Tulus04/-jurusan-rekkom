---
trigger: always_on
---

# Identitas Website: Website Jurusan R&K

> **Trigger**: Selalu aktif. WAJIB dibaca saat membuat konten teks baru (seeder, copy halaman, meta tags, email template), branding (logo, warna, footer), atau apapun yang menyangkut identitas institusi.

---

## 1. Identitas Resmi

### Institusi
- **Nama lengkap**: Politeknik Pertanian Negeri Samarinda
- **Akronim**: Politani Samarinda
- **Website utama**: https://politanisamarinda.ac.id
- **Website PMB**: https://pmb.politanisamarinda.ac.id

### Jurusan
- **Nama lengkap**: Jurusan Rekayasa dan Komputer
- **Akronim resmi**: R&K (dengan ampersand), Rekkom (untuk subdomain)
- **Domain proyek**: `rekkom.politani.ac.id` (production, target)
- **URL local**: `http://localhost:8000`
- **Email resmi**: `rekkom@politani.ac.id`
- **Email admin**: `admin@rekkom.ac.id`
- **Telepon**: `(0541) 260421`

### Alamat Fisik
```
Jalan Samratulangi, Sungai Keledang
Kec. Samarinda Seberang
Kota Samarinda, Kalimantan Timur 75131
```
**Koordinat**: `-0.5022, 117.1536`

### Social Media
- Instagram: `@rekkom_politani` — https://instagram.com/rekkom_politani
- Facebook: `rekkompolitani` — https://facebook.com/rekkompolitani
- YouTube: `@rekkompolitani` — https://youtube.com/@rekkompolitani

---

## 2. Program Studi

Jurusan R&K memiliki **4 program studi** (berdasarkan seeder & referensi asli):

| Jenjang | Nama Program Studi | Akronim | Akreditasi (per 2026) |
|---------|--------------------|---------|-----------------------|
| **D3** | Teknologi Geomatika | TG | B |
| **D3** | Sistem Informasi Akuntansi | SIA | B |
| **D4** | Teknologi Rekayasa Perangkat Lunak | TRPL | Baik Sekali |
| **D4** | Teknologi Rekayasa Geomatika dan Survei | TRGS | Baik Sekali |

**Sumber data**: `database/seeders/DatabaseSeeder.php` Section "Program Studi".
**Update data**: Kalau ada perubahan akreditasi atau tambah prodi, update seeder dulu, lalu re-seed. JANGAN hardcode nama prodi di view — selalu pakai `$prodiList` dari controller.

---

## 3. Visi & Misi Resmi

### Visi
> Menjadi jurusan unggulan dalam bidang rekayasa komputer yang menghasilkan lulusan berkompeten dan berdaya saing tinggi di tingkat nasional.

### Misi (4 point)
1. Menyelenggarakan pendidikan vokasi yang berkualitas di bidang rekayasa komputer.
2. Melaksanakan penelitian terapan yang bermanfaat bagi masyarakat dan industri.
3. Menjalin kerjasama dengan dunia usaha dan industri.
4. Menghasilkan lulusan yang berakhlak mulia dan profesional.

**Sumber**: `DatabaseSeeder.php` — `profilData` array, editable via admin panel (tabel `profil_jurusans`).
**JANGAN** hardcode visi/misi di view — selalu ambil dari `ProfilJurusan::where('kunci', 'visi')->first()`.

---

## 4. Branding & Design Tokens

### Color Palette (lihat `.agents/rules/desain-ui.md` Section 25)
- **Primary (Navy)**: `#1a2035` — topbar, navbar, footer
- **Accent (Blue)**: `#0d6efd` — link, CTA button
- **White**: `#ffffff` — background konten
- **Light Gray**: `#f8f9fa` — background section alternatif
- **Text Dark**: `#212529` — body text

### Logo
- **Logo Jurusan R&K**: Tentukan path di `public/frontend/img/logo-rk.png` (TBD — saat ini belum ada file dedicated)
- **Logo Politani**: `public/frontend/img/logo-politani.png` ✅ sudah ada
- **Favicon**: `public/favicon.ico` ✅

### Typography
- **Font utama**: System font stack (Bootstrap 5 default) — jangan override pakai Google Fonts kalau tidak perlu (perfomance)
- **Heading**: Bold untuk section title, size sesuai Bootstrap scale (h1–h6)
- **Body**: Regular, 16px base (WAJIB untuk anti iOS auto-zoom di input)

### Tone of Voice (Gaya Bahasa)
- **Formal** — institusi pendidikan tinggi negeri, bukan startup
- **Informatif** — to the point, hindari bunga-bunga
- **Bahasa Indonesia baku** — lihat `.agents/rules/bahasa-indonesia.md`
- **Sapaan**: "Anda" untuk publik (calon mahasiswa, orang tua, mitra), "kamu" HANYA untuk konten khusus mahasiswa aktif (mis. blog/artikel internal)

---

## 5. Target Audience

Urutan prioritas (paling sering akses):

1. **Calon mahasiswa** (SMA/SMK, kelas 12) — cari info prodi, akreditasi, biaya, jadwal PMB
2. **Mahasiswa aktif** — akses jadwal, beasiswa, pedoman akademik, berita kampus
3. **Orang tua / keluarga** — verifikasi kredibilitas kampus, lokasi, kontak
4. **Mitra industri** — cari info kerjasama magang, rekrutmen lulusan
5. **Alumni** — berita update, info reuni
6. **Publik umum / peneliti** — akses berita, publikasi, kegiatan pengabdian
7. **Admin internal** — kelola konten (via `/admin`)

### Perangkat (berdasarkan data analytics umum kampus Indonesia)
- **Mayoritas mobile** (~70%) — mahasiswa akses dari HP Android budget
- Desktop (~25%) — admin, orang tua
- Tablet (~5%)

**Implikasi**: WAJIB **mobile-first** (lihat `.agents/rules/responsive-mobile.md`), touch target ≥44px, font ≥16px.

---

## 6. Pembatasan Konten

### WAJIB (harus ada)
- Nama jurusan & institusi lengkap di **header & footer** tiap halaman
- Logo Politani di **header & footer**
- Kontak (email, telepon) di **topbar & footer**
- Breadcrumb di **tiap halaman kecuali beranda**
- Link ke social media di **topbar & footer**

### DILARANG
- ❌ Menyebut nama kampus lain (Universitas Mulawarman, UNTAG Samarinda, ITK, dll) **KECUALI** dalam konteks berita kolaborasi resmi
- ❌ Ranking / positioning yang **tidak terverifikasi** ("kampus terbaik", "nomor 1 di Kaltim")
- ❌ Klaim akreditasi yang **tidak sesuai** data resmi di `ProgramStudi::akreditasi`
- ❌ Konten promosi **kompetitor** atau lembaga bimbingan belajar
- ❌ Logo / gambar berlisensi yang tidak dipunyai

---

## 7. Konten Referensi Real

### Lokasi Data Asli
```
c:\Users\riki\Documents\PBL_Jurusan_R&K\
├── Data Jurusan R&K\              ← Sumber data utama
│   ├── akreditasi prodi\          (2 files)
│   ├── dokumentasi\               (6 files foto)
│   └── Struktur Organisasi\       (7 files — foto pejabat + bagan)
├── jurusanpolitani-main\          ← Proyek lama (referensi implementasi)
│   └── database/seeders/          (data konten yang bisa di-reuse)
└── Eterna\ss pbl lama\            ← 24 screenshot referensi visual
```

### Pejabat Struktural (sumber: `Data Jurusan R&K/Struktur Organisasi/`)
- **Ketua Jurusan**: TBD (baca dari file di folder)
- **Sekretaris Jurusan**: TBD
- **Ketua Program Studi** per prodi (TG, SIA, TRPL, TRGS)

**JANGAN** generate/hallucinate nama pejabat. Pakai data real dari folder referensi, atau kalau belum tersedia tampilkan placeholder "Segera diperbarui" (empty state) BUKAN nama fiktif.

### Berita Sample
Berita seeder (6 item) yang bisa dipakai sebagai referensi ketika generate konten baru:
1. Penerimaan Mahasiswa Baru TA 2026/2027
2. Workshop IoT Bersama Telkom Indonesia
3. Mahasiswa TRPL Juara 1 Hackathon Nasional 2026
4. Kunjungan Industri ke PT Pupuk Kaltim Bontang
5. Seminar Nasional Keamanan Siber
6. Jadwal UAS Semester Genap 2025/2026

**Pattern**: Semua berita nyaris **mirip dengan berita kampus betulan** (ada tanggal, nama institusi/industri real, jumlah peserta masuk akal).

---

## 8. Aturan Konten untuk AI (Cascade / Copilot)

Saat generate konten baru (seeder, copy, subtitle, meta), WAJIB:

1. **Pakai nama resmi lengkap** — "Jurusan Rekayasa dan Komputer, Politeknik Pertanian Negeri Samarinda", bukan "jurusan IT" / "jurusan komputer" / "kampus ini"
2. **Sebut lokasi** — "Samarinda, Kalimantan Timur" kalau konteks memungkinkan
3. **Pakai data real dari seeder** — jumlah prodi = 4, akreditasi sesuai tabel di Section 2
4. **Hindari generalisasi** — kalau tidak tahu data spesifik, **biarkan field nullable** atau pakai "Segera diperbarui", BUKAN dummy
5. **Cek dulu ke seeder / folder referensi** sebelum mengarang — lihat Section 7

### Contoh Konten yang BENAR
```
✅ "Jurusan Rekayasa dan Komputer, Politeknik Pertanian Negeri Samarinda 
    membuka pendaftaran TA 2026/2027 untuk 4 program studi."

✅ "TRPL (Teknologi Rekayasa Perangkat Lunak) dengan akreditasi Baik Sekali 
    adalah program D4 unggulan di jurusan."

✅ "Alamat: Jalan Samratulangi, Sungai Keledang, Samarinda Seberang, Kota Samarinda."
```

### Contoh Konten yang SALAH
```
❌ "Kampus teknologi terkemuka di Kalimantan" 
   (tidak terverifikasi, sounds like marketing)

❌ "Memiliki 10+ program studi unggulan" 
   (faktanya 4 prodi saja)

❌ "Dipimpin oleh Prof. Dr. Budi Santoso, M.Kom." 
   (nama fiktif — pakai nama real atau "Segera diperbarui")

❌ "Jurusan IT Politani" 
   (bukan nama resmi — WAJIB "Rekayasa dan Komputer")
```

---

## 9. Checklist Verifikasi Konten

Sebelum commit konten teks baru (seeder, view, meta):

- [ ] Nama jurusan lengkap: "Jurusan Rekayasa dan Komputer" (bukan "IT", "komputer", "teknik")
- [ ] Nama institusi lengkap: "Politeknik Pertanian Negeri Samarinda" (bukan "Politani" saja di text formal)
- [ ] Akreditasi prodi sesuai Section 2 tabel
- [ ] Jumlah prodi: 4 (D3 × 2 + D4 × 2)
- [ ] Lokasi: Samarinda, Kalimantan Timur (bukan Balikpapan, Bontang, dll)
- [ ] Email: `rekkom@politani.ac.id` di konten publik, `admin@rekkom.ac.id` khusus login admin
- [ ] Tidak ada nama pejabat fiktif
- [ ] Tidak ada klaim "terbaik", "nomor 1", "terkemuka" yang tidak terverifikasi
- [ ] Bahasa Indonesia formal, bukan bahasa marketing (lihat `.windsurf/rules/anti-ai-generated.md`)

---

## 10. Related Rules

### Windsurf Native Rules (`.windsurf/rules/` — auto-inject)
- `.windsurf/rules/anti-ai-generated.md` — jangan klise marketing-speak, anti rainbow gradient

### Detail Rules (`.agents/rules/`)
- `.agents/rules/desain-ui.md` — color palette, komponen wajib
- `.agents/rules/bahasa-indonesia.md` — konsistensi bahasa
- `.agents/rules/seo-meta.md` — meta description per halaman
- `.agents/rules/deployment.md` — APP_NAME, APP_URL production
- `.agents/rules/persona.md` — konteks proyek
- `.agents/rules/responsive-mobile.md` — touch target, mobile-first
- `.agents/rules/akun-test.md` — credential admin testing
