# Desain UI: Website Jurusan R&K

## Fundamental Website Kampus
Website ini adalah **website resmi jurusan perguruan tinggi**. Desain HARUS:
1. **Formal & Profesional** — bukan website personal/startup
2. **Informatif** — konten mudah ditemukan
3. **Navigasi Jelas** — breadcrumb di setiap halaman
4. **Mobile-First & Responsif** — mayoritas user dari HP. Lihat detail di `responsive-mobile.md`
5. **Konsisten** — warna, font, spacing seragam
6. **Aksesibel** — WCAG 2.1 AA. Lihat `a11y.md`
7. **TIDAK Terlihat AI-Generated** — desain harus terkesan dibuat oleh tim profesional, bukan keluaran cepat dari prompt AI. **WAJIB BACA**: `.windsurf/rules/anti-ai-generated.md` (no random emoji, no rainbow gradient, no klise marketing-speak, hierarki visual jelas).
8. **Konten Faktual** — nama institusi/jurusan/prodi/pejabat/lokasi harus sesuai data real. **WAJIB BACA**: `.windsurf/rules/identitas-website.md` untuk data resmi (4 prodi, akreditasi, alamat, email, dll).

## Bootstrap 5 Breakpoints (Quick Reference)

| Prefix | Min Width | Device | Pattern Umum |
|--------|-----------|--------|--------------|
| `(none)` | 0 | Mobile portrait | `col-12` (full-width) |
| `sm-` | ≥576 | Mobile landscape | (jarang dipakai) |
| `md-` | ≥768 | Tablet portrait | `col-md-6` (2-kolom) |
| `lg-` | ≥992 | Tablet landscape / laptop | `col-lg-4` (3-kolom) |
| `xl-` | ≥1200 | Desktop | `col-xl-3` (4-kolom) |
| `xxl-` | ≥1400 | Large desktop | (jarang dipakai) |

**Pendekatan**: mobile-first — start `col-12`, escalate ke `col-md-X` / `col-lg-X` untuk layar lebih besar.

## Color Palette

### Frontend (Eterna-based)
| Warna | Hex | Penggunaan |
|-------|-----|-----------|
| Primary (Navy) | `#1a2035` | Topbar, Navbar, Footer background |
| Accent (Blue) | `#0d6efd` | Links, CTA buttons |
| White | `#ffffff` | Background konten |
| Light Gray | `#f8f9fa` | Background section alternatif |
| Text Dark | `#212529` | Body text |

### Admin (CoreUI-based)
| Warna | Hex | Penggunaan |
|-------|-----|-----------|
| Sidebar | `#3c4b64` | CoreUI dark sidebar |
| Primary | `#321fdb` | CoreUI primary |
| Success | `#2eb85c` | Status aktif |
| Danger | `#e55353` | Tombol hapus |

## Typography
- **Font utama**: System font stack (Bootstrap default)
- **Heading**: Bold, uppercase untuk section titles
- **Body**: Regular, 16px base

## Layout Patterns

### Frontend — Halaman Konten (2-column)
```
┌────────────────────────────────────┐
│ Breadcrumb: Beranda / Profil / ... │
├────────────────────────────────────┤
│ Page Title (H1)                    │
├──────────────────┬─────────────────┤
│                  │ ARTIKEL TERKINI │
│  Konten Utama    │ • Berita 1      │
│  (col-md-8)      │ • Berita 2      │
│                  │ • Berita 3      │
│                  │ (col-md-4)      │
└──────────────────┴─────────────────┘
```

### Frontend — Halaman List/Grid (full-width)
```
┌────────────────────────────────────┐
│ Section Title (centered H2)        │
├──────┬──────┬──────────────────────┤
│ Card │ Card │ Card                 │
│ Card │ Card │ Card                 │
│ Card │ Card │ Card                 │
├──────┴──────┴──────────────────────┤
│     « 1  2  3 ... 10 »            │  ← Pagination
└────────────────────────────────────┘
```

### Admin — CRUD Index
```
┌────────────────────────────────────┐
│ Header: Judul + Tombol Tambah     │
├────────────────────────────────────┤
│ DataTable:                         │
│ [Search___] [Show: 10 ▾]          │
│ No | Judul | Kategori | Aksi      │
│ 1  | ...   | ...      | ✏️ 🗑️    │
│ 2  | ...   | ...      | ✏️ 🗑️    │
├────────────────────────────────────┤
│ Showing 1-10 of 50 │ « 1 2 3 »   │
└────────────────────────────────────┘
```

## Komponen Wajib di Setiap Halaman Frontend:
1. ✅ **Topbar**: Email + No. Telepon + Social media icons
2. ✅ **Navbar**: Logo + 7 menu utama dengan dropdown
3. ✅ **Breadcrumb**: Path navigasi (Beranda / Section / Page)
4. ✅ **Footer**: 4 kolom (Info Jurusan, Tentang Jurusan, Web Prodi, Follow Kami)
5. ✅ **Back to Top** button

## Komponen Wajib Admin:
1. ✅ **Sidebar**: Menu navigasi (collapsible)
2. ✅ **Header**: Search, notifications, profile
3. ✅ **Breadcrumb**: Path navigasi
4. ✅ **SweetAlert2**: Konfirmasi delete + toast notification
5. ✅ **DataTables**: Sorting, searching, pagination otomatis

## Referensi Visual:
- Screenshot website lama: `C:\Users\riki\Documents\PBL_Jurusan_R&K\Eterna\ss pbl lama\`
- 24 screenshot yang sudah dianalisis di `implementation_plan.md`
