<?php
    include('../config/conn.php');

    if(isset($_POST['Submit'])) {
        $mhs_id = $_POST['mhs_id'];
        $rapat_id = $_POST['rapat_id'];
        $status = $_POST['status'];
        
        error_reporting(E_ERROR | E_PARSE);
        for($i = 0; $i < count($mhs_id); $i++) {
            for($j = 0; $j < count($rapat_id); $j++) {
                $sql = "INSERT INTO presensi_mhs(mhs_id, rapat_id, status) VALUES('$mhs_id[$i]','$rapat_id[$j]','$status')"; 
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
                        location.reload();
                        </script>";
                }
            }
        }
	} else {

        $sql = "SELECT mhs_id, nama_mhs FROM tbl_mhs ORDER BY nama_mhs ASC"; 
        $students = mysqli_query($conn, $sql);
        
        $sql = "SELECT rapat_id, judul, rapat_ke FROM rapat ORDER BY rapat_ke ASC"; 
        $meetings = mysqli_query($conn, $sql);
?>

<div class="col-12" style="margin-top: 120px">
    <h2>Tambah Data Presensi</h2>

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
            <label for="rapat_id">Kegiatan</label>
            <select name="rapat_id[]" class="js-example-basic-multiple form-control" id="rapat_id[]" multiple="multiple">
                <?php foreach($meetings as $meeting) { ?>
                    <option value="<?= $meeting['rapat_id']; ?>"><?= $meeting['judul']; ?> | Pertemuan ke - <?= $meeting['rapat_ke'] ?></option>
                <?php } ?>
            </select>
        </div>
        
        
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
            </select>
        </div>

        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
    </form>
    
</div>

<?php
    }
    mysqli_close($conn);
?>