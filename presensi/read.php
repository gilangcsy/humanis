<?php
    include('../config/conn.php');

    $sql = "SELECT * FROM rapat JOIN presensi_mhs ON rapat.rapat_id = presensi_mhs.rapat_id JOIN tbl_mhs ON presensi_mhs.mhs_id = tbl_mhs.mhs_id ORDER BY presensi_mhs.created_at DESC"; 
    $results = mysqli_query($conn, $sql);
?>

<div class="col-12" style="margin-top: 120px">
    <div class="row">
        <div class="col-12">
            <a href="index.php?page=create" class="btn btn-primary">Tambah Presensi</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Pertemuan Ke</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td>#</td>
                        <td>
                            <a href="index.php?page=detail&id=<?= $result['mhs_id']; ?>">
                                <?= $result["nama_mhs"]?>
                            </a>
                        </td>
                        <td>
                            <?= $result["judul"] ?>
                        </td>
                        <td>
                            <?= $result["rapat_ke"] ?>
                        </td>
                        <td>
                            <?= $result["status"] ?>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="index.php?page=edit&id=<?= $result['presensi_id']; ?>">
                                    Edit
                                </a>
                                <a href="delete.php?id=<?= $result['presensi_id'] ?>">
                                    Delete
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