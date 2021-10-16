
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Neraca-app | Print Penjualan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="text-center">
                <h2 class="page-header text-bold">
                    Laporan Penjualan
                </h2>
                <small>Tanggal: {{ $today}}</small>
            </div>
        </div>
        <div class="col-3"></div>
        <hr>
    </div>
      <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered mt-4">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Tanggal</th>
            <th>Jumlah Produk</th>
            <th>Harga Beli</th>
            <th>Total</th>
            <th>Keterangan</th>
          </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($sell as $dt)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dt->product->nama_produk }}</td>
                <td>{{ date('d-m-Y', strtotime($dt->tanggal_jual)) }}</td>
                <td>{{ $dt->jumlah_item }}</td>
                <td>Rp. {{ number_format($dt->harga_jual,0,',','.'); }}</td>
                <td>Rp. {{ number_format($dt->total,0,',','.'); }}</td>
                <td>{{ $dt->keterangan }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-center"><b>TOTAL PENJUALAN</b></td>
                <td colspan="2"><b>Rp. {{ number_format($sum,0,',','.') }}</b></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
    window.addEventListener("load", window.print());
</script>
</body>
</html>
