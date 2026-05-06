---
trigger: always_on
---

# Anti AI-Generated Look: Website Jurusan R&K

> **Trigger**: Selalu aktif saat task UI (komponen baru, halaman baru, redesign).
> **Sumber inspirasi**: Adopsi & adaptasi dari `Projek-PBL-Semester-6/.agents/rules/desain-ui.md` (anti-AI clause).

## Prinsip Utama

Website ini adalah **portal resmi jurusan perguruan tinggi negeri** — harus terlihat **dibuat oleh tim yang berpengalaman**, bukan keluaran cepat dari prompt AI. User (mahasiswa, calon mahasiswa, orang tua, mitra industri) langsung bisa membedakan website yang dibangun dengan **niat & detail** vs website yang **terkesan instan**.

> **Acid test**: Tunjukkan halaman ke teman yang non-developer. Kalau respon pertamanya "kelihatan kayak ChatGPT bikin" atau "kayak template gratisan" → **GAGAL**. Kalau "wah, profesional kayak website kampus betulan" → **BERHASIL**.

---

## 1. Visual — Yang DILARANG ❌

### 1.1 Emoji acak di UI
```blade
{{-- ❌ SALAH — emoji untuk dekorasi --}}
<h2>📚 Pedoman Akademik 🎓</h2>
<button>✨ Unduh Sekarang 🚀</button>

{{-- ✅ BENAR — pakai Bootstrap Icons (sesuai library-standard.md) --}}
<h2><i class="bi bi-journal-bookmark me-2"></i>Pedoman Akademik</h2>
<button><i class="bi bi-download me-1"></i>Unduh</button>
```

**Alasan**: Emoji terlihat seperti caption Instagram/WhatsApp, bukan website resmi institusi pendidikan. Bootstrap Icons monochrome lebih corporate.

**Pengecualian** (boleh emoji): konten artikel berita yang memang ditulis user (mis. quote testimoni mahasiswa), karakter khusus matematika/sains di konten akademik.

### 1.2 Gradient warna acak / mencolok
```css
/* ❌ SALAH — gradient pelangi / acid */
.hero {
    background: linear-gradient(135deg, #ff6b6b, #4ecdc4, #45b7d1);
}
.btn-cta {
    background: linear-gradient(45deg, #ee0979, #ff6a00);
}

/* ✅ BENAR — solid color sesuai brand atau gradient SUBTLE 1-color */
.hero {
    background: var(--rk-primary, #1a2035);
}
.btn-primary {
    background: var(--rk-accent, #0d6efd);
}
/* Gradient hanya kalau fungsional & subtle (mis. fade scroll-hint, image overlay) */
.scroll-hint::after {
    background: linear-gradient(to right, rgba(255,255,255,0), #fff 90%);
}
```

**Alasan**: Gradient acak adalah signature AI-generated landing page (Vercel, Stripe, dll). Website kampus pakai solid corporate color.

### 1.3 Tombol warna-warni mencolok yang inkonsisten
```blade
{{-- ❌ SALAH — 3 tombol 3 warna untuk action sejenis --}}
<button class="btn" style="background: #ff6b6b">Unduh</button>
<button class="btn" style="background: #4ecdc4">Buka</button>
<button class="btn" style="background: #ffe66d">Bagikan</button>

{{-- ✅ BENAR — hierarki visual: primary 1, secondary lainnya --}}
<a class="btn btn-primary">Unduh</a>            {{-- aksi utama --}}
<a class="btn btn-outline-secondary">Buka</a>   {{-- aksi sekunder --}}
<a class="btn btn-link">Bagikan</a>             {{-- aksi tersier --}}
```

**Alasan**: Lebih dari 1 tombol primary di satu area = user bingung mana aksi utama. AI suka kasih warna ke semua button "biar menarik" → malah berisik.

### 1.4 Animasi berlebihan / show-off
```css
/* ❌ SALAH — bouncing card, rainbow shadow, perpetual rotation */
.card { animation: bounce 2s infinite; }
.btn:hover {
    transform: scale(1.5) rotate(15deg);
    box-shadow: 0 0 40px rainbow;
}

/* ✅ BENAR — micro-interaction halus, fungsional */
.card { transition: border-color 0.18s ease, box-shadow 0.18s ease; }
@media (hover: hover) {
    .card:hover {
        border-color: var(--rk-accent);
        box-shadow: 0 8px 18px rgba(13, 110, 253, 0.08);
    }
}
```

**Aturan**:
- Transition: **150–250ms**, easing `ease` atau `ease-out`
- Animate hanya `transform` & `opacity` (lihat `.agents/rules/performance-css.md`)
- JANGAN `infinite` animation kecuali untuk loading spinner
- Hover effect WAJIB di-wrap `@media (hover: hover)` (sesuai `.agents/rules/responsive-mobile.md`)

### 1.5 Spacing & whitespace berlebihan
```blade
{{-- ❌ SALAH — padding 80px-100px tiap section, terlihat scrolly --}}
<section style="padding: 100px 0;">
    <h2 style="margin-bottom: 60px">Pedoman</h2>
    <p style="font-size: 22px; line-height: 2;">...</p>
</section>

{{-- ✅ BENAR — spacing fungsional, density informasi cukup --}}
<section class="section">  {{-- 40px mobile, 60px tablet, 80px desktop max --}}
    <h2 class="h4 mb-4">Pedoman</h2>
    <p>...</p>  {{-- 16px base, line-height 1.6 --}}
</section>
```

### 1.6 Card density rendah untuk konten yang seharusnya tabel
Lihat case study di proyek ini: **menu Pedoman** awalnya saya implement pakai card grid (icon besar 56px, padding tebal) → terkesan AI-generated landing page. Setelah feedback user, di-rework ke **tabel responsive hybrid** (mirror pattern halaman Jadwal) → terasa lebih natural untuk audiens akademik Indonesia.

**Rule**: Untuk **download list / data tabular** → pakai tabel. Card grid khusus untuk **konten kaya media** (berita, kegiatan, beasiswa dengan thumbnail).

---

## 2. Konten — Yang DILARANG ❌

### 2.1 Tagline klise AI
```
❌ "Membangun masa depan yang gemilang melalui pendidikan unggul"
❌ "Berinovasi tanpa batas untuk Indonesia maju"
❌ "Where excellence meets innovation"
❌ "Mencetak generasi emas berdaya saing global"
❌ "Solusi terdepan di era digital"
❌ "Wujudkan mimpimu bersama kami"
```

```
✅ "Jurusan Rekayasa dan Komputer — Politeknik Pertanian Negeri Samarinda"
✅ "Panduan resmi tugas akhir mahasiswa D3 dan D4"
✅ "Pendaftaran beasiswa KIP Kuliah ditutup 30 Juni 2026"
```

**Aturan**: 
- Spesifik > generik
- Faktual > emotive
- Jelas tindakan/info > bombastis

### 2.2 Lorem Ipsum / Placeholder text
JANGAN deploy dengan teks placeholder. Setiap halaman WAJIB punya konten **real atau realistis** dari `Data Jurusan R&K/` atau seeder.

### 2.3 Heading dengan emoji prefix bertubi
```blade
{{-- ❌ SALAH --}}
<h3>🎯 Visi</h3>
<h3>🚀 Misi</h3>
<h3>💡 Tujuan</h3>

{{-- ✅ BENAR --}}
<h3>Visi</h3>
<h3>Misi</h3>
<h3>Tujuan</h3>
{{-- atau dengan icon Bootstrap satu warna --}}
<h3><i class="bi bi-bullseye text-primary me-2"></i>Visi</h3>
```

### 2.4 Bahasa Inggris di UI publik
Website jurusan untuk audiens **mayoritas Indonesia** (mahasiswa, calon, orang tua di Kalimantan Timur). UI label, button, error message WAJIB Bahasa Indonesia (sesuai `.agents/rules/bahasa-indonesia.md`).

```
❌ <button>Submit</button>           ✅ <button>Kirim</button>
❌ <button>Cancel</button>           ✅ <button>Batal</button>
❌ "Welcome back, Admin"             ✅ "Selamat datang kembali, Admin"
❌ "No data found"                   ✅ "Belum ada data"
```

---

## 3. Pattern Klise AI yang Sering Muncul

| Anti-pattern | Ciri | Kenapa terlihat AI |
|---|---|---|
| **3 columns of feature cards** | "Cepat ⚡ / Aman 🔒 / Modern 🎨" dengan emoji | SaaS landing page template |
| **Hero gradient + glow** | Background gradient ungu-pink + glow effect di tengah | OpenAI/Anthropic blog signature |
| **Floating/pulsing CTA** | Tombol "Daftar Sekarang" dengan glow animasi infinite | Conversion-hack vibes, bukan kampus |
| **Glassmorphism** | Card transparan dengan `backdrop-filter: blur` | Tren 2021 yang sudah usang |
| **Neon hover effect** | Border glow warna saat hover | Gaming UI, bukan akademik |
| **"AI-powered" copy** | Subtitle bombastis tanpa substansi | Direct symptom |
| **Excessive divider lines** | Dekorasi garis di semua section | Compensation untuk lack of content |
| **Bento grid asimetris** | Mixed-size grid card di home | Apple keynote 2023 mimicry |
| **Avatar lingkaran random** | Profile pic dummy di testimonial section | Boilerplate template |

---

## 4. Yang DILAKUKAN ✅

### 4.1 Konsistensi
- **Color palette terbatas** (lihat `.agents/rules/desain-ui.md` Section 25): primary navy + accent blue + 3 warna semantic (success/warning/danger). Tidak lebih.
- **Komponen reusable**: tombol, badge, card, breadcrumb pakai Bootstrap class atau component partial yang sama di semua halaman.
- **Pattern halaman seragam**: heading + breadcrumb + 2-column dengan sidebar artikel terkini = template setiap halaman konten.

### 4.2 Detail yang menunjukkan "ada manusia di balik ini"
- Nama-nama dosen real dari `Data Jurusan R&K/`
- Nomor telepon & alamat real Politani Samarinda
- Tahun akademik & semester real (2025/2026, 2026/2027)
- Tanggal kegiatan masuk akal (bukan "5 Mei 2049")
- Jumlah mahasiswa, beasiswa, prodi sesuai realitas
- Foto real (atau realistic placeholder dengan inisial nama, bukan generic avatar)

### 4.3 Kualitas mikrokopi
- Pesan validasi: spesifik & actionable ("Email harus berformat valid, contoh: nama@domain.com")
- Empty state: jelaskan kenapa kosong + apa yang bisa dilakukan
- Error message: friendly, tidak menyalahkan user
- Konfirmasi: jelaskan konsekuensi ("Hapus berita ini? Tidak bisa dikembalikan.")

### 4.4 Pertahankan kekhasan template
Eterna (frontend) & CoreUI (admin) punya signature visual sendiri yang sudah teruji. **JANGAN** override aggressive — pertahankan typography, spacing, hover effect bawaan template. Customisasi hanya untuk:
- Color (primary, accent)
- Logo & branding
- Konten

---

## 5. Self-Check Sebelum Deploy / Klaim "Selesai"

Jalankan checklist ini SEBELUM klaim halaman selesai:

- [ ] **Emoji di UI?** Hanya di konten artikel berita yang ditulis user. Cek `grep -E "[\x{1F300}-\x{1F9FF}]"` di view file.
- [ ] **Gradient warna acak?** Cek semua `linear-gradient` & `radial-gradient` — harus fungsional (scroll-hint, image overlay).
- [ ] **Lebih dari 1 button primary di area yang sama?** Hierarki harus jelas: 1 primary, sisanya secondary/outline.
- [ ] **Animasi `infinite`?** Hapus kecuali loading spinner.
- [ ] **Tagline klise?** Baca subtitle/heading dengan suara keras — kedengaran natural Indonesia atau marketing-speak?
- [ ] **Konten real atau Lorem Ipsum?** Cek setiap text — sudah dari seeder real?
- [ ] **Bahasa Indonesia konsisten?** Submit/Cancel/Save → Kirim/Batal/Simpan.
- [ ] **Padding section masuk akal?** Mobile 40px, desktop max 80px (sesuai `.agents/rules/desain-ui.md`).
- [ ] **Card vs Tabel — pilihan tepat?** Download list = tabel. Konten kaya media = card.
- [ ] **3-state coverage**: Loading (skeleton), Empty (informatif + CTA), Error (friendly + retry)?
- [ ] **Konsisten dengan halaman lain di proyek?** Bukan paradigm baru di tengah jalan.

---

## 6. Acid Tests

### Test 1: "Apa yang dilakukan website ini?"
Tunjukkan halaman beranda ke orang random selama 5 detik. Tanya: *"Ini website apa?"*

✅ **PASS**: "Website jurusan kuliah" / "Website kampus politeknik"
❌ **FAIL**: "Startup teknologi" / "Aplikasi SaaS" / "Tidak yakin"

### Test 2: "Mana aksi utama di halaman ini?"
Tunjukkan halaman tertentu. Tanya: *"Kalau kamu mau X, klik apa?"*

✅ **PASS**: User langsung tunjuk button primary yang benar
❌ **FAIL**: User ragu antara 2-3 button karena warna sama-sama mencolok

### Test 3: "Konten ini real atau dummy?"
Tunjukkan halaman dengan data. Tanya: *"Menurutmu, ini data sungguhan atau placeholder?"*

✅ **PASS**: User percaya data real (nama dosen wajar, tanggal masuk akal)
❌ **FAIL**: "Kayak data dummy" / "Lorem ipsum-nya kelihatan"

---

## 7. Related Rules

### Windsurf Native Rules (`.windsurf/rules/` — auto-inject)
- `.windsurf/rules/identitas-website.md` — data institusi & jurusan (nama, prodi, kontak, akreditasi)

### Detail Rules (`.agents/rules/`)
- `.agents/rules/desain-ui.md` — color palette, layout patterns, components
- `.agents/rules/bahasa-indonesia.md` — UI labels, validation messages
- `.agents/rules/library-standard.md` — Bootstrap Icons (no emoji), no random libraries
- `.agents/rules/responsive-mobile.md` — touch targets, hover wrapping
- `.agents/rules/performance-css.md` — animation limits (transform/opacity only)
- `.agents/rules/a11y.md` — semantic HTML, focus indicators

### Referensi Eksternal
- `c:/Users/riki/Documents/Projek-PBL-Semester-6/.agents/rules/desain-ui.md` Section 1 — sumber inspirasi rule anti-AI
