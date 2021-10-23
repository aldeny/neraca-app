<html>
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                }

                td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
                }

                h5{
                    text-align: right;
                }
            </style>
    </head>

    <body>
        <center>
            <h1>LAPORAN KESELURUHAN ASET</h1>
        </center>

        <h5>Tanggal: {{ $today }}</h5>

        <table>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Saldo</th>
                <th>Kondisi</th>
                <th>Jumlah Barang</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Keterangan</th>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach($aset as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td><center><img src="/storage/img-assets/{{ $data->gambar }}" class="img-fluid" width="50%" alt="img aset"></center></td>
                    <td>{{ date('d-m-Y', strtotime($data->tanggal_beli_aset)) }}</td>
                    <td>{{ $data->nama_barang }}</td>

                    @if ($data->saldo == 1)
                        <td>Saldo Bank</td>
                    @elseif ($data->saldo == 2)
                        <td>Saldo Besar</td>
                    @else
                        <td>Saldo Kecil</td>
                    @endif

                    @if ($data->kondisi == 1)
                        <td>Baik</td>
                    @else
                        <td>Rusak</td>
                    @endif

                    <td>{{ $data->jumlah}}</td>
                    <td>Rp. {{ number_format($data->harga,0,',','.') }}</td>
                    <td>Rp. {{ number_format($data->total   ,0,',','.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="8" center><b><center>TOTAL</center></b></td>
                    <td colspan="2"><b> Rp. {{ number_format($total,0,',','.') }}</b></td>
                </tr>
        </table>

        <script>
            window.addEventListener("load", window.print());
        </script>

    </body>

</html>
