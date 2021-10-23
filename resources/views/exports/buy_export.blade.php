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
            <h1>LAPORAN KESELURUHAN PEMBELIAN</h1>
        </center>

        <h5>Tanggal: {{ $today }}</h5>

        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Saldo</th>
                <th>Harga Beli</th>
                <th>Total</th>
                <th>Keterangan</th>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach($buy as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->tanggal_beli)) }}</td>
                    <td>{{ $data->Product->nama_produk }}</td>
                    <td>{{ $data->jumlah_item}}</td>

                    @if ($data->saldo == 1)
                        <td>Saldo Bank</td>
                    @elseif ($data->saldo == 2)
                        <td>Saldo Besar</td>
                    @else
                        <td>Saldo Kecil</td>
                    @endif

                    <td>Rp. {{ number_format($data->harga_beli,0,',','.') }}</td>
                    <td>Rp. {{ number_format($data->total   ,0,',','.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="6" center><b><center>TOTAL</center></b></td>
                    <td colspan="2"><b> Rp. {{ number_format($total,0,',','.') }}</b></td>
                </tr>
        </table>
    </body>

</html>
