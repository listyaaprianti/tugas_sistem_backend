# Aplikasi CRUD Produk #

# Deskripsi Aplikasi #
- Entitas yang dipilih : Produk
- Fungsi aplikasi :
Aplikasi ini digunakan untuk mengelola produk secara sederhana. Aplikasi ini bisa menambahkan, melihat, mengubah, dan menghapus produk. Setiap produk memiliki:
- Nama produk
- Kategori
- Harga
- Stok
- Status (active/inactive)
- Gambar

# Fitur #
- Daftar Produk : Semua produk ditampilkan dalam kartu yang rapi. Ada tombol Edit dan Hapus di bawah tiap produk.

- Tambah Produk : Form untuk menambahkan produk baru, termasuk upload gambar.

- Edit Produk : Mengubah data produk yang sudah ada, termasuk gambar.

- Hapus Produk : Menghapus produk langsung dari daftar.

# Spesifikasi Teknis #
- Versi PHP : 8.x atau terbaru
- DBMS : MySQL

# Struktur Program #
- public/ → file front-end (index.php, create.php, edit.php, delete.php, CSS)
- uploads/ → menyimpan gambar produk
- src/ → file PHP untuk operasi CRUD (Product.php, ProductRepository.php)
- config/ → koneksi database (database.php)
- schema.sql → script membuat database dan tabel

# Class utama #
- Database : Mengatur koneksi ke MySQL
- Product (Entity) : Mendefinisikan struktur data produk
- ProductRepository : Menangani operasi CRUD di database

# Instruksi Menjalankan Aplikasi #
- Impor basis data:
Jalankan file schema.sql di MySQL untuk membuat database dan tabel.

- Atur koneksi database:
Sesuaikan config/database.php dengan username, password, dan nama database (crud_produkk).

- Akses aplikasi:
Buka browser dan kunjungi:
http://localhost/crud_produk/public/index.php

# Contoh Penggunaan #
# Menambahkan Produk
- Klik Tambah Produk
- Isi nama, kategori, harga, stok, status, dan pilih gambar
- Klik Tambah → produk muncul di daftar

# Mengedit Produk
- Klik tombol Edit di produk yang ingin diubah
- Ubah informasi dan gambar jika perlu
- Klik Update → perubahan tersimpan

# Menghapus Produk
- Klik tombol Hapus → produk akan hilang dari daftar

# Catatan #
- Semua gambar tersimpan di folder uploads/, database hanya menyimpan path.
- Form tambah dan edit dirancang rapi dan mudah digunakan.