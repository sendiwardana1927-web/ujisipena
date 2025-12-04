<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {

    $nama = trim($_POST['nama']);
    $unit = trim($_POST['unit']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if ($password !== $confirm) {
        $error_message = "Konfirmasi password tidak cocok!";
    } else {

        // Cek username
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $error_message = "Username sudah digunakan!";
        } else {

            // INSERT tanpa hash
            $insert = mysqli_query($conn, 
                "INSERT INTO users (nama, unit, username, password, role) 
                 VALUES ('$nama','$unit','$username','$password','user')"
            );

            if ($insert) {
                header("Location: login.php?registered=1");
                exit;
            } else {
                $error_message = "Registrasi gagal! Coba lagi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun - SIPENA</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:'Poppins',sans-serif;
    min-height:100vh;
    display:flex;
}

.left-side{
    width:50%;
    background:url('img/bgkpknl.jpg') no-repeat center center;
    background-size:cover;
    position:relative;
}
.left-side::after{
    content:"";
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.3);
}

.right-side{
    width:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#F4E9D8;
}

.login-box{
    width:85%;
    max-width:420px;
    padding:45px 35px;
    background:#FFF8F0;
    border-radius:20px;
    box-shadow:0 10px 40px rgba(92,59,34,0.25);
    text-align:center;
    animation:fadeIn .8s ease;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(40px);} 
    to{opacity:1;transform:translateY(0);} 
}

h2{
    color:#5C3B22;
    font-size:34px;
    font-weight:700;
    margin-bottom:6px;
}

p{
    color:#8B6E54;
    margin-bottom:25px;
}

.error{
    background:#FCE4E4;
    color:#8E2D2D;
    border:1px solid #E6B1B1;
    padding:10px;
    border-radius:12px;
    margin-bottom:18px;
    font-size:13px;
}

.input-group{
    position:relative;
    margin-bottom:20px;
}

.input-group input{
    width:100%;
    padding:14px 45px;
    background:#F5ECE1;
    border:1px solid #D0B096;
    border-radius:15px;
    font-size:14px;
    color:#5C3B22;
    outline:none;
    transition:.3s;
}
.input-group input:focus{
    border-color:#A67850;
    box-shadow:0 0 8px rgba(166,120,80,0.4);
}

.input-group i{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    color:#A67850;
}

.left-icon{
    left:12px;
}

.toggle-password{
    right:12px;
    cursor:pointer;
}

.btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:15px;
    background:#C7A27B;
    color:#fff;
    font-size:15px;
    font-weight:600;
    margin-top:5px;
    cursor:pointer;
    transition:.3s;
}
.btn:hover{
    background:#A67850;
    transform:translateY(-2px);
}

.secondary-btn{
    background:#5C3B22;
}
.secondary-btn:hover{
    background:#3F2716;
}

footer{
    margin-top:18px;
    font-size:12px;
    color:#8B6E54;
}
</style>
</head>

<body>

<div class="left-side"></div>

<div class="right-side">
<div class="login-box">

<h2>DAFTAR AKUN</h2>
<p>Buat akun baru untuk mengakses SIPENA</p>

<?php if(isset($error_message)): ?>
<div class="error"><?= $error_message ?></div>
<?php endif; ?>

<form method="POST">
    <div class="input-group">
        <i class="fa fa-id-card left-icon"></i>
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
    </div>

    <div class="input-group">
        <i class="fa fa-building left-icon"></i>
        <select name="unit" required style="width:100%;padding:14px 45px;background:#F5ECE1;border:1px solid #D0B096;border-radius:15px;font-size:14px;color:#5C3B22;outline:none;appearance:none;">
            <option value="">-- Pilih Unit --</option>
            <option value="Subbagian Umum">Subbagian Umum</option>
            <option value="Seksi Pengelolaan Kekayaan Negara">Seksi Pengelolaan Kekayaan Negara</option>
            <option value="Seksi Pelayanan Penilaian">Seksi Pelayanan Penilaian</option>
            <option value="Seksi Lelang">Seksi Lelang</option>
            <option value="Seksi Piutang Negara">Seksi Piutang Negara</option>
            <option value="Seksi Hukum dan Informasi">Seksi Hukum dan Informasi</option>
            <option value="Seksi Kepatuhan Internal">Seksi Kepatuhan Internal</option>
        </select>
    </div>

    <div class="input-group">
        <i class="fa fa-user left-icon"></i>
        <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="input-group">
        <i class="fa fa-lock left-icon"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i class="fa fa-eye toggle-password" id="togglePassword1"></i>
    </div>

    <div class="input-group">
        <i class="fa fa-lock left-icon"></i>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" required>
        <i class="fa fa-eye toggle-password" id="togglePassword2"></i>
    </div>

    <button type="submit" name="register" class="btn">Daftar</button>
    <button type="button" onclick="window.location='login.php'" class="btn secondary-btn">Kembali ke Login</button>
</form>

<footer>© <?=date('Y')?> SIPENA</footer>

</div>
</div>

<script>
function togglePass(btn, field){
    btn.addEventListener("click", ()=>{
        field.type = field.type === "password" ? "text" : "password";
        btn.classList.toggle("fa-eye-slash");
    });
}

togglePass(document.getElementById("togglePassword1"), document.getElementById("password"));
togglePass(document.getElementById("togglePassword2"), document.getElementById("confirm_password"));
</script>

</body>
</html>
