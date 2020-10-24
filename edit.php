<?php include('config.php'); ?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Produk</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['id_produk'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$id_produk = $_GET['id_produk'];

			//query ke database SELECT tabel produk berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$nama_produk= $_POST['nama_produk'];
			$keterangan	= $_POST['keterangan'];
			$harga	= $_POST['harga'];
			$jumlah	= $_POST['jumlah'];

			$sql = mysqli_query($koneksi, "UPDATE produk SET keterangan='$keterangan', harga='$harga', jumlah='$jumlah',nama_produk='$nama_produk' WHERE id_produk='$id_produk'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampil_produk";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="index.php?page=edit_produk&id_produk=<?php echo $id_produk; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama produk</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nama_produk" class="form-control" size="4" value="<?php echo $data['nama_produk']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="keterangan" class="form-control" value="<?php echo $data['keterangan']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Harga</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="harga" class="form-control" value="<?php echo $data['harga']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jumlah</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="jumlah" class="form-control" value="<?php echo $data['jumlah']; ?>" required>
				</div>
			</div>
			
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="index.php?page=tampil_produk" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>
