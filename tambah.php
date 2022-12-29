<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}



require "functions.php";

if (isset($_POST["submit"])) {




if (tambah ($_POST) > 0 ) {
    echo "
        <script>
            alert('Data Berhasil Ditambahkan');
            document.location.href = 'index.php';
        </script>
    ";
} else {
    echo "
        <script>
        alert('Data Gagal Ditambahkan');
            document.location.href = 'index.php';
        </script>
    ";
    
}
}  
?>


<?php include "header.php";?>


    <center><h1 class="mt-5">Tambah Data Postingan</h1></center>
    <form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="gambar" class="form-label">Foto</label>
    <input type="file" class="form-control" id="gambar" name="gambar">
  </div>
  <div class="mb-3">
    <label for="caption" class="form-label">Caption</label>
    <input type="textarea" class="form-control" id="caption" name="caption">
  </div>
 <div class="mb-3">
    <label for="waktu" class="form-label">Waktu</label>
    <input type="datetime-local" class="form-control" id="waktu" name="waktu" placeholder="Select Date Time">
</div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>

<script>
    config = {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        altInput : true,
        altFormat : "F j, Y h:S K"
    }

    flatpickr("input[type=datetime-local",config);

    <?php include "footer.php";?>