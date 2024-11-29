<?php
include "service/database.php";
session_start();

$register_message = "";

if (isset($_SESSION['is_login'])) {
    header("Location: dashboard.php");
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);

    try {
        $sql = "INSERT INTO users (username, password) VALUES('$username', '$hash_password')";
        if ($db->query($sql)) {
            $register_message = "Berhasil mendaftar, Silahkan Login";
        } else {
            $register_message = "Daftar gagal, coba lagi";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "Username sudah digunakan, ganti";
    }
    $db->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "layout/header.html" ?>

    <h3>DAFTAR AKUN</h3>
    <i><?php echo $register_message ?></i>
    <form action="register.php" method="post">
        <input type="text" placeholder="username" name="username">
        <input type="password" name="password" name="password">
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>

</html>