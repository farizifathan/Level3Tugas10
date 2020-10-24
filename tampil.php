<?php
//memasukkan file config.php
include('config.php');
?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Data Mahasiswa</font></center>
		<hr>
		<a href="index.php?page=tambah_produk"><button class="btn btn-dark right">Tambah Data</button></a>
		<div class="table-responsive">
		<table class="table table-striped jambo_table bulk_action" id="datatables">
			<thead>
				<tr>
					<th>NO.</th>
					<th>Nama Produk</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
				$sql = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if(mysqli_num_rows($sql) > 0){
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while($data = mysqli_fetch_assoc($sql)){
						//menampilkan data perulangan
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$data['nama_produk'].'</td>
							<td>'.$data['keterangan'].'</td>
							<td>'.$data['harga'].'</td>
							<td>'.$data['jumlah'].'</td>
							<td>
								<a href="index.php?page=edit_produk&id_produk='.$data['id_produk'].'" class="btn btn-secondary btn-sm">Edit</a>
								<a href="delete.php?nama_produk='.$data['nama_produk'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
						$no++;
					}
				//jika query menghasilkan nilai 0
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>
	</div>
