@extends('layouts.master')

@section('title', 'Karyawan')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kas Bank</h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        {{-- DataTables Dana Masuk--}}
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button id="btn-add" class="btn btn-info"><i class="fas fa-plus-circle"></i> Tambah Data</button>
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
                            <label for="nama-karyawan" class="font-weight-bold">Nama</label>
                            <input type="hidden" name="id" id="id" class="form-control" value="">
                            <input type="hidden" name="action" id="action" class="form-control">
                            <input type="text" id="nama" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="bank" class="font-weight-bold">Jabatan</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="bank_id" name="bank_id">
                              <option value="">Pilih Jabatan</option>
                                 @foreach ($position as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="projectinput1" class="font-weight-bold">Jumlah</label>
                            <div class="input-group">
                                {{-- <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                                </div> --}}
                                <input type="text" class="form-control jum" type-currency="IDR" placeholder="Jumlah" aria-label="Amount (to the nearest dollar)" name="jumlah">
                                {{-- <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="font-weight-bold">Keterangan</label>
                            <textarea id="keterangan" rows="5" class="form-control" name="keterangan" placeholder="Keterangan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="keterangan" data-original-title="" title=""></textarea>
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

@push('js')
<!-- JS DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
{{-- <script src="{{ asset('jQuery-Mask-Plugin-1.14.16/dist/jquery.mask.min.js') }}"></script> --}}

<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

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
    $(document).ready(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });

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
                url: '{{ route('getData') }}'
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
        $('#sumber_dana').val('Kas Bank');
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
                        },
                        error : function (data) {
                            alert(data);
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
