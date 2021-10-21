@extends('layouts.master')

@section('title', 'Kas Besar')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kas Besar</h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-12 col-lg-5 col-md-12 text-center">
            <div class="card bg-success shadow-md">
                <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <h2 id="count" class=" text-bold-700 card-text white">{{ $count }}</h2>
                </div>
                </div>
            </div>
            </div>
        </div>
        {{-- DataTables Dana Masuk--}}
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button id="btn-add" class="btn btn-info"><i class="fas fa-plus-circle"></i> Tambah Data</button>
                            <button id="btn-print" class="btn btn-secondary" data-toggle="modal" data-target="#modal-print-kas-besar"><i class="fas fa-print"></i> Print</button>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                            <p class="card-text"></p>
                                <div class="table-responsive">
                                <table id="tbl_kas" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Dana</th>
                                        <th>Sumber Dana</th>
                                        <th>Bank</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Dana</th>
                                        <th>Sumber Dana</th>
                                        <th>Bank</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

{{-- Modal Add Masuk--}}
<div class="modal fade text-left" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="modal-title"></h5>
                <button type="button btn-dismiss" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="form-add" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label for="tanggal" class="font-weight-bold">Tanggal</label>
                            <input type="hidden" name="id" id="id" class="form-control" value="">
                            <input type="hidden" name="action" id="action" class="form-control">
                            <input type="date" id="tanggal" class="form-control" name="tanggal">
                            <span class="text-danger" id="tanggalError"></span>
                        </div>
                        <div class="form-group">
                            <label for="dana" class="font-weight-bold">Dana</label>
                            <input type="text" class="form-control" id="dana" name="dana" data-placement="top" data-title="Dana" value="masuk" readonly>
                        </div>
                        <div class="form-group">
                            <label for="sumber-dana" class="font-weight-bold">Sumber Dana</label>
                            <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" data-placement="top" data-title="Sumber Dana" value="Sumber Dana" readonly>
                        </div>
                        <div class="form-group">
                            <label for="bank" class="font-weight-bold">Bank</label>
                            <select id="bank_id" name="bank_id" class="form-control">
                                <option value="">Pilih Bank</option>
                                @foreach ($bank as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->nama_bank }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="bank_idError"></span>
                        </div>
                        <div class="form-group">
                            <label for="projectinput1" class="font-weight-bold">Jumlah</label>
                            <div class="input-group">
                                <input type="text" class="form-control jum" type-currency="IDR" placeholder="Jumlah" aria-label="Amount (to the nearest dollar)" name="jumlah" id="jumlah">
                            </div>
                            <span class="text-danger" id="jumlahError"></span>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="font-weight-bold">Keterangan</label>
                            <textarea id="keterangan" rows="5" class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                            <span class="text-danger" id="keteranganError"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-action"></button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Masuk--}}

@include('extend.modal_print_kas_besar')

@push('js')
<!-- JS DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
{{-- <script src="{{ asset('jQuery-Mask-Plugin-1.14.16/dist/jquery.mask.min.js') }}"></script> --}}

<!-- DataTables  & Plugins -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script>
    $(document).ready(function(){
        // $('.jum').mask('000.000.000', {reverse:true});
        document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
        element.addEventListener('keyup', function(e) {
        let cursorPostion = this.selectionStart;
            let value = parseInt(this.value.replace(/[^,\d]/g, ''));
            let originalLenght = this.value.length;
            if (isNaN(value)) {
            this.value = "";
            } else {
            this.value = value.toLocaleString('id-ID', {
                currency: 'IDR',
                style: 'currency',
                minimumFractionDigits: 0
            });
            cursorPostion = this.value.length - originalLenght + cursorPostion;
            this.setSelectionRange(cursorPostion, cursorPostion);
            }
        });
        });
    });

    /* Datatables Masuk */
    $(document).ready(function () {
        $('#tbl_kas').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('getDataBigCash') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
                {data: 'tanggal', name: 'tanggal'},
                {data: 'dana', name: 'dana'},
                {data: 'sumber_dana', name: 'sumber_dana'},
                {data: 'bank_id', name: 'bank_id'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    })

    /* FUnction Tambah */
    $(document).on('click', '#btn-add', function () {
        $('#modal-add').modal('show');
        $('#modal-title').html('Tambah Data Masuk');
        $('.btn-action').html('Simpan');

        $('#id').val('');
        $('#tanggal').val('');
        $('#dana').val('Masuk');
        $('#sumber_dana').val('Kas Besar');
        $('#bank_id').val('');
        $('#jumlah').val('');
        $('#keterangan').val('');
        $('#action').val('tambah');
    });

    $('#form-add').on('submit', function (e) {
        event.preventDefault();

        /* Jika simpan */
        if ($('#action').val() == "tambah") {

            $.ajax({
                method: "POST",
                url: '/kas/add',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#tbl_kas').DataTable().ajax.reload();
                    $('#count').load(' #count');
                        if(data.success){
                                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });
                        }
                        if(data.error){
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }

                        //$("#action").val("");
                        $("#id").val("");
                        $('#modal-add').modal('hide');
                        $('#tanggalError').text('');
                        $('#bank_idError').text('');
                        $('#jumlahError').text('');
                        $('#keteranganError').text('');
                        },
                        error : function (er) {
                            $('#tanggalError').text(er.responseJSON.errors.tanggal);
                            $('#bank_idError').text(er.responseJSON.errors.bank_id);
                            $('#jumlahError').text(er.responseJSON.errors.jumlah);
                            $('#keteranganError').text(er.responseJSON.errors.keterangan);
                        }
            });
        }
    });

    $(document).on('click', '.btn-delete', function () {
        var table = $('#tbl_kas').DataTable();
        let id = $(this).data('id');
        //let name = $(this).attr('data-name')
        //alert(id);
        var token = $("meta[name='csrf-token']").attr("content");
        //alert(token);

        Swal.fire({
        title: 'Kamu yakin?',
        text: "Data akan dihapus secara permanen loh...",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // window.location = "/super/delete/"+id+""

                $.ajax({
                    type: "post",
                    url: "/kas/delete/"+id,
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response) {
                        Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success'
                        )
                        table.ajax.reload();
                        $('#count').load(' #count');
                        //refreshTable();
                    }
                });
            }
        })
    });

</script>

@endpush

@endsection
