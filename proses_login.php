<?php
session_start();
include 'config.php'; // file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cegah SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Cek user (asumsi password belum di-hash, jika sudah hash pakai password_verify)
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Set session (sesuai nama kolom di DB)
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect sesuai role
        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
            exit;
        } elseif ($user['role'] == 'user') {
            header("Location: user/dashboard_user.php");
            exit;
        } else {
            header("Location: login.php?error=Role%20tidak%20dikenali");
            exit;
        }
    } else {
        header("Location: login.php?error=Username%20atau%20password%20salah");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
