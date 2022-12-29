<?php
use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="print.css">
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>';

    foreach($mahasiswa as $row) {
        $html .= '<tr>
            <td>'.$i++.'</td>
            <td><img src="img/'.$row["gambar"].'" width="50px"></td>
            <td>'.$row["nrp"].'</td>
            <td>'.$row["nama"].'</td>
            <td>'.$row["email"].'</td>
            <td>'.$row["jurusan"].'</td>
        </tr>';
    }
    
$htnl.= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa','I');
?>