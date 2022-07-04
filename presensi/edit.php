<?php
    include('../config/conn.php');
    if(isset($_POST['Submit'])) {
        $presensi_id = $_POST['presensi_id'];
        $status = $_POST['status'];
        
        error_reporting(E_ERROR | E_PARSE);
        $sql = "UPDATE presensi_mhs SET status='$status' WHERE presensi_id = $presensi_id"; 
        $result = mysqli_query($conn, $sql);
        if($result) {    
            // Show message when user added
            echo "<script>
                alert('Data berhasil diubah');
                window.location.href='index.php';
                </script>";
        } else {
            echo "<script>
                alert('Data berhasil diubah');
                window.location.href='index.php';
                </script>";
        }
	} else {
        $presensi_id = $_GET['id'];
        $sql = "SELECT * FROM presensi_mhs WHERE presensi_id = $presensi_id LIMIT 1"; 
        $result = mysqli_query($conn, $sql);

        $sql = "SELECT mhs_id, nama_mhs FROM tbl_mhs ORDER BY nama_mhs ASC"; 
        $students = mysqli_query($conn, $sql);
        
        $sql = "SELECT rapat_id, judul, rapat_ke FROM rapat ORDER BY rapat_ke ASC"; 
        $meetings = mysqli_query($conn, $sql);
?>

<div class="col-12" style="margin-top: 120px">
    <?php
        foreach($result as $edit) {
            $presensi_id = $edit["presensi_id"];
            $mhs_id = $edit["mhs_id"];
            $rapat_id = $edit["rapat_id"];
            $status = $edit["status"];
        }
    ?>
    <h1>Edit Presensi</h1>
    <form action="edit.php" method="POST">
        <div class="form-group">
            <input type="hidden" name="presensi_id" value="<?= $presensi_id ?>">
            <label for="mhs_id">Nama Mahasiswa</label>
            <select name="mhs_id[]" class="js-example-basic-multiple form-control" id="mhs_id[]" multiple="multiple">
                <?php foreach($students as $student) { ?>
                    <option value="<?= $student['mhs_id']; ?>" <?= $student['mhs_id'] == $mhs_id ? 'selected' : '' ?> ><?= $student['nama_mhs']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="rapat_id">Kegiatan</label>
            <select name="rapat_id[]" class="js-example-basic-multiple form-control" id="rapat_id[]" multiple="multiple">
                <?php foreach($meetings as $meeting) { ?>
                    <option value="<?= $meeting['rapat_id']; ?>" <?= $meeting['rapat_id'] == $rapat_id ? 'selected' : '' ?> ><?= $meeting['judul']; ?> | Pertemuan ke - <?= $meeting['rapat_ke'] ?></option>
                <?php } ?>
            </select>
        </div>
        
        
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Hadir" <?= $status == 'Hadir' ? 'selected' : '' ?> >Hadir</option>
                <option value="Izin" <?= $status == 'Izin' ? 'selected' : '' ?>>Izin</option>
                <option value="Tidak Hadir" <?= $status == 'Tidak Hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
            </select>
        </div>

        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?php
    }
    mysqli_close($conn);
?>