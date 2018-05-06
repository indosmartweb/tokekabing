<?php
$host = "localhost"; // Nama hostnya
$user = "root"; // Username
$pass = "smartjiwo"; // Password (Isi jika menggunakan password)
$dbase = "toke";
$connect = mysqli_connect($host, $user, $pass, $dbase); // Koneksi ke MySQL
//<!--ere --> 
$host = 'localhost'; // Nama hostnya
$username = 'root'; // Username
$password = 'smartjiwo'; // Password (Isi jika menggunakan password)
$database = 'toke'; // Nama databasenya
$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
// Koneksi ke MySQL dengan PDO

?>

