<?php
function delete($i)
{
    $cookie_name = "cart";
    $cart = json_decode($_COOKIE[$cookie_name], true);
    array_splice($cart, $i, 1);
    setcookie($cookie_name, json_encode($cart));
}
?>