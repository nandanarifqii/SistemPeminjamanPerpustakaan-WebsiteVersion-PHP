<?php
function add($idbuku, $judul)
{
    $cookie_name = "cart";
    $cart = json_decode($_COOKIE[$cookie_name], true);
    $buku[]=$idbuku;
    $buku[]=$judul;
    $cart[]=$buku;
    setcookie($cookie_name, json_encode($cart));
}
?>