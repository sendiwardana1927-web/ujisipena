<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peraturan & SOP - SIPENA</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #F3EFE6;
    }

    /* Navbar */
    .navbar {
      background: #7B553E;
      box-shadow: 0 3px 10px rgba(0,0,0,0.18);
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
      font-weight: 600;
    }
    .nav-link:hover { color: #F4E7D3 !important; }

    /* Hero */
    .hero {
      background: url('img/bgkpknl.jpg') center/cover no-repeat;
      padding: 120px 0 80px;
      text-align: center;
      color: white;
      position: relative;
    }
    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(80, 53, 36, 0.55);
    }
    .hero h1, .hero p {
      position: relative;
      z-index: 2;
    }
    .hero h1 {
      font-size: 2.6rem;
      font-weight: 700;
      color: #F6EDE3;
    }
    .hero p {
      color: #FFEED7;
    }

    /* Search Box */
    .search-box {
      max-width: 420px;
      margin: 0 auto 35px !important;
      display: flex;
      justify-content: center;
    }
    .search-box input {
      width: 100%;
      border-radius: 30px;
      border: none;
      background: white;
      padding: 12px 25px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.10);
      text-align: center;
    }

    /* SOP Card */
    .sop-list {
      background: #FFF8EF;
      border-radius: 14px;
      padding: 18px 22px;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 20px;
      box-shadow: 0 5px 14px rgba(0,0,0,0.10);
      transition: all .3s ease;
      border-left: 5px solid #7B553E;
    }
    .sop-list:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 24px rgba(0,0,0,0.18);
      border-left-width: 8px;
    }
    .sop-list i {
      font-size: 2.3rem;
      color: #7B553E;
    }
    .sop-info h5 {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 4px;
      color: #7B553E;
    }
    .sop-info p {
      color: #5a4b42;
    }

    /* Button */
    .btn-sop {
      background: #7B553E;
      border: none;
      color: #fff;
      padding: 8px 18px;
      border-radius: 8px;
      font-size: 0.85rem;
      transition: .3s;
    }
    .btn-sop:hover { background: #5E3F2E; }

    #noResult {
      display: none;
      color: #777;
      text-align: center;
      padding-top: 15px;
    }

    /* Footer */
    footer {
      background: #7B553E;
      padding: 18px 0;
      color: white;
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">SIPENA</a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <i class="fa fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link active" href="sop.php">Peraturan & SOP</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<section class="hero mt-5">
  <div class="container position-relative">
    <h1>Peraturan & Standar Operasional Prosedur</h1>
    <p>Kumpulan dokumen resmi pengelolaan arsip di KPKNL Surabaya</p>
  </div>
</section>

<!-- Content -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color:#7B553E;">Daftar Dokumen</h2>

    <!-- Search -->
    <div class="search-box mb-4">
        <input type="text" id="searchInput" placeholder="🔍 Cari dokumen...">
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10" id="sopContainer">

        <?php
        $dokumen = [
          ["UU No. 43 Tahun 2009", "Tentang Kearsipan di Indonesia.", "https://drive.google.com/file/d/1sLRaipGKG1SaQAOd3fQupkzDZ_weZ9sK/view"],
          ["JRA Substantif", "Jadwal retensi arsip substansi utama instansi.", "https://drive.google.com/file/d/1OesB-4NNEbwoGonowxFXWK-leKvFkkbf/view?usp=drivesdk/view"],
          ["JRA Fasilitatif", "Jadwal retensi arsip bidang penunjang administrasi.", "https://drive.google.com/file/d/1gOJy_VEFyzavfH2c-XkCREILUY32MD61/view"],
          ["Arsip Elektronik & Alih Media", "Pedoman digitalisasi arsip dan alih media.", "https://drive.google.com/file/d/1z1R5CHy8IZYRoFNInoeLFpXUzSmHNQzn/view?usp=drivesdk/view"],
          ["Klasifikasi Arsip & Hak Akses", "Struktur klasifikasi arsip dan aturan hak akses.", "https://drive.google.com/file/d/1M5H5j7jJmywAwbiQlzpJFj3XB1ceyE-i/view"],
          ["Tata Naskah Dinas", "Pengaturan tata cara pembuatan dan penyimpanan naskah dinas.", "https://drive.google.com/file/d/1x0CJHNu9PjLTDveP1vLt0A3vYlCVwKW7/view"],
          ["Pengelolaan Arsip Dinamis", "Pedoman pengelolaan arsip aktif dan inaktif.", "https://drive.google.com/file/d/1KCepfFwVD1DYJG8TuIJAmYbfYrd5LFEc/view"],
          ["Pengelolaan Arsip Inaktif", "Prosedur penataan arsip inaktif.", "https://drive.google.com/file/d/1UxXj4OMT1JSZC7bQN9svaZAgfVOKvpkD/view"],
          ["Penyusutan Arsip", "Ketentuan pemindahan dan pemusnahan arsip.", "https://drive.google.com/file/d/1_lz7BoiA794jUFTXt5OiTOAkAkCLYHk6/view"],
          ["Organisasi Kearsipan Kemenkeu", "Struktur organisasi unit kearsipan.", "https://drive.google.com/file/d/1c_5MyxS4vRqqgfVINrmhNy_K515-D5cU/view"],
          ["Pengawasan Internal", "Pedoman pengawasan kegiatan kearsipan.", "https://drive.google.com/file/d/1bPVhITl1Xdm6lI7eVzRIe8xi47AHiB11/view"],
          ["Risalah Lelang", "Dokumen risalah lelang dan prosedurnya.", "https://drive.google.com/file/d/1meDBE8rkPn9I06k_JvnD3qTJM1_npCQW/view"],
          ["SE Pelaporan Arsip Inaktif", "Surat edaran pelaporan arsip inaktif.", "https://drive.google.com/file/d/1wXcvFO6UjF09aFkQcITDUvwxLjKJ6jdA/view"],
          ["Standar Kualitas Arsiparis", "Kriteria kompetensi dan standar kerja arsiparis.", "https://drive.google.com/file/d/1WHxQCTw6GK0ebO9b3z4Rn2XXQOtN5sRJ/view"]
        ];

        $no = 1;
        foreach ($dokumen as $d) {
          echo '
          <div class="sop-list" data-title="'.$d[0].'" data-desc="'.$d[1].'">
            <i class="fa fa-file-pdf"></i>

            <div class="sop-info flex-grow-1">
              <h5>'.$no.'. '.$d[0].'</h5>
              <p>'.$d[1].'</p>
            </div>

            <a href="'.$d[2].'" target="_blank" class="btn btn-sop">Lihat</a>
          </div>';
          $no++;
        }
        ?>

        <p id="noResult">Tidak ditemukan dokumen.</p>

      </div>
    </div>
  </div>
</section>

<footer>
  <p>© 2025 SIPENA - Unit Kearsipan III KPKNL Surabaya | DJKN</p>
</footer>

<script>
  const searchInput = document.getElementById('searchInput');
  const sopItems = document.querySelectorAll('.sop-list');
  const noResult = document.getElementById('noResult');

  searchInput.addEventListener('keyup', function() {
    const keyword = this.value.toLowerCase();
    let found = false;

    sopItems.forEach(item => {
      const title = item.dataset.title.toLowerCase();
      const desc = item.dataset.desc.toLowerCase();
      const match = title.includes(keyword) || desc.includes(keyword);

      item.style.display = match ? "flex" : "none";
      if (match) found = true;
    });

    noResult.style.display = found ? "none" : "block";
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
