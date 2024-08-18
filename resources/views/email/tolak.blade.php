<x-mail::message>

<h3>
    Hello {{ $data->user->nama }}
</h3>
<p>
    Dengan ini kami menginformasikan bahwa pemesanan Anda untuk Pengajuan Inhouse Training <b>
    [{{ $data->instansi }} – {{ $data->program->nama }} – {{ $data->lokasi }} – {{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y') }}]</b> tidak bisa kami proses lebih lanjut.<br/><br/>
Pengajuan Anda belum dapat kami lanjutkan dikarenakan tidak sesuai dengan syarat & ketentuan pengajuan kelas pelatihan kami.<br/>
Kami mohon maaf sekali lagi atas ketidaknyamanan yang terjadi.<br/>
Untuk melihat status pengajuan Anda, silahkan kunjungi halaman <br/>

<x-mail::button url="{{ route('user.request.show', $data->id)}}" color="primary">
Klik Disini
</x-mail::button>
<br/>
Kami senang melayani {{ $data->user->nama }}<br/>
Semoga harinya menyenangkan. <br/>
Terima Kasih.
</p>
</x-mail::message>