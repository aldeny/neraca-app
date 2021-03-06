
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Neraca-app | Print Gaji Karyawan</title>

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
                    Laporan Gaji Karyawan
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
            <th>Nama Karyawan</th>
            <th>Jabatan</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Saldo</th>
            <th>Tanggal</th>
            <th>Gaji</th>
          </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($employee as $dt)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dt->nama }}</td>
                <td>{{ $dt->position->jabatan }}</td>

                @if ($dt->employee->jenis_kelamin == 1)
                    <td>Laki-laki</td>
                @else
                    <td>Perempuan</td>
                @endif

                @if ($dt->employee->status == 1)
                    <td>K/...</td>
                @elseif($dt->employee->status == 2)
                    <td>TK/0</td>
                @else
                    <td>TK/1</td>
                @endif

                @if ($dt->saldo == 1)
                <td>Kas Bank</td>
                @elseif ($dt->saldo == 2)
                <td>Kas Besar</td>
                @else
                <td>Kas Kecil</td>
                @endif

                <td>{{ date('d-m-Y', strtotime($dt->created_at)) }}</td>
                <td>Rp. {{ number_format($dt->gaji,0,',','.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="7" class="text-center"><b>TOTAL GAJI</b></td>
                <td colspan="1"><b>Rp. {{ number_format($sum,0,',','.') }}</b></td>
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
