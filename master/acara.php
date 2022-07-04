<?php

    $conn = mysqli_connect('localhost', 'root', '', 'humanis');

    $sql = "SELECT * FROM tbl_mhs"; 
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>O f f i c e s</title>
</head>
<body>
    <div class="table">
        <h1>Acara</h1>
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jabatan</th>
                <th>TTL</th>
                <th>Email</th>
            </tr>

            <?php foreach ($result as $tbl_mhs) { ?>

            <tr>
                <td><?= $tbl_mhs["nama_mhs"]?></td>
                <td><?= $tbl_mhs["nim_mhs"]?></td>
                <td><?= $tbl_mhs["jabatan_id"]?></td>
                <td><?= $tbl_mhs["ttl_mhs"]?></td>
                <td><?= $tbl_mhs["email_mhs"]?></td>
            </tr>
            <?php } ?>
        </table>

        <div class="back">
            <p><a href="index.php">back</a></p>
        </div>
    </div>
    
</body>
</html>
