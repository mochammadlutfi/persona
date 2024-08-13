<html>

<head>
    <title> Laporan Pendaftaran</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <style>
        body {
            font-size: 12pt;
        }
    
        #table-header {
            width: 100%;
            border-collapse: collapse;
        }
    
        #table-header th, #table-header td {
            padding: 8px;
            text-align: left;
            border-bottom: 2px solid red;
        }
    
        #table-header .logo{
            max-width: 100%;
            width: 100%;
        }
    
        #table-header .info{
            text-align: right;
        }
        #table-header h1{
            margin-bottom: 5px;
            font-size:28pt;
            font-weight: bold;
            color: red !important;
        }
        #table-header p{
            font-size:24pt;
            font-weight: 600;
        }
    
    
        #table-produk {
            width: 100%;
            border-collapse: collapse;
        }
    
        #table-produk th, {
            padding: 8px;
            text-align: center;
            font-size: 16pt;
            border-top: 1px solid red;
        }
    
        #table-produk tbody td {
            padding: 8px;
            text-align: left;
            font-size: 14pt;
            border-top: 1px solid red;
            background-color: #faf3f3;
        }
        #table-produk tbody tr:nth-child(even){
            background-color: none;
        }
        #table-produk tfoot td {
            padding: 8px;
            text-align: left;
            font-size: 14pt;
            border-bottom: 1px solid red;
            background-color: #faf3f3;
        }
    </style>
</head>

<body>
    <div class="container">
        <table id="table-header">
            <tr>
                <td width="30%">
                    <img src="/images/logo.png"/>
                    <div style="padding-left: 200px">
                        <p style="font-weight: bold;margin-bottom:0px;font-size:12pt">    BICARA SEMAKIN BERMAKNA</p>
                    </div>
                </td>
                <td style="text-align: center" width="50%">
                    <h1 style="font-size: 22pt;font-weight:bold;text-decoration:underline;">CV. TRANSFORMASI AKSELERASI PRIMA</h1>
                    <h2 style="font-size: 18pt;font-weight:bold;">PERSONA PUBLIC SPEAKING</h2>
                    <p class="mb-0" style="font-size: 10pt;margin-bottom:15px">Pesona Cihanjuang 5, No.16. Jalan Cisasawi, Cihanjuang Kec. Parongpong, <br/>Kab. Bandung Barat, Jawa Barat 40559.</p>
                </td>
            </tr>
        </table>
        <hr/>
        <br/>
        <h2 class="h3 text-center" style="font-weight: bold; margin-top:0px">LAPORAN PENDAFTARAN KELAS</h2>
        <h2 class="h4 text-center" style="font-weight: bold; margin-top:0px">
            Periode : {{ \Carbon\Carbon::parse($tgl[0])->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($tgl[1])->translatedFormat('d F Y') }}
        </h2>
        <br/>
        <br/>
        <table class="table table-bordered datatable w-100">
            <thead>
                <tr>
                    <th width="60px">No</th>
                    <th>No Pendaftaran</th>
                    <th>Peserta</th>
                    <th>Program</th>
                    <th>Harga</th>
                    <th>Tgl Daftar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $a)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $a->nomor }}</td>
                        <td>{{ $a->user->nama }}</td>
                        <td>{{ $a->training->nama }}</td>
                        <td>Rp {{ number_format($a->training->harga,0,',','.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->tgl)->translatedFormat('d F Y') }}</td>
                        <td>{{ $a->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>