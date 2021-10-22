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
            </style>
    </head>

    <body>
        <center>
            <h1>LAPORAN KESELURUHAN NERACA</h1>
        </center>

        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Sumber Dana</th>
                <th>Bank</th>
                <th>Dana</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach($cash as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->tanggal)) }}</td>
                    <td>{{ $data->sumber_dana }}</td>
                    <td>{{ $data->Bank->nama_bank }}</td>
                    <td>{{ $data->dana }}</td>
                    <td>Rp. {{ number_format($data->jumlah,0,',','.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="5" center><b><center>TOTAL</center></b></td>
                    <td colspan="2"><b> Rp. {{ number_format($total,0,',','.') }}</b></td>
                </tr>
        </table>
    </body>

</html>
