<x-app-layout>
    <div class="content">
        <div class="content-heading d-flex justify-content-between align-items-center">
            <span>Data Pendaftaran</span>
            <div class="space-x-1">
                {{-- <button type="button" class="btn btn-sm btn-primary" onclick="addPayment()">
                    <i class="fa fa-plus me-1"></i>
                    Tambah Pendaftaran
                </button> --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalReport">
                    <i class="fa fa-print"></i>
                    Report
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
    
    <!-- Modal -->
    <div class="modal fade" id="modalReport" tabindex="-1" aria-labelledby="modalReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.payment.report') }}" method="GET">
                    <div class="block block-rounded shadow-none mb-0">
                        <div class="block-header">
                            <h3 class="block-title " id="modalFormTitle">Download Report</h3>
                            <div class="block-options">
                                <button type="button" class=" btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <x-input-field type="text" name="tgl" id="tgl" label="Periode Tanggal"/> 
                        </div>
                        <div class="block-content block-content-full block-content-sm text-end border-top">
                            <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                              Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Download
                            </button>
                          </div>
                    </div>
                </form>
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
        $("#field-tgl").flatpickr({
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            locale : "id",
            defaultDate: [new Date(Date.now() - 7 * 24 * 60 * 60 * 1000), new Date()],
            mode: "range"
        });
        
        </script>
    @endpush

</x-app-layout>

