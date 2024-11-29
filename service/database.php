<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "buku_tamu";
$db = mysqli_connect($hostname, $username, $password, $database);

if ($db->connect_error) {
    echo "Koneksi databae rusak";
    die("error!");
}
?>

<?php ?>