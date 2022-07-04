<?php

    include('../config/conn.php');

    if( isset($_GET['id']) ){

        // ambil id dari query string
        $id = $_GET['id'];

        // buat query hapus
        $sql = "DELETE FROM presensi_mhs WHERE presensi_id=$id";
        $query = mysqli_query($conn, $sql);

        // apakah query hapus berhasil?
        if( $query ){
            echo "<script>
                alert('Data berhasil dihapus');
                window.location.href='index.php';
            </script>";
        } else {
            die("gagal menghapus...");
        }

    } else {
        die("akses dilarang...");
    }