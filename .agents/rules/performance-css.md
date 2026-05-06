# CSS Performance & Animation: Website Jurusan R&K

## Prinsip

Animasi CSS yang **smooth** = hanya animate properties yang **GPU-accelerated**. Animasi yang lag bukan karena device lemah, biasanya karena **CSS animate properties yang trigger layout/paint**.

**Aturan Emas**: Untuk animasi 60fps, **HANYA** animate `transform` dan `opacity`.

---

## 1. CSS Properties — Cost Tier

### 🟢 CHEAP (animate freely, GPU composite)
| Property | Rendering Cost |
|----------|----------------|
| `transform` (translate, rotate, scale, skew) | GPU layer |
| `opacity` | GPU layer |
| `filter` (kecuali `blur`) | GPU |

### 🟡 MEDIUM (animate hati-hati)
| Property | Cost |
|----------|------|
| `background-color`, `color` | Paint |
| `border-color` | Paint |
| `outline-color` | Paint |
| `visibility` (instant only) | None |

### 🔴 EXPENSIVE (JANGAN animate!)
| Property | Cost | Trigger |
|----------|------|---------|
| `padding`, `margin` | Layout | Reflow seluruh subtree |
| `width`, `height` | Layout | Reflow |
| `top`, `left`, `right`, `bottom` | Layout | Reflow |
| `font-size` | Layout | Reflow + paint |
| `border-width` | Layout | Reflow |
| `box-shadow` (terutama `inset` / besar `blur`) | Paint | Recalculate per frame |
| `backdrop-filter: blur()` | GPU heavy | Re-blur per frame |
| `text-shadow` | Paint | Subtree paint |

---

## 2. Anti-Pattern Real dari Project Ini

### ❌ SALAH — Padding-Left Transition (kasus mobile drawer)
```css
.drawer-subitem {
    padding: 10px 20px 10px 56px;
    transition: padding-left 0.2s ease;  /* ← LAYOUT REFLOW per frame */
}

.drawer-subitem:hover {
    padding-left: 60px;  /* ← Reflow trigger */
}
```

**Dampak**: Saat Bootstrap collapse animate `height`, kombinasi dengan padding transition = **multiple layout passes per frame** = lag bahkan di Realme 13 Plus 5G (mid-high tier).

### ✅ BENAR — Pakai Transform
```css
.drawer-subitem {
    padding: 10px 20px 10px 56px;
    transition: background-color 0.15s ease, transform 0.2s ease;
}

.drawer-subitem:hover {
    background-color: rgba(27, 108, 176, 0.08);
    transform: translateX(4px);  /* GPU composite, no reflow */
}
```

### ❌ SALAH — Box-Shadow Inset di Container yang Animate Height
```css
.drawer-submenu {
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.03);  /* ← Repaint per frame saat collapse */
}
```

### ✅ BENAR
```css
.drawer-submenu {
    background-color: rgba(0, 0, 0, 0.02);  /* Solid bg = no per-frame recalc */
}
```

### ❌ SALAH — Backdrop-Filter Blur (mobile killer)
```css
.offcanvas-backdrop.show {
    backdrop-filter: blur(8px);  /* ← Re-blur tiap frame, GPU heavy di HP */
}
```

### ✅ BENAR
```css
.offcanvas-backdrop.show {
    background-color: rgba(0, 0, 0, 0.5);  /* Solid overlay */
}
```

### ❌ SALAH — Stagger Animations (jumpy feel)
```css
/* 13 items dengan delay bertahap = visual "satu-satu" */
.drawer-menu li:nth-child(1) { animation-delay: 0.20s; }
.drawer-menu li:nth-child(2) { animation-delay: 0.25s; }
/* ... 7 items ... */
```

**Dampak**: User merasa "kayak refresh" karena items muncul satu-per-satu, bukan natural.

### ✅ BENAR — Single Coordinated Animation
```css
/* Semua content fade-in bareng dalam 1 animasi */
.drawer-content {
    animation: fadeIn 0.3s ease-out;
}
```

### ❌ SALAH — Animate `height: auto`
```css
@keyframes expand {
    from { height: 0; }
    to { height: auto; }  /* ← TIDAK BISA dianimate, browser ga tahu target value */
}
```

### ✅ BENAR — CSS Grid `grid-template-rows: 0fr → 1fr` (REKOMENDASI utama)
Pattern modern accordion paling smooth di mobile (Chrome 117+, Safari 17.2+, FF 119+).
Keuntungan vs Bootstrap collapse:
- Browser optimisasi single grid track interpolation
- Tidak butuh JS measure `scrollHeight` tiap frame
- Bisa di-isolate via `contain: layout paint` → reflow tidak menjalar ke parent

```html
<button data-drawer-toggle data-drawer-target="#submenu" aria-expanded="false">Toggle</button>
<div class="submenu-wrap" id="submenu">
    <ul class="submenu">...</ul>
</div>
```

```css
.submenu-wrap {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    contain: layout paint;          /* isolate reflow ke wrapper */
}
.submenu-wrap.is-open { grid-template-rows: 1fr; }
.submenu-wrap > .submenu {
    overflow: hidden;               /* clip saat collapsed */
    min-height: 0;                  /* required untuk grid 0fr trick */
}

/* Fallback untuk browser lama */
@supports not (grid-template-rows: 1fr) {
    .submenu-wrap { display: block; height: 0; overflow: hidden; }
    .submenu-wrap.is-open { height: auto; }
}
```

Referensi implementasi nyata: `public/frontend/css/custom.css` (`.drawer-submenu-wrap`)
+ `resources/views/layouts/frontend.blade.php` (toggle handler `[data-drawer-toggle]`).

### ⚠️ Alternatif — `max-height` (legacy, terima trade-off)
```css
/* max-height masih trigger layout, tapi terbatas ke wrapper.
   Pakai HANYA jika tidak butuh dukungan animasi & target browser sangat lama. */
.expandable {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}
.expandable.open {
    max-height: 500px;  /* harus lebih besar dari konten asli */
}
```
Kekurangan: kalau konten dinamis & lebih tinggi dari `max-height` → ke-clip; kalau
set terlalu besar → animasi terlihat "telat" (jeda di awal saat traverse jarak
antara konten aktual dan max value).

---

## 3. `will-change` — Hint GPU Layer

### Kapan Pakai
Saat element akan di-animate dengan `transform` / `opacity` yang complex:
```css
.mobile-drawer.offcanvas-start {
    transition: transform 0.45s ease;
    will-change: transform;  /* Browser pre-allocate GPU layer */
}
```

### Kapan JANGAN Pakai
- Untuk SEMUA element (overhead memori GPU)
- Element static yang tidak akan animate
- Dengan value `auto` (no benefit)

### Best Practice
```css
/* ✅ Apply only to elements yang AKAN animate */
.drawer.collapsing {
    will-change: height;
}

/* ✅ Reset setelah animation selesai */
.drawer:not(.collapsing) {
    will-change: auto;  /* Free GPU memory */
}
```

---

## 4. `@media (hover: hover)` — Mobile-Aware Hover

### Masalah
`:hover` di mobile = "sticky hover" (state stuck setelah tap, hilang saat tap area lain). Bikin UI feel buggy.

### Solusi
Wrap hover effects di media query:
```css
/* Hover hanya di device dengan mouse */
@media (hover: hover) {
    .drawer-item:hover {
        background-color: rgba(27, 108, 176, 0.06);
        transform: scale(1.02);
    }
}

/* Mobile pakai :active instead */
.drawer-item:active {
    background-color: rgba(27, 108, 176, 0.12);
}
```

---

## 5. Bootstrap Component Considerations

### Bootstrap Collapse (`.collapse`) — ⚠️ AVOID untuk submenu mobile
Project ini sudah **memigrasi** mobile drawer submenu dari Bootstrap collapse
ke CSS Grid pattern karena `height` transition fundamentally trigger reflow
per-frame & lag bahkan di device flagship.

**Ringkasan masalah Bootstrap collapse**:
- Animate `height: auto` lewat measure scrollHeight runtime → set inline `style.height` tiap frame
- Reflow menjalar ke ancestor (drawer body, offcanvas, body)
- Jangan tambah `padding-left` / `box-shadow` transition di item dalam collapse (multiple layout passes)
- Animasi tambahan di item HANYA setelah `.show` apply → feel "2-stage refresh"

**Boleh dipakai untuk**:
- Toggle yang jarang dibuka/tutup (tidak interaktif, mis. FAQ desktop)
- Konten dengan layout sederhana di atas collapse (sedikit ancestor reflow)

**JANGAN dipakai untuk**:
- Mobile drawer / offcanvas accordion → pakai grid-template-rows pattern (lihat §2)
- Element bersarang dalam scrollable container (recalc per frame)

### Bootstrap Offcanvas (`.offcanvas`)
- Default: `transform 0.3s ease-in-out`
- Override easing OK, jangan animate inner content opacity (cause "blank flash")
- Backdrop default fade fine, **jangan** tambah blur

### Bootstrap Modal (`.modal`)
- Default fade: `opacity 0.15s linear`
- Modal-dialog scale via `transform` (OK)
- Jangan animate modal width/height

---

## 6. Performance Checklist (Sebelum Commit Animation)

Sebelum commit CSS dengan transition/animation:

- [ ] Hanya pakai `transform` & `opacity` di transition? (kalau bukan, pertimbangkan alternative)
- [ ] Tidak ada `padding`, `margin`, `width`, `height` di transition list?
- [ ] Tidak ada `box-shadow` dengan blur besar yang animate?
- [ ] Tidak ada `backdrop-filter: blur` di backdrop?
- [ ] Stagger animations <5 items? (lebih dari itu = jumpy feel)
- [ ] `:hover` effects di-wrap `@media (hover: hover)`?
- [ ] `will-change` di-set ke property yang animate (bukan `all`)?
- [ ] `will-change` di-reset ke `auto` setelah animation?
- [ ] `prefers-reduced-motion` di-honor (a11y)?
- [ ] Test di **HP entry/mid-tier**, bukan cuma desktop emulator?

---

## 7. Tools Profiling

### Chrome DevTools Performance Tab
1. Open DevTools (F12)
2. Tab **Performance**
3. Click record (●)
4. Trigger animation (klik tombol, scroll, dll)
5. Stop record
6. Cek timeline:
   - **Long Frames** (>16ms) = lag
   - **Purple bars (Layout)** = reflow (bad)
   - **Green bars (Paint)** = paint (medium)
   - **Yellow bars (Composite)** = GPU (good)

### Target
- Frame time: **<16ms** (60fps)
- Layout time: **<5ms per frame**
- Paint area: **kecil** (lihat "Paint flashing" di Rendering tab)

### Chrome DevTools Rendering Tab
- Enable **"Paint flashing"** → area yang repaint berkedip hijau
- Enable **"Layer borders"** → lihat GPU layers
- Enable **"FPS meter"** → frame rate counter
- Test **"Throttle CPU 4x slowdown"** untuk simulasi HP entry-level

### Mobile Real Device Test
```
Test di HP fisik via local network:
1. ipconfig (cari IP komputer)
2. php artisan serve --host=0.0.0.0
3. Buka di HP: http://[ip-komputer]:8000
```

---

## 8. Reference Real Cases dari Project Ini

### Case 1: Mobile Drawer Submenu Lag (Realme 13 Plus 5G)
**Issue**: Submenu expand terasa berat meski device kuat.

**Root cause**: 
1. `transition: ..., padding-left 0.2s` di `.drawer-subitem` = layout reflow per frame
2. `box-shadow: inset` di `.drawer-submenu` = repaint per frame
3. `border-bottom` di setiap subitem = paint per frame
4. Kombinasi dengan Bootstrap collapse height animation

**Fix**: Hapus semua property expensive dari transition. Hanya animate `background-color`, `color`, dan `transform`.

**Hasil**: 60fps smooth.

### Case 2: Drawer "Blank Putih Flash" Saat Open
**Issue**: Drawer pertama kali open ada white flash sebentar sebelum content muncul.

**Root cause**:
- Inner content punya `opacity: 0` sebagai initial state animation
- Drawer slide masuk DULU, content fade-in BELAKANG = ada gap visual = "blank flash"

**Fix**: Hapus animasi inner content. Drawer slide saja, content sudah visible dari awal (drawer container white background).

**Hasil**: No flash, immediate content visibility.

### Case 3: Drawer Slide Tidak Smooth
**Issue**: Drawer transisi feel kasar.

**Root cause**: `cubic-bezier(0.32, 0.72, 0, 1)` (Apple style) terlalu "snappy" untuk taste user.

**Fix**: Material Design easing `cubic-bezier(0.4, 0, 0.2, 1)` dengan duration 0.45s (vs 0.35s).

**Hasil**: Smoother feel, tidak terburu-buru.

---

## 9. Larangan

- ❌ JANGAN animate properties yang trigger layout (padding, margin, width, height, top, left, dll)
- ❌ JANGAN pakai `box-shadow` dengan large blur radius dalam transition
- ❌ JANGAN pakai `backdrop-filter: blur()` di mobile
- ❌ JANGAN buat stagger animations >5 items (jumpy feel)
- ❌ JANGAN animate inner content opacity saat parent slide (cause flash)
- ❌ JANGAN `will-change: all` (boros memori GPU)
- ❌ JANGAN forget `prefers-reduced-motion` (WCAG violation)
- ❌ JANGAN pakai `:hover` tanpa `@media (hover: hover)` di mobile component
- ❌ JANGAN test animation cuma di desktop emulator — selalu HP fisik atau CPU throttle

---

## 10. Quick Wins untuk Animasi Smooth

### Replace pattern lambat dengan cepat:

| ❌ Lambat | ✅ Cepat |
|-----------|----------|
| `transition: padding-left` | `transition: transform; transform: translateX(8px)` |
| `transition: width` | `transition: transform; transform: scaleX(1.1)` |
| `transition: height` (auto) | `grid-template-rows: 0fr→1fr` + `contain: layout paint` (rekomendasi), atau `max-height` legacy |
| `transition: top` | `transition: transform; transform: translateY(8px)` |
| `transition: box-shadow` (animate blur) | Pre-render kedua state, transition `opacity` antara keduanya |
| Backdrop blur | Solid color overlay dengan opacity |
| `font-size` transition | `transform: scale()` |

---

## Referensi
- [CSS Triggers](https://csstriggers.com/) — list properties dan rendering cost
- [Animations and Performance](https://web.dev/articles/animations-guide) — Google web.dev
- [What Forces Layout/Reflow](https://gist.github.com/paulirish/5d52fb081b3570c81e3a) — Paul Irish
- [Bootstrap 5 Transitions](https://getbootstrap.com/docs/5.3/utilities/transitions/) — official docs
