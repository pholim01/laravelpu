<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <a href="{{ route('products.create') }}">+ Tambah Produk</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->nama_produk }}</td>
            <td>{{ $product->deskripsi }}</td>
            <td>{{ $product->harga }}</td>
            <td>{{ $product->jumlah_stok }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
