<?php
    include('../config/conn.php');

    if(isset($_POST['Submit'])) {
        $mhs_id = $_POST['mhs_id'];
        $bulan_ke = $_POST['bulan_ke'];
        $jumlah_bayar = $_POST['jumlah_bayar'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        
        error_reporting(E_ERROR | E_PARSE);
        for($i = 0; $i < count($mhs_id); $i++) {
            for($j = 0; $j < count($bulan_ke); $j++) {
                $sql = "INSERT INTO kas_masuk(mhs_id, bulan_ke, jumlah_bayar, tanggal_pembayaran) VALUES('$mhs_id[$i]','$bulan_ke[$j]','$jumlah_bayar', '$tanggal_pembayaran')"; 
                $result = mysqli_query($conn, $sql);
                if($result) {    
                    // Show message when user added
                    echo "<script>
                        alert('Data berhasil ditambahkan');
                        window.location.href='index.php';
                        </script>";
                } else {
                    echo "<script>
                        alert('Data gagal ditambahkan');
                        window.location.href='index.php';
                        </script>";
                }
            }
        }
	} else {

        $sql = "SELECT mhs_id, nama_mhs FROM tbl_mhs ORDER BY nama_mhs ASC"; 
        $students = mysqli_query($conn, $sql);
?>

<div class="col-12" style="margin-top: 120px">
    <h2>Tambah Data Kas</h2>

    <form action="create.php" method="POST">
        <div class="form-group">
            <label for="mhs_id">Nama Mahasiswa</label>
            <select name="mhs_id[]" class="js-example-basic-multiple form-control" id="mhs_id[]" multiple="multiple">
                <?php foreach($students as $student) { ?>
                    <option value="<?= $student['mhs_id']; ?>"><?= $student['nama_mhs']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="bulan_ke">Bulan</label>
            <select name="bulan_ke[]" class="js-example-basic-multiple form-control" id="bulan_ke[]" multiple="multiple">
                
                <?php for($i = 1; $i <= 12; $i++) { ?>
                    <option value="<?= $i; ?>">
                        <?= date("F", mktime(0, 0, 0, $i, 10)); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="jumlah_bayar">Jumlah Bayar</label>
            <input type="number" value="5000" name="jumlah_bayar" class="form-control">
        </div>

        <div class="form-group">
            <label for="tanggal_pembayaran">Tanggal Bayar</label>
            <input type="date" name="tanggal_pembayaran" class="form-control">
        </div>

        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
    </form>
    
</div>

<?php
    }
    mysqli_close($conn);
?>