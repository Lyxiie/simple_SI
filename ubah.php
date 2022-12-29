<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require "functions.php";

$id = $_GET["id"];

$pst = query("SELECT * FROM post WHERE id = $id")[0];


if (isset($_POST["submit"])) {

if (ubah ($_POST) > 0 ) {
    echo "
        <script>
            alert('Data Berhasil Diubah');
            document.location.href = 'index.php';
        </script>
    ";
} else {
    echo "
        <script>
        alert('Data Gagal Diubah');
            document.location.href = 'index.php';
        </script>
    ";
    
}
}  
?>

<?php include "header.php";?>

    <h1>Edit Data Postingan</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $pst["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $pst["gambar"]; ?>">
        
  <div class="mb-3">
    <label for="gambar">Foto</label><br>
    <center> <img src="img/<?= $pst['gambar']; ?>" width="200" height="200"></center>
    <br>
    <input type="file" class="form-control" id="gambar" name="gambar">
  </div>
  <div class="mb-3">
    <label for="caption" class="form-label">Caption</label>
    <input type="text" class="form-control" id="caption" name="caption" required value="<?= $pst["caption"]; ?>">
  </div>
 <div class="mb-3">
    <label for="waktu" class="form-label">Waktu</label>
    <input type="datetime-local" class="form-control" id="waktu" name="waktu" value="<?= $pst["waktu"]; ?>">
</div>
  <button type="submit" class="btn btn-primary" name="submit">Edit Data</button>
</form>

<?php include "footer.php";?>



