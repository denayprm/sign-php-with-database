<?php
include "service/database.php";
session_start();

$login_message = "";

if (isset($_SESSION['is_login'])) {
    header("Location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash_password'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_login'] = true;
        header("Location: dashboard.php");
    } else {
        $login_message = "Akun tidak ditemukan";
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

    <h3>MASUK AKUN</h3>
    <i><?php echo $login_message ?></i>
    <form action="login.php" method="post">
        <input type="text" placeholder="username" name="username">
        <input type="password" name="password" name="password">
        <button type="submit" name="login">Masuk Sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>

</html>