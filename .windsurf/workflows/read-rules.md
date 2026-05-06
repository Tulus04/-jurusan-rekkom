---
description: BACA SEMUA RULES — gunakan ini di awal task non-trivial untuk pastikan compliance
---

# Workflow: Read All Rules

Trigger workflow ini dengan `/read-rules` di awal task non-trivial agar Cascade baca semua rules detail sebelum eksekusi.

## Files yang akan dibaca

### Windsurf Native Rules (`.windsurf/rules/`) — auto-inject ke setiap conversation
1. `anti-ai-generated.md` — Larangan desain/konten yang terlihat AI-generated (emoji acak, rainbow gradient, tagline klise)
2. `identitas-website.md` — Data resmi institusi, jurusan, 4 prodi, kontak, visi-misi, target audience

### Rules Detail (`.agents/rules/`)
1. `persona.md` — Senior Architect persona, anti-yes-man
2. `arsitektur-proyek.md` — MVC + Repository pattern, struktur folder
3. `tech-stack.md` — Laravel 12, PHP 8.2+, Bootstrap 5, dll
4. `kualitas-kode.md` — PSR-12, strict_types, naming, Pint
5. `keamanan.md` — Auth, Form Request, CSRF, file upload validation
6. `library-standard.md` — Library yang diizinkan vs dilarang
7. `desain-ui.md` — Color palette, layout pattern, komponen wajib
8. `skill-debugging.md` — 4 fase: REPRODUCE → ISOLATE → FIX → VERIFY
9. `skill-verification.md` — Gate function, jangan klaim selesai tanpa bukti
10. `akun-test.md` — Credential admin testing

### Workflows (`.agents/workflows/` & `.windsurf/workflows/`)
- `new-feature.md` — Workflow bangun fitur baru
- `verify-feature.md` — Workflow verifikasi setelah selesai
- `build-check.md` — Workflow build check sebelum commit
- `dev-server.md` — Cara jalankan dev server
- `reference-old-project.md` — Cara cari referensi proyek lama

## Output
Setelah baca semua, Cascade harus konfirmasi:
1. Rules apa yang relevan dengan task user
2. Workflow mana yang akan diikuti
3. Pertanyaan klarifikasi (jika ada)
4. Plan eksekusi singkat (3-5 step)

## Catatan
File `.windsurfrules` di root sudah berisi RINGKASAN semua rules ini dan auto-injected ke setiap conversation.
Workflow ini hanya perlu dijalankan jika butuh detail penuh atau lupa konteks.
