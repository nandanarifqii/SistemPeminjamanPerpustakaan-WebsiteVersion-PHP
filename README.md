# Proyek Implementasi Sistem Informasi - Sistem Peminjaman Buku Perpustakaan
Proyek ini adalah implementasi terstruktur berdasarkan requirement yaitu berupa
sistem peminjaman buku perpustakaan yang mencakup dua use case utama: Mencari Buku dan Meminjam Buku dalam bentuk Website menggunakan Pemrograman Bahasa PHP.

## Use Case Overview
### Mencari Buku (Objective: Peminjam dapat mencari buku berdasarkan judul.)
Flow:
- Peminjam memilih menu pencarian buku.
- Sistem menampilkan tampilan pencarian buku.
- Peminjam memasukkan judul buku dan menekan tombol cari.
- Sistem menampilkan daftar buku sesuai kata kunci.

Alternative Flows:
- Buku tidak ditemukan: Sistem menampilkan pesan error.
- Sistem tidak dapat terhubung ke database: Sistem menampilkan pesan error.

### Meminjam Buku (Objective: Peminjam meminjam buku)
Flow:
- Peminjam memilih menu peminjaman buku.
- Sistem menampilkan form peminjaman.
- Peminjam mencari dan memilih buku.
- Peminjam memasukkan lama peminjaman dan menekan tombol pinjam.
- Sistem menampilkan konfirmasi peminjaman.
  
Alternative Flows:
- Buku tidak terdaftar: Sistem menampilkan pesan error.
- Lama peminjaman lebih dari 3 hari: Sistem menampilkan pesan error.
- Jumlah buku melebihi 10: Sistem menampilkan pesan error.

## Desain UI Overview
- Halaman Utama
- Form Pencarian
- Form Peminjaman


<img align="center" width="1000" src="Peminjaman Buku Implementasi Terstruktur.png" />
