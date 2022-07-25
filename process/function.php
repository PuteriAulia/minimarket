<?php
	include'../config/config.php';

	// TAMBAH BARANG
	if (isset($_POST['tambah_barang'])) {
		$barang_nama = $_POST['namabarang'];
		$barang_harga_beli = $_POST['hargabeli'];
		$barang_harga_jual = $_POST['hargajual'];
		$barang_jumlah = $_POST['stok'];
		$suplier_id = $_POST['suplier'];

		mysqli_query($dbconnect, "INSERT INTO masterbarang VALUES('', '$barang_nama', '$barang_harga_beli', '$barang_harga_jual', '$barang_jumlah', '$suplier_id')");

   		header("location:barang_data.php");
	}
 

	// EDIT BARANG
	if (isset($_POST['edit_barang'])) {
		$id = $_POST['id'];
		$barang_nama = $_POST['namabarang'];
		$barang_harga_beli = $_POST['hargabeli'];
		$barang_harga_jual = $_POST['hargajual'];
		$barang_jumlah = $_POST['stok'];
		$suplier_id = $_POST['suplier'];

		mysqli_query($dbconnect, "UPDATE masterbarang SET barang_nama='$barang_nama', barang_harga_beli='$barang_harga_beli', barang_harga_jual='$barang_harga_jual', barang_jumlah='$barang_jumlah', suplier_id='$suplier_id' WHERE barang_id = '$id' ");

    	header("location:barang_data.php");	
	}


	// HAPUS BARANG
	if (isset($_GET['hapusBarang'])) {
		$barang_id = $_GET['hapusBarang'];

		mysqli_query($dbconnect,"DELETE FROM `masterbarang` WHERE barang_id='$barang_id'");

		header("Location:barang_data.php");
	}


	// TAMBAH SUPPLIER
	if (isset($_POST['tambah_suplier'])) {
		$suplier_nama = strtolower($_POST['namasuplier']);
		$suplier_alamat = strtolower($_POST['alamatsuplier']);

		mysqli_query($dbconnect, "INSERT INTO mastersuplier VALUES('','$suplier_nama','$suplier_alamat')");

		header("Location:suplier_data.php");
	}


	// EDIT SUPPLIER
	if (isset($_POST['edit_suplier'])) {
		$suplier_id = $_POST['id'];
		$suplier_nama = $_POST['namasuplier'];
		$suplier_alamat = $_POST['alamatsuplier'];

		mysqli_query($dbconnect,"UPDATE mastersuplier SET suplier_nama='$suplier_nama', suplier_alamat='$suplier_alamat' WHERE suplier_id='$suplier_id'");

		header("Location:suplier_data.php");
	}


	// HAPUS SUPPLIER
	if (isset($_GET['hapusSuplier'])) {
		$suplier_id = $_GET['hapusSuplier'];

		mysqli_query($dbconnect,"DELETE FROM `mastersuplier` WHERE suplier_id='$suplier_id'");

		header("Location:suplier_data.php");
	}

	// MULAI TRANSAKSI
	if (isset($_POST['mulaiTransaksi'])) {
		// // Masukkin semua data ke tmp_transaksi_detail
		// $queryTmpTransaksiDetail = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi_detail");
		
		// while ($dataTmpTransaksiDetail = mysqli_fetch_array($queryTmpTransaksiDetail)) {
		// 	$barang = $dataTmpTransaksiDetail['tmp_transaksi_detail_barang'];
		// 	$jumlah = $dataTmpTransaksiDetail['tmp_transaksi_detail_jumlah'];
		// 	$harga = $dataTmpTransaksiDetail['tmp_transaksi_detail_harga'];
		// 	$subtotal = $dataTmpTransaksiDetail['tmp_transaksi_detail_subtotal'];
		// 	$transaksi_id = $dataTmpTransaksiDetail['transaksi_id'];

		// 	mysqli_query($dbconnect,"INSERT INTO transaksi_detail VALUES('', '$barang', '$jumlah', '$harga', '$subtotal', '$transaksi_id')");
		// }

		// mysqli_query($dbconnect,"TRUNCATE TABLE tmp_transaksi");
		// mysqli_query($dbconnect,"TRUNCATE TABLE tmp_transaksi_detail");

		$tanggal = date("Y-m-d H:i:s");

		mysqli_query($dbconnect,"INSERT INTO transaksi VALUES('', '$tanggal')");
		mysqli_query($dbconnect,"INSERT INTO tmp_transaksi VALUES('', '$tanggal')");

		header('Location: transaksi_keluar.php');
	}


	// HAPUS TRANSAKSI KELUAR
	if (isset($_GET['hapusTransaksi'])) {
		$tmp_transaksi_detail_id = $_GET['hapusTransaksi'];

		mysqli_query($dbconnect,"DELETE FROM `tmp_transaksi_detail` WHERE tmp_transaksi_detail_id='$tmp_transaksi_detail_id'");

		// mysqli_query($dbconnect,"DELETE FROM `transaksi_detail` WHERE transaksi_detail_id='$tmp_transaksi_detail_id'");

		header('Location:transaksi_keluar.php');
	}


	// RESET TRANSAKSI
	if(isset($_POST['resetTransaksi'])){
		// Masukkin semua data ke tmp_transaksi_detail
		$queryTmpTransaksiDetail = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi_detail");
		
		while ($dataTmpTransaksiDetail = mysqli_fetch_array($queryTmpTransaksiDetail)) {
			$barang = $dataTmpTransaksiDetail['tmp_transaksi_detail_barang'];
			$jumlah = $dataTmpTransaksiDetail['tmp_transaksi_detail_jumlah'];
			$harga = $dataTmpTransaksiDetail['tmp_transaksi_detail_harga'];
			$subtotal = $dataTmpTransaksiDetail['tmp_transaksi_detail_subtotal'];
			$transaksi_id = $dataTmpTransaksiDetail['transaksi_id'];

			mysqli_query($dbconnect,"INSERT INTO transaksi_detail VALUES('', '$barang', '$jumlah', '$harga', '$subtotal', '$transaksi_id')");
		}

		// PENGURANGAN STOK
		$queryTransaksiDetail = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi_detail");
		while ($dataTransaksiDetail = mysqli_fetch_array($queryTransaksiDetail)) {
			$transaksi_barang_nama = $dataTransaksiDetail['tmp_transaksi_detail_barang'];
			$transaksi_barang_jumlah = $dataTransaksiDetail['tmp_transaksi_detail_jumlah'];

			// Ambil data dari master barang
			$queryMasterbarang = mysqli_query($dbconnect,"SELECT * FROM masterbarang WHERE barang_nama='$transaksi_barang_nama'");
			$dataMasterbarang = mysqli_fetch_array($queryMasterbarang);
			$stokAwal = $dataMasterbarang['barang_jumlah'];
			$stokAkhir = $stokAwal-$transaksi_barang_jumlah;

			mysqli_query($dbconnect,"UPDATE masterbarang SET barang_jumlah='$stokAkhir' WHERE barang_nama='$transaksi_barang_nama'");
		}

		mysqli_query($dbconnect,"TRUNCATE TABLE tmp_transaksi");
		mysqli_query($dbconnect,"TRUNCATE TABLE tmp_transaksi_detail");

		header('Location:transaksi_keluar.php');
	}
?>