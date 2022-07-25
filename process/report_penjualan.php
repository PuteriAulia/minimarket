<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Minimarket - Report Penjualan</title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="OneUI">
        <meta property="og:description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="../assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="../assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="../assets/css/oneui.min.css">

        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            <?php include'../template/sidebar.php'; ?>

            <?php include'../template/header.php'; ?>

            <!-- Main Container -->
            <main id="main-container">

                <!-- Hero -->
                <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill h3 my-2">
                                Report Penjualan 
                            </h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-alt">
                                    <li class="breadcrumb-item">Report</li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="link-fx" href="">Report Penjualan</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content">
                    <!-- Start export -->
                    <button class="btn btn-success mb-4" id="exportExcel" onclick="ExportToExcel('xlsx')">Export xls</button>
                    <!-- End export -->

                    <div class="row">
                        <div class="col-9 col-md-9 col-lg-9 col-xl-9">
                            <!-- Start rentang tanggal -->
                            <div class="card">
                                <div class="card-body">
                                    <!-- Start Input bulan -->
                                    <form action="" method="GET">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-5 col-md-5 col-lg-5 col-xl-5">
                                                    <b>Tanggal awal</b><input type="date" class="form-control form-control-alt mt-2" name="tanggalAwal">
                                                </div>

                                                <div class="col-5 col-md-5 col-lg-5 col-xl-5">
                                                    <b>Tanggal akhir</b><input type="date" class="form-control form-control-alt mt-2" name="tanggalAkhir">
                                                </div>
                                                    

                                                <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                                                    <p></p><button type="submit" class="btn btn-primary" name="inputTanggal">
                                                        Cari
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Input bulan -->
                                </div>
                            </div>
                            <!-- End rentang tanggal -->
                        </div>

                        <!-- Start total pendapatan -->
                        <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                            <?php
                            include '../config/config.php';
                            $pendapatan = 0;
                            $queryTransaksi = mysqli_query($dbconnect,"SELECT * FROM transaksi_detail");
                            while ($dataTransaksi = mysqli_fetch_array($queryTransaksi)) {
                                $subtotal = $dataTransaksi['transaksi_detail_subtotal'];
                                $pendapatan = $pendapatan + $subtotal;
                            }
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    Total pendapatan <h3 class="mt-3"><?= $pendapatan; ?></h3>
                                </div>
                            </div>
                        </div>
                        <!-- end total pendapatan -->
                    </div>

                    <!-- Start tabel -->
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <!-- Hover Table -->
                            <div class="block block-rounded">
                                <div class="block-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-vcenter" id="reportTransaksi">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="text-center" style="width: 5%;">No</th>
                                                    <th class="text-center" style="width: 10%;">Kode Transaksi</th>
                                                    <th class="text-center" style="width: 10%;">Tanggal</th>
                                                    <th class="text-center" style="width: 20%;">Nama Barang</th>
                                                    <th class="text-center" style="width: 10%;">Jumlah</th>
                                                    <th class="text-center" style="width: 10%;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  
                                                    include'../config/config.php';

                                                    $no = 1;

                                                    if (isset($_GET['inputTanggal'])) {
                                                        $tanggalAwal = $_GET['tanggalAwal'];
                                                        $tanggalAkhir = $_GET['tanggalAkhir'];

                                                        $querytransaksi = mysqli_query($dbconnect,"SELECT * FROM transaksi NATURAL JOIN transaksi_detail WHERE transaksi_tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'");
                                                    }else{
                                                        $querytransaksi = mysqli_query($dbconnect,"SELECT * FROM transaksi NATURAL JOIN transaksi_detail");
                                                    }


                                                    while ($datatransaksi = mysqli_fetch_array($querytransaksi)) {
                                                        // tanggal
                                                        $datatanggal = $datatransaksi['transaksi_tanggal'];
                                                        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                                                        $var = explode("-", $datatanggal);
                                                        $tanggal = $var[2].' '.$bulan[(int)$var[1]].' '.$var[0]; 
                                                ?>
                                                    <tr>
                                                        <th class="text-center" scope="row"><?= $no ?></th>
                                                        <td><?php echo $datatransaksi['transaksi_id']; ?></td>
                                                        <td><?php echo $tanggal; ?></td>
                                                        <td><?php echo $datatransaksi['transaksi_detail_barang']; ?></td>
                                                        <td><?php echo $datatransaksi['transaksi_detail_jumlah']; ?></td>
                                                        <td><?php echo $datatransaksi['transaksi_detail_subtotal']; ?></td>
                                                    </tr>
                                                <?php
                                                        $no++;
                                                    }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END Hover Table -->
                        </div>
                    </div>
                    <!-- End tabel -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <?php include'../template/footer.php'; ?>
        </div>
        <!-- END Page Container -->
        <script src="../assets/js/oneui.core.min.js"></script>
        <script src="../assets/js/oneui.app.min.js"></script>

        <script>

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('reportTransaksi');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('Transaksi.' + (type || 'xlsx')));
        }

        </script>
    </body>
</html>
