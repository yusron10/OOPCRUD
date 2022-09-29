<?php

include 'init.php';

$datac = new Database();

if(isset($_POST) & !empty($_POST)){
	$judul = $datac->sanitize($_POST['judul']);
	$gambar = $datac->upload($_POST);
	if (!$gambar) {
		return false;
	}
	$yt_id = $datac->sanitize($_POST['yt_id']);
	$kategori_id = $_POST['kategori_id'];

	$rip = $datac->Create($judul, $gambar, $yt_id, $kategori_id);
	if($rip){
		echo "<script>
		alert('Data berhasil Masuk ! ')
		document.location.href = 'index.php'</script>";
	}else{
		echo "failed to insert data";
	}
}
$kik = $datac->query("SELECT * FROM kategori");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tambah Data</title>
</head>
<body>
	<h1>Tambah Data</h1>
	<form action="" method="post" enctype="multipart/form-data">

		<ul>
			<li>
				<label for="judul">Judul : </label>
				<input type="text" name="judul" id="judul" required>
			</li>
			<br>
			<li>
				<label for="gambar">Gambar : </label>
				<input type="file" name="gambar" id="gambar">
			</li>

			<br>

			<li>
				<label for="yt_id">ID YOUTUBE : </label>
				<input type="text" name="yt_id" id="yt_id">
			</li>

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
				<button type="submit" name="submit">Create Data</button>
			</li>
		</ul>
	</form>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- 	<script>
		$('#judul').keyup(function () {
			var str = $(this).val();
			var trims = $.trim(str)
			var slug = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
			$("#slug").val(slug.toLowerCase()+".com")
		})
	</script> -->
</body>
</html>
