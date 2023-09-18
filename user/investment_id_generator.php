<?php
//Investment ID Generator
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$randomString = '';

for ($i = 0; $i < 16; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
}

//echo $randomString;