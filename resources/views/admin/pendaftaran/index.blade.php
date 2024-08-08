<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Data Pendaftaran</span>
            <div class="space-x-1">
                <button type="button" class="btn btn-sm btn-primary" onclick="addPayment()">
                    <i class="fa fa-plus me-1"></i>
                    Tambah Pendaftaran
                </button>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content p-3">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>No Pendaftaran</th>
                            <th>Peserta</th>
                            <th>Program</th>
                            <th>Tgl Daftar</th>
                            <th>Status</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            $(function () {
                $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                            "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    ajax: "{{ route('admin.payment.index') }}",
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        }, {
                            data: 'nomor',
                            name: 'nomor'
                        }, {
                            data: 'user.nama',
                            name: 'user.nama'
                        }, {
                            data: 'training.nama',
                            name: 'training.nama'
                        }, {
                            data: 'created_at',
                            name: 'created_at'
                        },  {
                            data: 'status',
                            name: 'status'
                        }, {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>

