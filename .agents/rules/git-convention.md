# Git Convention: Website Jurusan R&K

## 1. Branch Naming

### Pattern
```
{type}/{short-description}
```

### Type
| Type | Kapan |
|------|-------|
| `feature/` | Fitur baru (CRUD, modul, dll) |
| `fix/` | Bug fix |
| `refactor/` | Refactor tanpa ubah behavior |
| `docs/` | Dokumentasi saja |
| `style/` | CSS/UI tweaks |
| `test/` | Tambah/update test |
| `chore/` | Build script, config, deps update |

### Contoh
```
feature/upload-inline-image-berita
fix/breadcrumb-warna-putih
refactor/sidebar-artikel-view-composer
docs/update-rules-windsurfrules
```

---

## 2. Commit Message — Conventional Commits

### Format
```
{type}: {deskripsi singkat}

{body opsional, jelaskan WHY bukan WHAT}

{footer opsional, e.g. Closes #123}
```

### Contoh Bagus
```
feat: tambah upload gambar inline di TinyMCE

Admin sekarang bisa upload gambar langsung dari komputer 
ke editor berita via tombol toolbar, drag-drop, atau paste.
Gambar otomatis di-resize ke max 1600px untuk hemat storage.

Closes #45
```

```
fix: breadcrumb-disabled tidak terlihat di background terang

Class .breadcrumb-disabled sebelumnya pakai rgba putih 
yang invisible di section dengan bg-light Eterna template.
Ganti ke #6c757d (Bootstrap muted gray).
```

### Contoh Buruk
```
update                           ← terlalu pendek, tidak deskriptif
fix bug                          ← bug apa?
WIP                              ← jangan commit WIP ke main
asdasdasd                        ← jangan
ngerjain berita                  ← informal, tidak jelas
```

---

## 3. `.gitignore` Wajib

```gitignore
# Laravel
/node_modules
/public/build
/public/hot
/public/storage
/storage/*.key
/storage/pail
/vendor
.env
.env.backup
.env.production
.phpactor.json
.phpunit.result.cache
Homestead.json
Homestead.yaml
auth.json
npm-debug.log
yarn-error.log
/.fleet
/.idea
/.nova
/.vscode
/.zed

# OS
.DS_Store
Thumbs.db

# IDE / Editor
*.swp
*.swo

# Project-specific
/public/mockup-*.html  ← mockup HTML jangan commit ke production
/scratch/              ← folder eksperimen pribadi
```

---

## 4. Yang JANGAN Commit

- ❌ `.env` — credential
- ❌ `vendor/` — auto-generated dari composer
- ❌ `node_modules/` — auto-generated dari npm
- ❌ `storage/app/public/*` — file upload user
- ❌ `public/storage` — symlink, beda per environment
- ❌ Mockup HTML / draft / WIP
- ❌ File credential (auth.json, key files)
- ❌ Personal IDE config (kecuali tim sepakat)

---

## 5. Workflow Branching

### Solo Developer
```
main (stabil) ── feature/x ── merge ── push
                fix/y ── merge ── push
```

### Tim
```
main          (production)
  └── develop (staging)
       ├── feature/x
       ├── feature/y
       └── fix/z
```

---

## 6. Pull Request Checklist

Sebelum merge PR:
- [ ] Code review oleh minimal 1 orang lain
- [ ] `php vendor/laravel/pint/builds/pint --test` pass
- [ ] `php artisan test` pass
- [ ] Manual test fitur berfungsi
- [ ] Screenshot kalau ada UI change
- [ ] Update CHANGELOG.md (kalau ada)
- [ ] Tidak ada `dd()`, `dump()`, `console.log` tersisa
- [ ] Tidak ada `// TODO` yang harusnya selesai

---

## 7. Sensitive Data Handling

Kalau **TIDAK SENGAJA** commit credential:
1. Ubah credential SECEPATNYA (rotate password, regenerate API key)
2. Pakai `git filter-branch` atau BFG Repo-Cleaner untuk hapus dari history
3. Force push ke remote
4. Lapor tim — credential lama mungkin sudah ter-leak

```bash
# Hapus file dari history (DESTRUCTIVE)
git filter-branch --force --index-filter \
    "git rm --cached --ignore-unmatch .env" \
    --prune-empty --tag-name-filter cat -- --all

git push origin --force --all
```

---

## 8. Commit Frequency

- ✅ Commit logical unit (1 fitur kecil = 1 commit)
- ✅ Commit at least once per work session
- ❌ JANGAN commit "save point" tanpa deskripsi
- ❌ JANGAN squash commits berbeda fitur jadi 1
- ❌ JANGAN commit kode yang tidak compile / test gagal

---

## 9. Tag & Release

Pakai semantic versioning:
```
v1.0.0  ← MAJOR (breaking change)
v1.1.0  ← MINOR (fitur baru)
v1.1.1  ← PATCH (bug fix)
```

Tag setelah merge ke main:
```bash
git tag -a v1.0.0 -m "Initial release"
git push origin v1.0.0
```
