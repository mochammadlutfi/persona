@php
    function terbilang($x) {
  $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

  if ($x < 12)
    return " " . $angka[$x];
  elseif ($x < 20)
    return terbilang($x - 10) . " belas";
  elseif ($x < 100)
    return terbilang($x / 10) . " puluh" . terbilang($x % 10);
  elseif ($x < 200)
    return "seratus" . terbilang($x - 100);
  elseif ($x < 1000)
    return terbilang($x / 100) . " ratus" . terbilang($x % 100);
  elseif ($x < 2000)
    return "seribu" . terbilang($x - 1000);
  elseif ($x < 1000000)
    return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
  elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}
@endphp
<html>

<head>
    <title>KWITANSI {{ $data->nomor }}</title>

    {{-- <link rel="stylesheet" href="/css/bootstrap.css"> --}}
</head>
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
                <td class="info" width="70%">
                    <h1>INVOICE</h1>
                    <p style="font-weight: bold;margin-bottom:0px;font-size:12pt">INVOICE NO : {{ $data->nomor}} </p>
                </td>
            </tr>
        </table>
        <br/>
        <table width="100%">
            <tr>
                <td width="50%">
                    <p class="h4 fw-bold" style="font-weight: bold;">
                        Kepada:
                    </p>
                    <p class="h4 fw-bold" style="font-weight: bold;">
                        {{ $data->user->nama }}
                    </p>
                </td>
                <td>
                    <p style="font-size:20pt; font-weight: bold;">
                        Total
                    </p>
                    <p style="font-size:20pt; font-weight: bold;margin-bottom:10px">
                        Rp {{ number_format($data->training->harga,0,',','.') }}
                    </p>
                    <p>({{ ucwords(terbilang($data->training->harga)) }})</p>
                    <br/>
                    <table width="100%">
                        <tr>
                            <td style="font-weight:bold; padding:8px;font-size:14pt;background-color:black;color:white">
                                INVOICE DATE : {{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        {{-- <hr/> --}}
        <table id="table-produk">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->training->nama }}</td>
                    <td>Rp {{ number_format($data->training->harga,0,',','.') }}</td>
                    <td>1</td>
                    <td>Rp {{ number_format($data->training->harga,0,',','.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="background: none"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        Rp {{ number_format($data->training->harga,0,',','.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
        <br/>
        <br/>
        <table style="float: left;width: 100%;">
            <tr>
                <td width="70%"></td>
                <td style="text-align:center;">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <img src="/images/ttd.png"/>
                    <br/>
                    <br/>
                    <hr/>
                    <p style="font-size: 11pt;">
                        Scoria Novrisa Dewi, S.Par., MM
                    </p>
                    <p style="font-size: 9pt;">
                        (Director)
                    </p>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
            </tr>
        </table>
        <br/>
        <br/>
        <br/>
        <br/>
        <div style="background-color: #ff4f5a;color:white; padding:20px;">
            <p style="font-size: 11pt;font-weight:bold;">
                Terms & Conditions:
            </p>
            <p style="font-size: 11pt;line-height:20pt;">
                Semua transaksi Pembayaran dilakukan dalam mata uang Rupiah Indonesia.<br/>
Konfirmasi pembayaran dapat dilakukan melalui email<br/>
personapublicspeaking@gmail.com atau melalui whatsapp 0822-1188-2728 <br/>
            </p>
            <p style="font-size: 16pt;font-weight:bold;">
                Thank you for trusting us as your training partner.
            </p>
        </div>
    </div>

</body>

</html>