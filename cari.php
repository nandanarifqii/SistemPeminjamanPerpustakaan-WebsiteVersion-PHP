<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 800px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Gaya tombol */
        button.button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
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
        <h1>Pencarian Buku</h1>
        <form method="get">
            <input type="text" name="keyword" placeholder="Masukkan kata kunci" />
            <input type="submit" value="CARI" />
        </form>

        <?php
        function cari($keyword)
        {
            $listbuku = []; //Inisialisasi array kosong untuk case Buku tidak ditemukan
            $link = mysqli_connect(
                "127.0.0.1:3307", "root", "", "perpustakaan");
                $query =
                "SELECT id, judul FROM buku WHERE judul LIKE '%$keyword%'";
                $result = mysqli_query( $link, $query );
                while ( $row = mysqli_fetch_array( $result ) ) {
                $listbuku[] = $row;
                }
                mysqli_close( $link );
                return $listbuku;
        }
        function display($listbuku)
        {
            if (!empty($listbuku)) {
                echo "<br><table border=1 style='width:50%'>";
                echo "<tr><th style='width:10%'>ID</th><th style='width:60%'> Judul </th><th></th></tr>";
                foreach ($listbuku as $row) {
                    echo "<tr><td style='text-align: center;'>$row[0]</td><td> $row[1] </td><td style='text-align: center;'><button class='button' onclick=\"location.href='./pinjam/pinjam.php?fitur=add&idbuku=$row[0]&judul=$row[1]'\">Pinjam</button></td></tr>";
                }
                echo "</table>";
            } else {
                echo "Buku tidak ditemukan.";
                echo "<br>";
            }
        }
        ?>

        <a class="button" href='./pinjam/pinjam.php?fitur=read'>Lihat Keranjang</a>
        <a class="button" href='./pengembalian.php'>List Peminjaman Buku</a>
    </div>
</body>
</html>
