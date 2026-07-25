<div class="card">

	<div class="card-header">
		<h4>
			<i class="fas fa-money-bill-wave text-primary"></i>
			Tambah Catatan Pengeluaran
		</h4>
	</div>

	<div class="card-body">

		<form action="/OGIKFINANC/proses/Proses logika/proses_tulis_catatan_pengeluaran.php" method="POST">

			<div class="form-group">
				<label>Tanggal</label>
				<input
					type="date"
					name="tanggal"
					class="form-control"
					required>
			</div>

			<div class="form-group">
				<label>Nama Barang</label>
				<input
					type="text"
					name="nama_barang"
					class="form-control"
					required>
			</div>

			<div class="form-group">
				<label>Lokasi</label>
				<input
					type="text"
					name="lokasi"
					class="form-control"
					required>
			</div>

			<div class="form-group">
				<label>Jenis Barang</label>

				<select
					name="jenis_barang"
					class="form-control"
					required>
					<option value="">-- Pilih Jenis Barang --</option>
					<option>Makanan</option>
					<option>Minuman</option>
					<option>Transportasi</option>
					<option>Kesehatan</option>
					<option>Pendidikan</option>
					<option>Elektronik</option>
					<option>Pakaian</option>
					<option>Hiburan</option>
					<option>Lainnya</option>

				</select>

			</div>

			<div class="form-group">
				<label>Harga</label>

				<input
					type="number"
					name="harga"
					class="form-control"
					min="1"
					required>

			</div>

			<div class="form-group">
				<label>Metode Pembayaran</label>

				<select
					name="metode_pembayaran"
					class="form-control"
					required>
					<option value="">-- Pilih Metode --</option>
					<option>Cash</option>
					<option>QRIS</option>
					<option>Transfer Bank</option>
					<option>E-Wallet</option>
					<option>Hutang</option>
				</select>

			</div>

			<div class="form-group">
				<label>Catatan</label>

				<textarea
					name="catatan"
					rows="4"
					class="form-control"></textarea>
			</div>

			<div class="form-group">

				<a
					href="/OGIKFINANC/user.php?url=lihat-catatan"
					class="btn btn-secondary">

					<i class="fas fa-arrow-left"></i>
					Kembali

				</a>

				<button
					type="submit"
					class="btn btn-success">

					<i class="fas fa-save"></i>
					Simpan

				</button>

				<button
					type="reset"
					class="btn btn-danger">
					<i class="fas fa-trash"></i>
					Reset Form

				</button>

			</div>

		</form>

	</div>

</div>