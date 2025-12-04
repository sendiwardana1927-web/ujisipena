<?php
session_start();

// Jika sudah login, arahkan ke dashboard sesuai role
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){
        header("Location: admin/dashboard.php");
        exit;
    } elseif($_SESSION['role'] == 'user'){
        header("Location: user/dashboard_user.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIPENA - Sistem Arsip Digital</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
/* === GLOBAL === */
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Poppins', sans-serif; background:#F3EFE6; }

/* === NAVBAR === */
.navbar {
    background-color:#7B553E;
    transition:0.3s;
}
.navbar.sticky {
    background-color:#5E3F2E !important;
    box-shadow:0 3px 10px rgba(0,0,0,0.25);
}
.navbar-brand, .nav-link {
    color:#fff !important;
    font-weight:600;
}
.nav-link:hover {
    color:#F4E7D3 !important;
}

/* === HERO === */
.hero {
    background:url('img/bgkpknl.jpg') center/cover no-repeat;
    padding:140px 15px;
    text-align:center;
    color:#fff;
    position:relative;
}
.hero::after {
    content:"";
    position:absolute;
    inset:0;
    background:rgba(80,53,36,0.55); /* coklat gelap transparan */
}
.hero .container { position:relative; z-index:2; }
.hero h1 {
    font-size:3rem;
    font-weight:700;
    color:#F6EDE3;
}
.hero h5 {
    color:#FFEED7;
    margin-bottom:30px;
}
.hero .btn {
    padding:10px 28px;
    font-weight:600;
    border-radius:50px;
    margin:0 10px;
}
.btn-primary {
    background:#7B553E;
    border:none;
}
.btn-primary:hover { background:#5E3F2E; }
.btn-outline-light:hover {
    background:#F6EDE3;
    color:#5E3F2E !important;
}

/* === CONTENT SECTION === */
.content {
    padding:80px 15px;
    text-align:center;
}
.content h2 {
    color:#7B553E;
    font-weight:700;
    margin-bottom:30px;
}
.content p {
    color:#5a4b42;
    max-width:800px;
    margin:auto;
}

.content .card {
    border:none;
    border-radius:15px;
    background:#FFF8EF;
    transition:0.3s;
    box-shadow:0 5px 16px rgba(0,0,0,0.08);
}
.content .card:hover {
    transform:translateY(-6px);
    box-shadow:0 12px 25px rgba(0,0,0,0.18);
}
.content i {
    padding:18px;
    border-radius:50%;
    color:#fff;
    background:linear-gradient(135deg, #7B553E, #C7A27A);
}

/* === GALLERY === */
.gallery {
    padding:80px 15px;
    text-align:center;
    background:#fff;
}
.gallery h2 {
    color:#7B553E;
    font-weight:700;
}
.gallery p {
    color:#6a5c53;
}

.gallery .card {
    border:none;
    border-radius:15px;
    overflow:hidden;
    background:#FFF8EF;
    transition:0.4s;
}
.gallery .card:hover {
    transform:scale(1.05);
    box-shadow:0 15px 25px rgba(0,0,0,0.2);
}
.gallery img {
    width:100%;
    height:250px;
    object-fit:cover;
}
.gallery .card-body {
    background:#F7F1E7;
    padding:15px;
}
.gallery h5 {
    color:#7B553E;
    font-weight:600;
}
.gallery p {
    color:#7b6b63;
}

/* === FOOTER === */
footer {
    background:#7B553E;
    text-align:center;
    padding:20px 0;
    color:#fff;
}
footer a {
    color:#F4E7D3;
    margin:0 8px;
}
footer a:hover { color:#fff; }

/* === RESPONSIVE === */
@media(max-width:768px){
    .hero h1 { font-size:2rem; }
    .hero h5 { font-size:1rem; }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">SIPENA</a>
    <button class="navbar-toggler text-white" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <i class="fa fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="sop.php">Peraturan & SOP</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero" data-aos="fade-down">
  <div class="container">
    <h1>SIPENA - KPKNL</h1>
    <h5>Sistem Pengelolaan Arsip Digital KPKNL Surabaya</h5>
    <a href="login.php" class="btn btn-primary" data-aos="fade-up" data-aos-delay="200">Masuk</a>
    <a href="sop.php" class="btn btn-outline-light" data-aos="fade-up" data-aos-delay="300">Peraturan & SOP</a>
  </div>
</section>

<!-- CONTENT -->
<section class="content">
  <div class="container">
    <h2 data-aos="fade-up">Tentang SIPENA</h2>
    <p data-aos="fade-up" data-aos-delay="100">
      SIPENA (Sistem Pengelolaan Arsip Digital) membantu pengelolaan, penyimpanan, dan akses arsip elektronik secara efisien dan modern.
    </p>

    <div class="row mt-5">
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="fa fa-file-alt fa-3x mb-3"></i>
            <h5>Manajemen Arsip</h5>
            <p>Kelola arsip aktif, inaktif, dan vital secara digital serta aman.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="fa fa-chart-bar fa-3x mb-3"></i>
            <h5>Laporan & Statistik</h5>
            <p>Pantau perkembangan arsip melalui grafik dan laporan dinamis.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
        <div class="card h-100">
          <div class="card-body text-center">
            <i class="fa fa-users fa-3x mb-3"></i>
            <h5>Kolaborasi User & Admin</h5>
            <p>Kolaborasi efektif dalam peminjaman dan pengembalian arsip.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section class="gallery">
  <div class="container">
    <h2 data-aos="fade-up">Galeri Ruang Arsip KPKNL Surabaya</h2>
    <p data-aos="fade-up" data-aos-delay="100">Dokumentasi ruang arsip, kegiatan, dan suasana kerja.</p>

    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card">
          <img src="img/bgkpknl.jpg" alt="Ruang Arsip">
          <div class="card-body">
            <h5>Ruang Arsip Utama</h5>
            <p>Penyimpanan arsip aktif & vital dengan sistem manajemen modern.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card">
          <img src="img/galeri2.png" alt="Digitalisasi Arsip">
          <div class="card-body">
            <h5>Proses Digitalisasi</h5>
            <p>Peningkatan efektivitas melalui digitalisasi arsip.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
        <div class="card">
          <img src="img/galeri3.jpeg" alt="Arsip Inaktif">
          <div class="card-body">
            <h5>Area Arsip Inaktif</h5>
            <p>Penyimpanan arsip sesuai jadwal retensi.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <p>© <?=date('Y')?> SIPENA - KPKNL Surabaya | Direktorat Jenderal Kekayaan Negara</p>
  <div>
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ duration:800, once:true });

window.addEventListener('scroll', () => {
    document.querySelector('.navbar')
        .classList.toggle('sticky', window.scrollY > 50);
});
</script>

</body>
</html>
