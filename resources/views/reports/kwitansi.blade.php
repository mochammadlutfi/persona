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
    @page {
        size: 8.50in 10.83in;
        margin: 0px !important;
        margin-top: 0px !important;
    }

    #table-header {
        width: 100%;
        border-collapse: collapse;
        background: #f2f2f2;
    }

    #table-header th, #table-header td {
        padding: 10px;
        text-align: left;
    }

    #table-header .logo{
        max-width: 100%;
        width: 100%;
    }

    #table-header .info{
        text-align: left;
        padding: 10px;
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

    .container {
        padding: 10mm;
    }

    #table-produk {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
    }

    #table-produk th, {
        padding: 8px;
        text-align: center;
        font-size: 16pt;
        border-top: 1px solid red;
    }

    #table-produk tr{
    }

    #table-produk td {
        padding: 8px;
        text-align: left;
        font-size: 12pt;
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
    <table id="table-header">
        <tr>
            <td width="25%">
                <img src="/images/logo.png" width="190px"/>
            </td>
            <td class="info" width="50%">
                <h2 style="font-size: 12pt; font-weight:bold;">
                    CV. TRANSFORMASI AKSELERASI PRIMA
                </h1>
                <h3 style="font-size: 10pt; font-weight:bold;">
                    Persona Public Speaking
                </h2>
                <p style="font-size:10pt;">HP 0822-1188-2728</p>
                <P style="font-size:10pt;">Email: PersonaPublicSpeaking@gmail.com</P>
            </td>
            <td>
                <p style="font-size: 12pt;border-bottom:1px solid black;">KUITANSI</p>
                <p style="font-size: 12pt;">RECEIPT</p>
                <p style="font-size: 12pt;border-bottom:1px solid black;">NO</p>
                <p style="font-size: 12pt;">NUMBER</p>
            </td>
        </tr>
    </table>
    <div class="container">
        <table id="table-produk">
            <tr>
                <td width="35%">
                    <div style="border-bottom:1px solid black;">Sudah Terima Dari</div>
                    <div style="">Received From</div>
                </td>
                <td>:</td>
                <td>
                    {{ ucwords($data->user->nama)}}
                </td>
            </tr>
            <tr>
                <td>
                    <div style="border-bottom:1px solid black;">Banyaknya Uang</div>
                    <div style="">Amount Received</div>
                </td>
                <td>:</td>
                <td>
                    {{ ucwords(terbilang($data->training->harga))  }} Rupiah
                </td>
            </tr>
            <tr>
                <td>
                    <div style="border-bottom:1px solid black;">Untuk Pembayaran</div>
                    <div style="">In Payment Of</div>
                </td>
                <td>:</td>
                <td>
                    Pembayaran Pelatihan {{ ucwords($data->training->nama) }}
                </td>
            </tr>
        </table>
        <br/>
        <table width="100%">
            <tr>
                <td style="background-color: #f2f2f2; width:40%;padding:10px;">
                    <div style="font-size:20pt;font-weight:bold;">
                        Rp {{ number_format($data->training->harga,0,',','.') }},-
                    </div>
                </td>
                <td width="1%"></td>
                <td style="text-align: right">
                    Bandung, {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td style="font-size: 9pt;width:70%">
                    <p>Catatan:</p>
                    <p>Pembayaran Bisa Melalui:<br/>
                        Bank Mandiri 132-0024-213929 a.n CV. Transformasi Akselerasi Prima<br/>
                        Bukti Pembayaran <b>Wajib dikonfirmasikan</b> via email:
                        <br/>
                        <b>personapublicspeaking@gmail.com</b> atau via <b>Whatsapp ( 0822-1188-2728 )</b>
                    </p>
                </td>
                <td style="font-size: 10pt;text-align: center">
                    <br/>
                    <br/>
                    <br/>
                    <div style="border-bottom:1px solid black">Scoria Novrisa Dewi, S.Par., MM</div>
                    <div style="">Direktur</div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>