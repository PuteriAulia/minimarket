<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Minimarket - Transaksi keluar</title>

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
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            <?php include'../template/sidebar.php'; ?>

            <?php include'../template/header.php'; ?>

            <!-- Main Container -->
            <main id="main-container">

                <!-- Proses barang keluar -->
                <?php
                if (isset($_POST['barang_kaluar'])) {
                    include '../config/config.php';
                    $barang_id = $_POST['idbarang'];
                    $barang_jumlah = $_POST['jumlahbarang'];

                    $queryBarang = mysqli_query($dbconnect,"SELECT * FROM masterbarang WHERE barang_id='$barang_id'");
                    $dataBarang = mysqli_fetch_array($queryBarang);

                    $barang_nama = $dataBarang['barang_nama'];
                    $barang_harga_jual = $dataBarang['barang_harga_jual'];
                    $subtotal = $barang_harga_jual*$barang_jumlah;

                    // Pengecekkan apakah stoknya ada atau tidak
                    $queryMasterbarang = mysqli_query($dbconnect,"SELECT * FROM masterbarang WHERE barang_id='$barang_id'");
                    $dataMasterbarang = mysqli_fetch_array($queryMasterbarang);
                    $sediaStok = $dataMasterbarang['barang_jumlah'];

                    if ($sediaStok > $barang_jumlah) {
                        // Id trasaksi
                        $queryTransaksi = mysqli_query($dbconnect,"SELECT * FROM transaksi ORDER BY transaksi_id DESC");
                        $dataTransaksi = mysqli_fetch_array($queryTransaksi);
                        $transaksi_id = $dataTransaksi['transaksi_id'];

                        mysqli_query($dbconnect,"INSERT INTO tmp_transaksi_detail VALUES('','$barang_nama','$barang_jumlah','$barang_harga_jual','$subtotal', '$transaksi_id')");
                    }else{
                ?>
                        <div class="alert alert-warning alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="alert-heading h4 my-2">Mohon Maaf</h3>
                            <p class="mb-0">Stok barang yang tersedia tidak mencukupi pembelian</p>
                        </div>
                <?php
                    }
                }
                ?>

                <!-- Hero -->
                <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill h3 my-2">
                                Transaksi Keluar 
                            </h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-alt">
                                    <li class="breadcrumb-item">Transaksi</li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="link-fx" href="">Transaksi keluar</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content">
                    <!-- Start Baris Pertama -->
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="block block-rounded block-link-pop">
                                <div class="block-content block-content-full">
                                    <form action="function.php" method="POST">
                                        <div class="row">
                                            <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                                                <button type="submit" class="btn btn-success" name="mulaiTransaksi">
                                                    Mulai Transaksi
                                                </button>
                                            </div>
                                            <div class="col-8 col-md-8 col-lg-8 col-xl-8">
                                                <button type="submit" class="btn btn-danger mb-4" name="resetTransaksi">
                                                    Simpan Transaksi
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Baris Pertama -->

                    <!-- Start Baris Kedua -->
                    <div class="row">
                        <!-- Start Card Pilih Barang -->
                        <div class="col-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="block block-rounded block-link-pop">
                                <div class="block-content block-content-full">
                                    <h5>Pilih barang</h5>

                                    <!-- Start form pilih barang -->
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-7 col-md-7 col-lg-7 col-xl-7">
                                                    <select class="form-control form-control-alt" id="example-select" name="idbarang">
                                                        <?php
                                                           include '../config/config.php';
                                                           $queryBarang = mysqli_query($dbconnect,"SELECT * FROM masterbarang");
                                                           while ($dataBarang = mysqli_fetch_array($queryBarang)) {
                                                        ?>
                                                            <option value="<?= $dataBarang['barang_id']; ?>"><?= $dataBarang['barang_nama']; ?></option>
                                                        <?php
                                                           }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                                    <input type="number" class="form-control form-control-alt" name="jumlahbarang" placeholder="Jumlah barang..">
                                                </div>

                                                <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                                                    <button type="submit" class="btn btn-primary" name="barang_kaluar">
                                                        Tambah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End form pilih barang -->
                                </div>
                            </div>
                        </div>
                        <!-- End Card Pilih Barang -->

                        <!-- Start Total Belanja -->
                        <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="block block-rounded block-link-pop">
                                <div class="block-content block-content-full">
                                    <?php
                                        $total = 0;

                                        // Ambil Id transaksi dari tmp_transaksi dulu
                                        $queryTmpTransaksi = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi");
                                        $dataTmpTransaksi = mysqli_fetch_array($queryTmpTransaksi);
                                        if ($dataTmpTransaksi) {
                                            $transksi_id = $dataTmpTransaksi['tmp_transaksi_id'];
                                        }else{
                                            $transksi_id = 0;
                                        }
                                        // echo $transksi_id;

                                        // Mengambil data dari transaksi detail yang sesuai dengan id transaksi
                                        $queryTransaksiDetail = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi_detail");
                                        // echo $dataTransaksiDetail['transaksi_detail_subtotal'];

                                        while ($dataTransaksiDetail = mysqli_fetch_array($queryTransaksiDetail)) {
                                            $total = $dataTransaksiDetail['tmp_transaksi_detail_subtotal']+$total;
                                        }

                                    ?>
                                    <p>TOTAL BELANJA</p>
                                    <h3><?= $total; ?></h3>
                                </div>
                            </div>
                        </div>
                        <!-- End Total Belanja -->
                    </div>
                    <!-- End Baris Kedua -->

                    <!-- Start Baris Ketiga -->
                    <div class="block block-rounded">
                        <div Keempat="block-content">
                            <div class="table-responsive">
                                <table class="table table-hover table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">No</th>
                                            <th class="text-center" style="width: 20%;">Nama barang</th>
                                            <th class="text-center" style="width: 10%;">Jumlah</th>
                                            <th class="text-center" style="width: 10%;">Harga</th>
                                            <th class="text-center" style="width: 10%;">Sub total</th>
                                            <th class="text-center" style="width: 5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            $no = 1;

                                            $queryTransaksiDetail = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi_detail");

                                            while ($dataTransaksiDetail = mysqli_fetch_array($queryTransaksiDetail)) {
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $dataTransaksiDetail['tmp_transaksi_detail_barang']; ?></td>
                                                <td><?= $dataTransaksiDetail['tmp_transaksi_detail_jumlah']; ?></td>
                                                <td><?= $dataTransaksiDetail['tmp_transaksi_detail_harga']; ?></td>
                                                <td><?= $dataTransaksiDetail['tmp_transaksi_detail_subtotal'] ?></td>
                                                <td>
                                                    <a href="function.php?hapusTransaksi=<?= $dataTransaksiDetail['tmp_transaksi_detail_id']; ?>" onclick="return confirn('Apakah anda yakin ingin menghapus data?')">
                                                        <button type="button" class="btn btn-danger mr-1 mb-3 btn-sm">
                                                            <i class="fa fa-fw fa-times mr-1"></i> Hapus
                                                        </button>
                                                    </a>
                                                </td>
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
                    <!-- End Baris Ketiga -->

                    <!-- Start Baris Keempat -->
                    <div class="row">
                        <div class="col-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="block block-rounded block-link-pop">
                                <div class="block-content block-content-full">
                                    <h5>PEMBAYARAN</h5>

                                    <!-- Start form pilih barang -->
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <div class="row">
                                                <input type="number" name="total" value="<?= $total ?>" hidden>

                                                <div class="col-10 col-md-10 col-lg-10 col-xl-10">
                                                    <input type="number" class="form-control form-control-alt" name="uangbayar" placeholder="Jumlah uang pembayaran..">
                                                </div>

                                                <div class="col-2 col-md-2 col-lg-2 col-xl-2">
                                                    <button type="submit" class="btn btn-primary" name="pembayaran">
                                                        Bayar
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <!-- End form pilih barang -->
                                </div>
                            </div>
                        </div>

                        <?php
                        if (isset($_POST['pembayaran'])) {
                            $transaksi_bayar = $_POST['uangbayar'];
                            $transaksi_total = $_POST['total'];

                            $transaksi_kembalian = (int)$transaksi_bayar-(int)$transaksi_total;
                        ?>
                            <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="block block-rounded block-link-pop">
                                    <div class="block-content block-content-full">
                                        <p>KEMBALIAN</p>
                                        <h3>
                                            <?php echo $transaksi_kembalian; ?> 
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        } 
                        else{
                        ?>
                            <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="block block-rounded block-link-pop">
                                    <div class="block-content block-content-full">
                                        <p>KEMBALIAN</p>
                                        <h3>
                                            0
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- End Baris Keempat -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <?php include'../template/footer.php'; ?>
        </div>
        <!-- END Page Container -->
        <script src="../assets/js/oneui.core.min.js"></script>
        <script src="../assets/js/oneui.app.min.js"></script>
    </body>
</html>
