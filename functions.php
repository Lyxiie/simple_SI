<?php 
$conn = mysqli_connect("localhost", "root", "", "db_autopost");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah ($data) {
    global $conn;
    $caption = htmlspecialchars($data["caption"]);
    $waktu = $data["waktu"];

    //upload gambar

    $gambar = upload();
    if (!$gambar) {
        return FALSE;
    }


    $query= "INSERT INTO post VALUES ('', '$gambar', '$caption', '$waktu')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    //Caek apakah gambar di upload
    if ($error === 4) {
        echo"<script>
                alert('Pilih gambar dahulu!');
            </script>";
        return false;
    }

    //cek apakah yg di upload adalah gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo"<script>
                alert('Yang anda upload bukan gambar!');
            </script>";
    return false;
    }

    //cek ukuran gambar
    // if ($ukuranFile > 1000000) {
    //     echo"<script>
    //             alert('Ukuran gambar terlalu besar!');
    //         </script>";
        
        
    // return false;       
    // }

    //lolos

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;


}

function hapus ($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM post WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah ($data) {
    global $conn;
    $id = $data["id"];
    $caption = htmlspecialchars($data["caption"]);
    $gambarLama = htmlspecialchars ($data["gambarLama"]);
    $waktu = $data["waktu"];

    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }

    $query= "UPDATE post SET
                gambar = '$gambar', caption = '$caption', waktu = '$waktu' WHERE id = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari ($keyword) {
    $query = "SELECT * FROM post WHERE caption LIKE '%$keyword%'";

    return query($query);
}

function registrasi ($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo"<script>
                    alert('Username telah terdaftar!');
                </script>";
        return false;
        }

    //cek konfirmasi password

    if ($password !== $password2) {
        echo"<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
    return false;
    }

    //enkripsi
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);

}















?>