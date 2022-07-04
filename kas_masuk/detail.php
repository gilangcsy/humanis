<?php
    include('../config/conn.php');

    $mhs_id = $_GET['id'];
    
    $sql = "SELECT * FROM kas_masuk JOIN tbl_mhs ON kas_masuk.mhs_id = tbl_mhs.mhs_id WHERE tbl_mhs.mhs_id = $mhs_id ORDER BY created_at DESC"; 
    $result = mysqli_query($conn, $sql);

    foreach ($result as $detail) {
        $nama_mhs = $detail['nama_mhs'];
    }

?>

<div class="col-12" style="margin-top: 120px">
    <h2>Rekapitulasi Kas <?= $nama_mhs ?></h2>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>Bulan</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $detail) { ?>
            <tr>
                <td>#</td>
                <td>
                    <?= date("F", mktime(0, 0, 0, $detail["bulan_ke"], 10)); ?>    
                </td>
                <td>
                    <?= "Rp " . number_format($detail["jumlah_bayar"],0,',','.'); ?>    
                </td>
                <td>
                    <?= $detail["tanggal_pembayaran"]?>
                </td>
            </tr>
        <?php } 
        ?>
        </tbody>
    </table>
</div>