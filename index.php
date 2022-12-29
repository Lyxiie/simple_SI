<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
// pagination
// konfigurasi
$jumlahDataPerhalaman = 5;
$jumlahData = count(query("SELECT * FROM post"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamaAktif = (isset($_GET['halaman']) ) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerhalaman * $halamaAktif) - $jumlahDataPerhalaman;

if(isset($_GET['halaman'])) {
    $halamaAktif = $_GET['halaman'];
} else {
    $halamaAktif = 1;
}

$post = query("SELECT * FROM post LIMIT $awalData, $jumlahDataPerhalaman");

// $post = query("SELECT * FROM post");

if (isset($_POST["cari"])) {
    $post = cari($_POST["keyword"]);
}

?>

<?php include 'header.php'; ?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword" id="keyword">
        </form>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-outline-secondary" type="button" href="logout.php" class="logout">Logout</a>
    </div>
    </div>
  </div>
</nav>


    <h1>Daftar Postingan</h1>
<a href="tambah.php" class="btn btn-success">Tambah Data</a><br><br>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if($halamaAktif > 1) : ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $halamaAktif - 1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php endif; ?>
      <?php for ($i=1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamaAktif) : ?>
        <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
        <?php else : ?>
        <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endif; ?>
      <?php endfor; ?>
    <?php if($halamaAktif < $jumlahHalaman) : ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $halamaAktif + 1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <?php endif; ?>
  </ul>
</nav>




<div id="container">
    <table class="table table-striped table-hover">

    <tr>
       
        <th>ID</th>
        <th>Gambar</th>
        <th>Caption</th>
        <th>Waktu</th>
        <th>Aksi</th>
    </tr>
<?php $i=1; ?>
<?php foreach($post as $row) : ?>
    <?php $originalDate = $row["waktu"];
          $newDate = date("d/m/Y,h:i A", strtotime($originalDate)); 
    ?>
    <tr>
        <td><?= $i; ?></td>
        <td><img src="img/<?= $row["gambar"]; ?>" width="50" height="50"></td>
        <td><?= $row["caption"]; ?></td>
        <td><?= $newDate; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-primary">Ubah</a>
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" class="btn btn-danger">Hapus</a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>
</div>


<?php include 'footer.php'; ?>