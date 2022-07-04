<?php
    include('../config/conn.php');

    $sql = "SELECT * FROM kas_masuk JOIN tbl_mhs ON kas_masuk.mhs_id = tbl_mhs.mhs_id ORDER BY created_at DESC"; 
    $results = mysqli_query($conn, $sql);
?>

<div class="col-12" style="margin-top: 120px">
    <div class="row">
        <div class="col-12">
            <a href="index.php?page=create" class="btn btn-primary">Tambah Kas</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Jumlah Bayar</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td>#</td>
                        <td>
                            <?= $result["nama_mhs"]?>
                        </td>
                        <td>
                        <?= date("F", mktime(0, 0, 0, $result["bulan_ke"], 10)); ?>   
                        </td>
                        <td>
                            <?= "Rp " . number_format($result["jumlah_bayar"],0,',','.'); ?>
                        </td>
                        <td>
                            <?= $result["tanggal_pembayaran"] ?>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="index.php?page=edit&id=<?= $result['kas_masuk_id']; ?>">
                                    Edit
                                </a>
                                <a href="delete.php?id=<?= $result['kas_masuk_id'] ?>">
                                    Delete
                                </a>
                                <a href="index.php?page=detail&id=<?= $result['mhs_id']; ?>">
                                    Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>