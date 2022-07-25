<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Minimarket - Data Barang</title>

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

                <!-- Hero -->
                <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill h3 my-2">
                                Data Barang 
                            </h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-alt">
                                    <li class="breadcrumb-item">Master data</li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="link-fx" href="">Data barang</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content">
                    <!-- Start button tambah barang -->
                    <div class="mb-3">
                        <a href="barang_tambah.php">
                            <button type="button" class="btn btn-success mr-1 mb-3">
                                <i class="fa fa-fw fa-plus mr-1"></i> Tambah barang
                            </button>
                        </a>
                    </div>
                    <!-- End button tambah barang -->

                    <!-- Hover Table -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-hover table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">No</th>
                                            <th class="text-center" style="width: 20%;">Nama barang</th>
                                            <th class="text-center" style="width: 10%;">Harga Beli</th>
                                            <th class="text-center" style="width: 10%;">Harga Jual</th>
                                            <th class="text-center" style="width: 10%;">Jumlah</th>
                                            <th class="text-center" style="width: 20%;">Suplier</th>
                                            <th class="text-center" style="width: 30%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
                                            include'../config/config.php';

                                            $no = 1;
                                            $databarang = mysqli_query($dbconnect,"SELECT * FROM masterbarang NATURAL JOIN mastersuplier");
                                            while ($rowbarang = mysqli_fetch_array($databarang)) {
                                        ?>
                                            <tr>
                                                <th class="text-center" scope="row"><?= $no ?></th>
                                                <td><?= ucfirst($rowbarang['barang_nama']); ?></td>
                                                <td><?= $rowbarang['barang_harga_beli']; ?></td>
                                                <td><?= $rowbarang['barang_harga_jual']; ?></td>
                                                <td><?= $rowbarang['barang_jumlah']; ?></td>
                                                <td><?= ucfirst($rowbarang['suplier_nama']) ?></td>
                                                <td>
                                                    <a href="function.php?hapusBarang=<?= $rowbarang['barang_id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                                        <button type="button" class="btn btn-danger mr-1 mb-3 btn-sm">
                                                            <i class="fa fa-fw fa-times mr-1"></i> Hapus
                                                        </button>
                                                    </a>
                                                    <a href="barang_edit.php?id=<?= $rowbarang['barang_id']; ?>">
                                                        <button type="button" class="btn btn-primary mr-1 mb-3 btn-sm">
                                                            <i class="fa fa-fw fa-pencil-alt"></i> Edit
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
                    <!-- END Hover Table -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <?php include'../template/footer.php'; ?>
        </div>
        <!-- END Page Container -->
        <script src="../assets/js/oneui.core.min.js"></script>
        <script src="../assets/js/oneui.app.min.js"></script>

        <!-- Sweet Alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
