<?php
//Investment ID Generator
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$randomString = '';

for ($i = 0; $i < 10; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
}

echo $randomString;