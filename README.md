# 📂 ArsipApp - Manajemen Arsip Digital

**Nama : Shafa Disya Aulia**  
**NPM : 2308107010002**

---

## 📝 Deskripsi Singkat

ArsipApp adalah aplikasi web untuk mengelola arsip digital (PDF & gambar) dengan sistem role-based access:

- **Admin**: Melihat & mengelola semua arsip dan user dari seluruh departemen.
- **User**: Hanya dapat mengelola arsip milik departemennya sendiri.

### Fitur Utama

- Upload arsip dengan kategori tertentu
- Nomor surat wajib untuk kategori surat undangan & peminjaman
- Hak akses berdasarkan role & departemen
- Pagination (10 arsip per halaman)
- CRUD arsip (Create, Read, Update, Delete)
- CRUD user (khusus admin)
- Autentikasi (login, register, logout)

---

## 💻 Penjelasan Kode & Interface

### Struktur Controller

- `ArsipController`:  
  Mengatur seluruh proses CRUD arsip:
  - **index()**: Menampilkan daftar arsip sesuai role
  - **create() / store()**: Form & logika upload file
  - **show() / edit() / update()**: Detail & edit arsip (dengan otorisasi departemen)
  - **destroy()**: Hapus arsip & file dari storage

- `UserController`:  
  Mengelola data user (hanya bisa diakses admin):
  - **index()**: Daftar user
  - **create() / store()**: Tambah user baru
  - **edit() / update()**: Edit data user
  - **destroy()**: Hapus user

- **Auth Controller** (bawaan Laravel):  
  Mengatur login, register, dan logout.

### Interface

- **Dashboard**: Daftar arsip (dengan filter & pagination)
- **Form Upload**: Input judul, deskripsi, kategori, nomor surat (jika perlu), dan file
- **Tabel Arsip**: Kolom Judul, Departemen, Kategori, dan Aksi (lihat/edit/hapus)
- **Manajemen User**: (khusus admin) daftar, tambah, edit, hapus user

---

## ⚙️ Cara Instalasi

1. **Clone Repository:**
    ```bash
    git clone https://github.com/shafadisya/arsip-app.git
    cd arsip-app
    ```

2. **Install Dependency:**
    ```bash
    composer install
    npm install
    ```

3. **Copy & Edit Environment:**
    ```bash
    cp .env.example .env
    # Edit file .env sesuai konfigurasi database Anda
    ```

4. **Generate Key & Migrate Database:**
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

5. **Jalankan Server:**
    ```bash
    php artisan serve
    ```

---

## 🧑‍💻 Requirement

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & NPM

---

## 📄 Lisensi

Aplikasi ini dibuat untuk keperluan pembelajaran.