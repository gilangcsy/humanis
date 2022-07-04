<?php
    include('../config/conn.php');

    $mhs_id = $_GET['id'];
    $sql = "SELECT * FROM rapat LEFT OUTER JOIN presensi_mhs ON rapat.rapat_id = presensi_mhs.rapat_id LEFT OUTER JOIN tbl_mhs ON presensi_mhs.mhs_id = tbl_mhs.mhs_id WHERE presensi_mhs.mhs_id = $mhs_id"; 
    $result = mysqli_query($conn, $sql);

    foreach ($result as $detail) {
        $nama_mhs = $detail['nama_mhs'];
    }

?>

<div class="col-12" style="margin-top: 120px">
    <h2>Rekapitulasi Presensi <?= $nama_mhs ?></h2>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>Judul Rapat</th>
                <th scope="col">Pertemuan</th>
                <th scope="col">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $detail) { ?>
            <tr>
                <td>#</td>
                <td><?= $detail["judul"]?></td>
                <td><?= $detail["rapat_ke"]?></td>
                <?php
                    if($detail["status"] == "Hadir") {
                        $color = "green";
                    } else if($detail["status"] == "Izin") {
                        $color = "Yellow";
                    } else {
                        $color = "red";
                    }
                ?>
                <td style="background-color: <?= $color ?>">
                    <?= $detail["status"]?>
                </td>
                <td>
                    <a href="index.php?page=edit&id=<?= $detail['presensi_id']; ?>">
                        Edit
                    </a>
                </td>
            </tr>
        <?php } 
        ?>
        </tbody>
    </table>
</div>