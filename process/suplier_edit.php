<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Minimarket - Edit Suplier</title>

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
                                Data Suplier 
                            </h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-alt">
                                    <li class="breadcrumb-item">Master data</li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="link-fx" href="barang_data.php">Data suplier</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="link-fx" href="">Edit suplier</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content">
                    <!-- Start form -->
                    <form action="function.php" method="POST">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default block-header-rtl">
                                <div class="block-options">
                                    <button type="reset" class="btn btn-sm btn-alt-primary">
                                        Reset
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-primary" name="edit_suplier">
                                        Submit
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">

                                    <?php
                                        include '../config/config.php';
                                        if (isset($_GET['id'])) {
                                            $id = $_GET['id'];

                                            $querySuplier = mysqli_query($dbconnect,"SELECT * FROM mastersuplier WHERE suplier_id = $id");

                                            $dataSuplier = mysqli_fetch_array($querySuplier);
                                        }
                                    ?>

                                    <div>
                                        <input type="text" name="id" value="<?= $id; ?>" hidden>
                                    </div>

                                    <div class="col-sm-11 col-md-10">
                                        <div class="form-group">
                                            <label for="block-form1-username">Nama suplier</label>
                                            <input type="text" class="form-control form-control-alt" id="namasuplier" name="namasuplier" value="<?= ucwords($dataSuplier['suplier_nama']); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-11 col-md-10">
                                        <div class="form-group">
                                            <label for="block-form1-username">Alamat suplier</label>
                                            <input type="text" class="form-control form-control-alt" id="alamatsuplier" name="alamatsuplier" value="<?= ucwords($dataSuplier['suplier_alamat']) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End form -->
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
