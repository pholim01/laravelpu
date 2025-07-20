<h1>Edit Produk</h1>
<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="nama_produk" value="{{ $product->nama_produk }}"><br>
    <textarea name="deskripsi">{{ $product->deskripsi }}</textarea><br>
    <input type="number" name="harga" value="{{ $product->harga }}"><br>
    <input type="number" name="jumlah_stok" value="{{ $product->jumlah_stok }}"><br>
    <button type="submit">Update</button>
</form>