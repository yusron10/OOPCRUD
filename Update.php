<?php
include 'init.php';

$datac = new Database();

$id = $_GET["id"];
$d = $datac->query("SELECT * FROM isidata WHERE id = $id")[0];
$kik = $datac->query("SELECT * FROM kategori");


if(isset($_POST) & !empty($_POST)){
	$id = $_POST['id'];
	$judul = $datac->sanitize($_POST['judul']);
	$gambarlama = $_POST['gambarlama']);
	$yt_id = $datac->sanitize($_POST['yt_id']);
	$kategori_id = $_POST['kategori_id'];


	$rip = $datac->Update($id, $judul, $gambarlama, $yt_id, $kategori_id);

	if ($rip) {
		echo "
		<script>
		alert('data berhasil di ubah');
		document.location.href = 'index.php'
		</script>
		";
	}else {
		echo "Data Gagal";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EDIT Data</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>EDIT Data</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $d["id"]; ?>">
		<input type="hidden" name="gambarlama" value="<?php echo $d["gambar"]; ?>">
		<ul>
			<li>
				<label for="judul">Judul : </label>
				<input type="text" name="judul" id="judul" required value="<?php echo $d["judul"]; ?>">
			</li>
			<br>
			<br>
			<li>
				<label for="gambar">Gambar : </label>
				<br>
				<br>
				<img src="img/<?= $d['gambar']; ?>" width="100">
				<br>

				<br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<br>
			<br>
			<li>
				<label for="yt_id">YOUTUBE : </label>
				<input type="text" name="yt_id" id="yt_id" required value="<?php echo $d["yt_id"]; ?>">
			</li>
			<br>
			<br>
			<li>
				<label for="kategori_id">Kategori : </label>
				<select name="kategori_id" id="kategori_id">
					<?php foreach ($kik as $k) : ?>
						<option value="<?php echo $k["id"] ?>"><?php echo $k["name"] ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<br>
			<li>
				<button type="submit" name="submit">Simpan Data</button>
			</li>
		</ul>
	</form>
</body>
</html>