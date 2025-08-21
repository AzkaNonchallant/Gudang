<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Stok Menipis</title>
</head>
<body>
  <p>Halo Admin,</p>

  <p>Barang <strong>{{ $barang->nama }}</strong> (kode: {{ $barang->kode }}) stoknya sudah menipis.</p>

  <ul>
    <li>Stok sekarang: {{ $barang->stok }}</li>
    <li>Minimum stok: {{ $barang->minimum_stok }}</li>
  </ul>

  <p>Mohon tindak lanjut (restock) jika diperlukan.</p>
  <p>Terima kasih.</p>
</body>
</html>
