

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>O f f i c e s</title>

    <?php
        include('../config/css_library.php')
    ?>
</head>
<body style="background-color: #B8D1EA">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="top-bar">
                    <div class="judul">
                        <h2>HMJ SISTEM INFORMASI</h2>
                    </div>
                    <div id="menu">
                        <nav>
                            <ul>
                                <li><a href=''>Home</a></li>
                                <ul>
                                    <li><a href="BAGAN">Bagan Anggota</a></li>
                                </ul>                    
                                <li><a href=''>Acara</a>
                                <ul>
                                    <li><a href="pages/acara.php">Soon</a></li>
                                    <li><a href="Past">Past</a></li>
                                </ul>
                                <li><a href=''>Kas</a></li>
                                <li><a href='index.php'>Presensi</a></li>
                                <li><a href="" class="tbl-biru">Sign Up</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <?php
            if(!empty($_GET['page']) && $_GET['page'] == 'detail') {
                include('detail.php');
            } else if(!empty($_GET['page']) && $_GET['page'] == 'edit') {
                include('edit.php');
            } else if(!empty($_GET['page']) && $_GET['page'] == 'create') {
                include('create.php');
            } else {
                include('read.php');
            }
        ?>
        </div>
    </div>

    <?php
        include('../config/js_library.php')
    ?>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        var column = this;
                        var select = $('<select class="form form-control"><option value="">-Select-</option></select>')
                            .appendTo($(column.header()))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
                },
            });
        });

        
        $('.js-example-basic-multiple').select2();
    </script>
</body>
</html>
