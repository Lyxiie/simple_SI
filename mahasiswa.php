<?php
sleep(1); 
require 'functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM post WHERE caption LIKE '%$keyword%'";
$post = query($query);
?>

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