<?php

class Database {
	protected $host = "Localhost",
	$uname = "root",
	$pass = "",
	$db = "datach";

	public $link;
	function __construct() {
		$this->link = mysqli_connect($this->host, $this->uname, $this->pass);
		mysqli_select_db($this->link, $this->db);
	}

	public function nonton($yt_id) {
		$go = "SELECT * FROM isidata WHERE yt_id = '$yt_id'";
		$out = mysqli_query($this->link, $go);
		if ($out) {
			return true;
		} else {
			return false;
		}
	}


	function TampilData() {
		$data = mysqli_query($this->link, "SELECT i.id, i.judul, i.gambar, i.yt_id, i.kategori_id, k.name, k.id as CategoryID FROM isidata i INNER JOIN kategori k ON i.kategori_id = k.id");
		while ($d = mysqli_fetch_array($data)){
			$h[] = $d;
		}
		return $h;
	}


	function Delete($id) {
		$sql = "DELETE FROM isidata WHERE id= $id";
		$res = mysqli_query($this->link, $sql);
		if ($res) {
			return true;
		} else {
			return false;
		}

	}

	function query($query) {
		$result = mysqli_query($this->link, $query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result) )  {
			$rows[] = $row;
		}

		return $rows;
	}


	public function Create($judul,$gambar,$yt_id,$kategori_id) {

		$sql = "
		INSERT INTO isidata (judul, gambar, yt_id, kategori_id)
		VALUES ('$judul', '$gambar', '$yt_id', '$kategori_id')";
		$rip = mysqli_query($this->link, $sql);

		if ($rip) {
			return true;
		} else {
			return false;
		}
	}


	public function upload() {
		$namafile = $_FILES ['gambar']['name'];
		$ukuranfile = $_FILES['gambar']['size'];
		$error =$_FILES['gambar']['error'];
		$tmpname = $_FILES['gambar']['tmp_name'];

 	// CEK UPLOAD GAMBAR

		if ( $error === 4) {
			echo "<script>
			alert ('Pilih Gambar dulu ya :)');
			</script>";

			return false;
		}

 	// Cek Apakah Yang di upload adalah gambar

		$eksigambarvalid = ['jpg','jpeg','png'];
		$eksigambar = explode('.', $namafile);
		$eksigambar = strtolower(end($eksigambar));

		if ( !in_array($eksigambar, $eksigambarvalid) ) {
			echo "<script>
			alert ('Bukan Gambar');
			</script>";

			return false;
		}

 	// CEK SIZE

		if ( $ukuranfile > 3000000) {
			echo "<script>
			alert('Size terlalu Besar');
			</script>";
			return false;
		}

 	// Jika LOLOS GENERATE NAMA BARU

		$namafilebaru = uniqid();
		$namafilebaru .= '.';
		$namafilebaru .= $eksigambar;
		move_uploaded_file($tmpname, 'img/' . $namafilebaru);
		return $namafilebaru;
	}



	public function sanitize($var) {
		$v = mysqli_real_escape_string( $this->link, $var);

		return $v;

	}


	public function Update($id,$judul,$gambarlama,$yt_id,$kategori_id) {
		if ( $_FILES['gambar']['error'] === 4) {
			$gambar = $gambarlama;
		} else {
			$gambar = $this->upload();
		}



		$sql = "UPDATE isidata SET 
		id = '$id',
		judul = '$judul',
		gambar = '$gambar',
		yt_id = '$yt_id',
		kategori_id = $kategori_id
		WHERE id = $id";

		$cek = mysqli_query($this->link, $sql);

		return mysqli_affected_rows($this->link);

		if ($cek) {
			return true;
		} else {
			return false;
		}
	}
}