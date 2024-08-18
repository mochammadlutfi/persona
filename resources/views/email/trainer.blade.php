@component('mail::message')


<h3>
    Hello {{ $data->nama }}
</h3>
<p>
    Terima kasih telah melakukan pemesanan di Persona Public Speaking,<br/>
Dengan senang hati kami menginformasikan bahwa kami telah menerima pembayaran Anda dan kami sudah memproses Trainer yang akan mengisi acara Anda.
<br/>
Berikut adalah detail pengajuan Anda:
<br/>
Nama Instansi: <b>{{ $data->instansi }} </b><br/>
Program:  <b>{{ $data->program->nama }}</b><br/>
Tanggal Training:  <b>{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y') }}</b><br/>
Lokasi Training:  <b>{{ $data->lokasi }}</b><br/>
Trainer:  <b>{{ $data->trainer->nama }}</b><br/>
Untuk info lebih lanjut mengenai pengajuan kelas pelatihan anda, silahkan cek status di website pada menu “Pengajuan Inhouse” atau Anda bisa mengklik tombol berikut:<br/>

<br/>
<x-mail::button url="{{ route('user.request.show', $data->id)}}" color="primary">
Klik Disini
</x-mail::button>

Salam,<br/>
Persona Public Speaking<br/>

</p>
@endcomponent