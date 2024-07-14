<?php
function save()
{
    $cookie_name = "cart";
    if (isset($_COOKIE[$cookie_name])) {
        $cart = json_decode($_COOKIE[$cookie_name], true);
        $link = new mysqli("localhost:3307", "root", "", "perpustakaan");
        
        if (!$link) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
        
        $query = "insert into peminjaman values(null,current_timestamp())";            
        $result = $link->query($query);
        $id = $link->insert_id;
        
        foreach ($cart as $row) {
            $idbuku = $row[0];
            $query = "insert into dipinjam(peminjaman_id, buku_id, hari) values($id,$idbuku,1)";
            $result = $link->query($query);
        }
        
        // Hapus cookie keranjang
        setcookie($cookie_name, "", time() - 3600); // Set waktu kadaluarsa ke masa lalu
        
        $link->close();  
    }
}

?>
