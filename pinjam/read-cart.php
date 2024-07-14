<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <style>
        /* Gaya untuk pesan "Cart kosong" */
        .cart-empty {
            text-align: center;
            font-size: 20px;
        }

        .empty-message {
            font-size: 24px;
            color: #FF5733; /* Warna teks merah */
        }

        /* Gaya untuk tabel keranjang */
        .cart-not-empty {
            text-align: center;
        }

        .cart-table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%; /* Lebar tabel */
        }

        .cart-table th,
        .cart-table td {
            border: 1px solid #ddd; /* Garis batas sel */
            padding: 8px;
            text-align: center;
        }

        .cart-table th {
            background-color: #f2f2f2; /* Warna latar belakang header tabel */
        }

        /* Gaya untuk tombol */
        .button {
            background-color: #007bff; /* Warna latar belakang hijau */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }

        .button.delete-button {
            background-color: #FF5733; /* Warna latar belakang merah untuk tombol Hapus */
        }

        .button.save-button {
            background-color: #007BFF; /* Warna latar belakang biru untuk tombol Simpan */
        }
    </style>
</head>
<body>

<?php
function read()
{
    $cookie_name = "cart";

    if (!isset($_COOKIE[$cookie_name])) {
        echo "<div class='cart-empty'>";
        echo "<p class='empty-message'>Cart kosong</p>";
        echo "<br>";
        echo "<a href='../fitur.php' class='button'>CARI</a>";
        echo "<a href='../pengembalian.php' class='button'>List Peminjaman</a>";
        echo "</div>";
    } else {
        $cart = json_decode($_COOKIE[$cookie_name], true);

        if (isset($_GET['fitur']) && $_GET['fitur'] == 'delete' && isset($_GET['idbuku'])) {
            // Proses penghapusan item dari keranjang di sini
            $idbuku = $_GET['idbuku'];

            if (array_key_exists($idbuku, $cart)) {
                unset($cart[$idbuku]);
                // Perbarui cookie setelah penghapusan
                setcookie($cookie_name, json_encode($cart), time() + 3600, "/");
            }
        }

        if (empty($cart)) {
            echo "<div class='cart-empty'>";
            echo "<p class='empty-message'>Cart kosong</p>";
            echo "<br>";
            echo "<a href='../fitur.php' class='button'>CARI</a>";
            echo "<a href='../pengembalian.php' class='button'>List Peminjaman</a>";
            echo "</div>";
        } else {
            echo "<div class='cart-not-empty'>";
            echo "<table class='cart-table'>";
            echo "<tr><th>No</th><th>ID</th><th>Judul</th><th></th></tr>";
            $i = 1;
            foreach ($cart as $row) {
                echo "<tr><td>$i</td><td>$row[0]</td><td>$row[1]</td><td><a href='./pinjam.php?fitur=delete&idbuku=" . ($i-1) . "' class='button delete-button'>Hapus</a></td></tr>";
                $i++;
            }
            echo "</table>";
            echo "<br>";
            echo "<a href='../fitur.php' class='button'>Cari</a>";
            echo "<a href='pinjam.php?fitur=save' class='button save-button'>Simpan</a>";
            echo "</div>";
        }
    }
}
?>

</body>
</html>
