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
            <h1>LAPORAN KESELURUHAN CREDIT</h1>
        </center>

        <h5>Tanggal: {{ $today }}</h5>

        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Saldo</th>
                <th>Harga</th>
                <th>Jumlah Bayar</th>
                <th>Sisa</th>
                <th>Keterangan</th>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach($credit as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->tanggal_beli)) }}</td>
                    <td>{{ $data->nama_item }}</td>

                    @if ($data->saldo == 1)
                        <td>Saldo Bank</td>
                    @elseif ($data->saldo == 2)
                        <td>Saldo Besar</td>
                    @else
                        <td>Saldo Kecil</td>
                    @endif

                    <td>Rp. {{ number_format($data->harga,0,',','.') }}</td>
                    <td>Rp. {{ number_format($data->jumlah_bayar,0,',','.') }}</td>
                    <td>Rp. {{ number_format($data->sisa   ,0,',','.') }}</td>
                    <td>{{ $data->ket_bayar }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" center><b><center>TOTAL</center></b></td>
                    <td><b>Rp. {{ number_format($jum,0,',','.') }}</b></td>
                    <td><b>Rp. {{ number_format($harga,0,',','.') }}</b></td>
                    <td colspan="2"><b> Rp. {{ number_format($sisa,0,',','.') }}</b></td>
                </tr>
        </table>

    </body>

</html>
