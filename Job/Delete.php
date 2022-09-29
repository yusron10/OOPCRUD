<?php 
include 'Database.php';
$datac = new Database();
$id = $_GET['id'];

$res = $datac->Delete($id);
if ($res) {
	echo "<script>
		alert ('Data Berhasil Di Hapus');
			document.location.href= '../index.php'</script>";

} else {
	echo "FAILED";
}