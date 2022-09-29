<?php 
include 'init.php';
$datac = new Database();

?>
<h1>CRUD OOP PHP</h1>
 
<a href="Create.php">Tambah</a>
<table border="1" cellspacing="0" cellpadding="10">
	<tr>
		<th>No</th>
		<th>Kategori</th>
		<th>Judul</th>
		<th>Gambar</th>
		<th>Youtube</th>
		<th>Aksi</th>
	</tr>
	<?php $no = 1; ?>
	<?php foreach($datac->TampilData() as $x) : ?>

	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['name']; ?></td>
		<td><?php echo $x['judul']; ?></td>
		<td><img src="img/<?php echo $x["gambar"]; ?>" width="50" alt=""></a></td>
		<td><?php echo $x['yt_id']; ?></td>
		<td>
			<a href="Update.php?id=<?php echo $x['id']; ?>">Edit</a>
			<a href="Job/Delete.php?id=<?php echo $x['id']; ?>">Hapus</a>
			<a href="nonton.php?watch=<?php echo $x['yt_id']; ?>">Nonton</a>			
		</td>
	</tr>
	<?php endforeach;?>
</table>