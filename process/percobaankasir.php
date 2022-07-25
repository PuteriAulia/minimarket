<?php
	include '../config/config.php';
	if (isset($_POST['tambah'])) {
		$barang_id = $_POST['barang'];
		$barang_jumlah = $_POST['jumlah'];

		// echo $barang_id;

		$queryBarang = mysqli_query($dbconnect,"SELECT * FROM masterbarang WHERE barang_id='$barang_id'");
		$dataBarang = mysqli_fetch_array($queryBarang);

		$barang_nama = $dataBarang['barang_nama'];
		$barang_harga_jual = $dataBarang['barang_harga_jual'];
		$subtotal = $barang_harga_jual*$barang_jumlah;

		mysqli_query($dbconnect,"INSERT INTO tmp_transaksi VALUES ('', '$barang_nama', '$barang_jumlah', '$barang_harga_jual', '$subtotal')");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kasir percobaan</title>
</head>
<body>
	<form action="" method="post">
		<select name="barang">
		<?php
			$queryAllBarang = mysqli_query($dbconnect,"SELECT * FROM masterbarang");

			while ($dataAllBarang = mysqli_fetch_array($queryAllBarang)) {
		?>
			<option value="<?= $dataAllBarang['barang_id'] ?>"><?= $dataAllBarang['barang_nama']; ?></option>
		<?php
			}
		?>
		</select>

		<input type="number" name="jumlah">

		<input type="submit" name="tambah">
	</form>

	<br><br>

	<table border="2" cellpadding="4">
		<thead>
			<td>No</td>
			<td>Nama Barang</td>
			<td>Jumlah</td>
			<td>Harga</td>
			<td>Sub total</td>
		</thead>

		<?php
			$no = 1;

			$queryBarangTmp = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi");
			while ($dataBarangTmp = mysqli_fetch_array($queryBarangTmp)) {
		?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $dataBarangTmp['tmp_transaksi_barang'] ?></td>
				<td><?= $dataBarangTmp['tmp_transaksi_jumlah'] ?></td>
				<td><?= $dataBarangTmp['tmp_transaksi_harga'] ?></td>
				<td><?= $dataBarangTmp['tmp_transaksi_subtotal'] ?></td>
			</tr>
		<?php
			$no++;
			}
		?>
	</table>

	<?php
		$total = 0;
		$queryBarangTmp = mysqli_query($dbconnect,"SELECT * FROM tmp_transaksi");
		while ($dataBarangTmp = mysqli_fetch_array($queryBarangTmp)) {
			$total = $dataBarangTmp['tmp_transaksi_subtotal'] + $total;
		}
	?>
	<h2>Total <?= $total ?></h2>
</body>
</html>