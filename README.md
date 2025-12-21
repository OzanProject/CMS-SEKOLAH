# MyPortal Sekolah (Smart School Portal)

![MyPortal Sekolah Banner](https://placehold.co/1200x400/2563eb/ffffff?text=MyPortal+Sekolah)

**MyPortal Sekolah** adalah sistem informasi sekolah terintegrasi yang modern, responsif, dan kaya fitur. Aplikasi ini dirancang untuk memudahkan manajemen sekolah mulai dari publikasi berita, penerimaan siswa baru (PPDB), e-voting OSIS, hingga manajemen data siswa dan guru secara efisien.

Dibangun dengan **Laravel 12** dan teknologi web terbaru, MyPortal Sekolah menawarkan performa tinggi, keamanan standar industri, dan antarmuka yang ramah pengguna baik untuk admin maupun pengunjung publik.

## 🚀 Fitur Unggulan

### 🌐 Halaman Publik (Public Frontend)
*   **Beranda Dinamis**: Banner utama otomatis menampilkan artikel terbaru, bagian "Trending News" berbasis jumlah tayangan, dan "Latest News".
*   **Profil Sekolah**: Visi, misi, sejarah, dan struktur organisasi.
*   **Berita & Artikel**: Kategori artikel, pencarian, dan label featured.
*   **Galeri Kegiatan**: Dokumentasi foto kegiatan sekolah.
*   **Program & Fasilitas**: Informasi lengkap program unggulan dan sarana prasarana.
*   **Layanan Digital & Kontak**: Tautan cepat ke layanan eksternal dan formulir kontak.

### 🔐 Panel Admin (Backend CMS)
*   **Dashboard Informatif**: Statistik real-time pendaftar PPDB, voting aktif, jumlah artikel, dan data master.
*   **Manajemen Artikel (CMS)**:
    *   Editor Rich Text (WYSIWYG).
    *   Kategori Berita.
    *   Fitur "Headline/Featured" manual.
    *   Upload gambar dengan preview.
*   **Data Master Sekolah**:
    *   **Siswa**: Import Excel, Export Template, **Hapus Masal (Bulk Delete)**, dan pencarian NISN.
    *   **Guru & Tendik**: Manajemen data staff pengajar.
    *   **Kelas & Panitia**: Pengaturan rombel dan kepanitiaan.
*   **PPDB Online (Penerimaan Peserta Didik Baru)**:
    *   Formulir pendaftaran online.
    *   Validasi status (Diterima / Menunggu / Ditolak).
    *   Export data pendaftar ke PDF.
*   **E-Voting System**:
    *   Manajemen Kandidat & Event Voting.
    *   Generate Token unik.
    *   Hitung Cepat (Quick Count) real-time.
*   **Manajemen Iklan**: Pengturan banner iklan di berbagai posisi strategis.
*   **Pengaturan Sekolah**: Logo, nama sekolah, dan informasi kontak global.

## 🛠️ Teknologi yang Digunakan

*   **Backend Framework**: [Laravel 12.x](https://laravel.com)
*   **Language**: PHP 8.3+
*   **Database**: MySQL / MariaDB
*   **Frontend Public**: [Tailwind CSS 3](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
*   **Frontend Admin**: [AdminLTE 3](https://adminlte.io), Bootstrap 4
*   **Build Tool**: [Vite](https://vitejs.dev)
*   **Other Libraries**:
    *   `maatwebsite/excel`: Import/Export Excel.
    *   `barryvdh/laravel-dompdf`: Export PDF.
    *   `intervention/image`: Manipulasi gambar.
    *   `sweetalert2`: Notifikasi pop-up interaktif.

## ⚙️ Persyaratan Sistem (Requirements)

Sebelum menginstall, pastikan server Anda memenuhi syarat berikut:

*   **PHP**: >= 8.2
*   **Composer**: Terbaru
*   **Node.js & NPM**: Terbaru (untuk compile assets)
*   **Database**: MySQL 5.7+ atau MariaDB 10.3+
*   **Web Server**: Apache / Nginx
*   **PHP Extensions**: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML.

## 📥 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di local environment:

1.  **Clone Repository**
    ```bash
    git clone https://github.com/OzanProject/CMS-SEKOLAH.git
    cd CMS-SEKOLAH
    ```

2.  **Install Dependencies (PHP & JS)**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Sesuaikan konfigurasi database di file `.env`:
    ```ini
    DB_DATABASE=myportal_sekolah
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate App Key**
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi Database & Seeder**
    Jalankan migrasi untuk membuat tabel dan mengisi data awal (user admin default):
    ```bash
    php artisan migrate --seed
    ```

6.  **Compile Assets**
    ```bash
    npm run build
    # Atau untuk development: npm run dev
    ```

7.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Akses aplikasi di `http://127.0.0.1:8000`.

## 👤 Akun Default (Seeder)

Jika Anda menjalankan `--seed`, akun administrator default adalah:

*   **Email**: `admin@sekolah.sch.id`
*   **Password**: `password`

> **Penting**: Segera ganti password setelah login pertama kali demi keamanan.

## 📂 Struktur Folder Penting

*   `app/Http/Controllers/Admin`: Logika backend panel admin.
*   `app/Http/Controllers/HomeController.php`: Logika halaman depan (beranda).
*   `resources/views/home`: Template halaman publik.
*   `resources/views/admin`: Template panel admin (AdminLTE).
*   `routes/web.php`: Routing halaman publik.
*   `routes/admin.php`: Routing khusus panel admin.

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat **Pull Request** baru untuk perbaikan bug atau fitur baru. Pastikan kode Anda mengikuti standar PSR yang berlaku di Laravel.

## 📄 Lisensi

MyPortal Sekolah adalah perangkat lunak open-source di bawah lisensi [MIT license](https://opensource.org/licenses/MIT).

---
**Dibuat dengan ❤️ oleh Tim Developer Sekolah**
