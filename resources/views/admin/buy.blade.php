@extends('layouts.master')

@section('title', 'Pembelian')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1 class="m-0">Pembelian</h1>
            </div>
        </div>
    </div>
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
                            <button id="btn-print" class="btn btn-secondary" data-toggle="modal" data-target="#modal-print-buy"><i class="fas fa-print"></i> Print</button>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                            <p class="card-text"></p>
                                <div class="table-responsive">
                                <table id="tbl_buy" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Saldo</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Saldo</th>
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
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="form-add" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label for="tanggal" class="font-weight-bold">Tanggal Beli</label>
                            <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli">
                            <span class="text-danger" id="tanggal_beliError"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama_item" class="font-weight-bold">Nama Produk</label>
                            <input type="hidden" name="id" id="id" class="form-control" value="">
                            <input type="hidden" name="action" id="action" class="form-control">
                            <select id="nama_item" name="nama_item" class="form-control">
                                <option value="">Pilih Produk</option>
                                @foreach ($product as $prdct)
                                    <option value="{{ $prdct->id }}">{{ $prdct->nama_produk }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="nama_itemError"></span>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="font-weight-bold">Jumlah Produk</label>
                            <input type="number" class="form-control" id="jumlah_item" name="jumlah_item" placeholder="Jumlah Produk">
                            <span class="text-danger" id="jumlah_itemError"></span>
                        </div>
                        <div class="form-group">
                            <label for="from_saldo" class="font-weight-bold">Dari Saldo</label>
                            <select id="saldo" name="saldo" class="form-control">
                                <option value="">Pilih Saldo</option>
                                <option value="1">Saldo Kas Bank</option>
                                <option value="2">Saldo Kas Besar</option>
                                <option value="3">Saldo Kas Kecil</option>
                            </select>
                            <span class="text-danger" id="saldoError"></span>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="herga" class="font-weight-bold">Harga Beli</label>
                                    <input type="number" class="form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli">
                                </div>
                                <span class="text-danger" id="harga_beliError"></span>
                           </div>
                           <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="total" class="font-weight-bold">Total</label>
                                    <input type="text" class="form-control jum" aria-label="Amount (to the nearest dollar)" type-currency="IDR" name="total" id="total" readonly>
                                </div>
                                <span class="text-danger" id="totalError"></span>
                           </div>
                       </div>
                        <div class="form-group">
                            <label for="keterangan" class="font-weight-bold">Keterangan</label>
                            <textarea id="keterangan" rows="5" class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                        </div>
                        <span class="text-danger" id="keteranganError"></span>
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

@include('extend.modal_print_buy')

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

<script type="text/javascript">
    $(document).ready(function() {
        $("#jumlah_item, #harga_beli").keyup(function() {
            var harga  = $("#harga_beli").val();
            var jumlah = $("#jumlah_item").val();

            var total = parseInt(harga) * parseInt(jumlah);
            if (!isNaN(total)) {
                $("#total").val(total);
            }
        });
    });
</script>

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
        $('#tbl_buy').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('getDataBuy') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
            {data: 'nama_item', name: 'nama_item'},
            {data: 'jumlah_item', name: 'jumlah_item'},
            {data: 'harga_beli', name: 'harga_beli'},
            {data: 'total', name: 'total'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'saldo', name: 'saldo'},
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
        $('#nama_item').val('');
        $('#tanggal_beli').val('');
        $('#jumlah_item').val('');
        $('#harga_beli').val('');
        $('#total').val('');
        $('#keterangan').val('');
        $('#action').val('tambah');
    });

    $('#form-add').on('submit', function (e) {
        event.preventDefault();

        /* Jika simpan */
        if ($('#action').val() == "tambah") {

            $.ajax({
                method: "POST",
                url: '/buy/addData',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#tbl_buy').DataTable().ajax.reload();
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
                        $('#tanggal_beliError').text('');
                        $('#nama_itemError').text('');
                        $('#jumlah_itemError').text('');
                        $('#saldoError').text('');
                        $('#harga_beliError').text('');
                        $('#totalError').text('');
                        $('#keteranganError').text('');
                        },
                        error : function (er) {
                            $('#tanggal_beliError').text(er.responseJSON.errors.tanggal_beli);
                            $('#nama_itemError').text(er.responseJSON.errors.product_id);
                            $('#jumlah_itemError').text(er.responseJSON.errors.jumlah_item);
                            $('#saldoError').text(er.responseJSON.errors.saldo);
                            $('#harga_beliError').text(er.responseJSON.errors.harga_beli);
                            $('#totalError').text(er.responseJSON.errors.total);
                            $('#keteranganError').text(er.responseJSON.errors.keterangan);
                        }
            });
        }
    });

    $(document).on('click', '.btn-delete', function () {
        var table = $('#tbl_buy').DataTable();
        let id = $(this).data('id');
        let poduct = $(this).data('poduct');
        let jum = $(this).data('jum');
        //let name = $(this).attr('data-name')
        // alert(poduct);
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
                    url: "{{ route('delete.buy') }}",
                    data: {
                        "id": id,
                        "poduct": poduct,
                        "jum": jum,
                        "_token": token,
                    },
                    success: function (response) {
                        Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success'
                        )
                        table.ajax.reload();
                        //refreshTable();
                    },
                    error: function (err) {
                        alert(err.error);
                    }
                });
            }
        })
    });

</script>

@endpush
@endsection
