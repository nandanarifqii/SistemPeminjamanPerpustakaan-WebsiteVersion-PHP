<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["kembalikan"])) {
    $idPeminjaman = $_POST["peminjaman_id"];
    $idBukuDikembalikan = $_POST["buku_id"];
    
    $link = new mysqli("localhost:3307", "root", "", "perpustakaan");

    if (!$link) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Hapus buku dari tabel "dipinjam"
    $queryDelete = "DELETE FROM dipinjam WHERE peminjaman_id = $idPeminjaman AND buku_id = $idBukuDikembalikan";
    $resultDelete = $link->query($queryDelete);

    if ($resultDelete) {
        // Cek apakah buku dengan ID yang sama sudah ada dalam tabel "buku"
        $queryCheck = "SELECT id FROM buku WHERE id = $idBukuDikembalikan";
        $resultCheck = $link->query($queryCheck);

        if ($resultCheck->num_rows == 0) {
            // Jika buku belum ada dalam tabel "buku", masukkan kembali buku ke tabel "buku"
            $queryInsert = "INSERT INTO buku (id, judul) SELECT $idBukuDikembalikan, judul FROM buku WHERE id = $idBukuDikembalikan";
            $resultInsert = $link->query($queryInsert);

            if ($resultInsert) {
                $pesan = "Buku berhasil dikembalikan.";
            } else {
                $pesan = "Terjadi kesalahan saat memasukkan buku kembali ke tabel buku.";
            }
        } else {
            
        }
    } else {
        $pesan = "Terjadi kesalahan saat menghapus buku dari tabel dipinjam.";
    }

    $link->close();
}

// Fungsi untuk mengambil daftar buku yang dipinjam
function getDaftarBukuDipinjam()
{
    $link = new mysqli("localhost:3307", "root", "", "perpustakaan");

    if (!$link) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $query = "SELECT dp.peminjaman_id, dp.buku_id, b.judul FROM dipinjam dp INNER JOIN buku b ON dp.buku_id = b.id";
    $result = $link->query($query);

    $daftarBuku = array();
    while ($row = $result->fetch_assoc()) {
        $daftarBuku[] = $row;
    }

    $link->close();

    return $daftarBuku;
}

// Tampilkan pesan sukses atau pesan error jika ada
$pesan = isset($pesan) ? $pesan : "";

// Ambil daftar buku yang dipinjam
$daftarBukuDipinjam = getDaftarBukuDipinjam();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengembalian Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        a.button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pengembalian Buku</h1>
        
        <p><?php echo $pesan; ?></p>
        
        <h2>Daftar Buku yang Dipinjam</h2>
        <table>
            <tr>
                <th>Peminjaman ID</th>
                <th>Buku ID</th>
                <th>Judul</th>
                <th>Kembalikan</th>
            </tr>
            <?php foreach ($daftarBukuDipinjam as $buku) { ?>
                <tr>
                    <td><?php echo $buku["peminjaman_id"]; ?></td>
                    <td><?php echo $buku["buku_id"]; ?></td>
                    <td><?php echo $buku["judul"]; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="kembalikan" value="1">
                            <input type="hidden" name="peminjaman_id" value="<?php echo $buku["peminjaman_id"]; ?>">
                            <input type="hidden" name="buku_id" value="<?php echo $buku["buku_id"]; ?>">
                            <input type="submit" value="Kembalikan">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <a class="button" href='./fitur.php'>Kembali</a>
    </div>
</body>
</html>
