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
            <h1>LAPORAN KESELURUHAN PEGAWAI</h1>
        </center>

        <h5>Tanggal: {{ $today }}</h5>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Gaji</th>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach($pegawai as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->Position->jabatan }}</td>

                    @if ($data->jenis_kelamin == 1)
                        <td>Laki-Laki</td>
                    @else
                        <td>Perempuan</td>
                    @endif

                    @if ($data->status == 1)
                        <td>K/...</td>
                    @elseif ($data->status == 2)
                        <td>TK/0</td>
                    @else
                        <td>TK/1</td>
                    @endif

                    <td>Rp. {{ number_format($data->gaji   ,0,',','.') }}</td>
                </tr>
            @endforeach
                {{-- <tr>
                    <td colspan="4" center><b><center>TOTAL</center></b></td>
                    <td><b>Rp. {{ number_format($jum,0,',','.') }}</b></td>
                    <td><b>Rp. {{ number_format($harga,0,',','.') }}</b></td>
                    <td colspan="2"><b> Rp. {{ number_format($sisa,0,',','.') }}</b></td>
                </tr> --}}
        </table>

    </body>

</html>
