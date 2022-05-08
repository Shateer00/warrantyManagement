<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <center>
            <h4>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
        </center>
        <br />
        <a class="btn btn-primary" target="_blank">CETAK PDF</a>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>SN</th>
                    <th>Dokumen Bukti</th>
                    <th>Distributor</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($Warranty as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$p->tblitemwarrant_SN}}</td>
                    <td>{{$p->tblitemwarrant_dokBukti}}</td>
                    <td>{{$p->tblitemwarrant_distributor}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>

</html>
