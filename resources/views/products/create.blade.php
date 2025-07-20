<h1>Tambah Produk</h1>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <input type="text" name="nama_produk" placeholder="Nama"><br>


    <textarea name="deskripsi" placeholder="Deskripsi">
    </textarea><br>
    <input type="number" name="harga" placeholder="Harga"><br>
    <input type="number" name="jumlah_stok" placeholder="Stok"><br>
    <button type="submit">Simpan</button>
</form>