<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($koneksi,
        "SELECT * FROM admin 
         WHERE username='$user' AND password='$pass'"
    );

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $user;
        header("Location: menu.php");
    } else {
        echo "<script>
              alert('Login gagal!');
              window.location='login.php';
              </script>";
    }
}
