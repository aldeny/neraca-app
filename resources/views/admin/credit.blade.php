@extends('layouts.master')

@section('title', 'Credit')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Credit</h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        {{-- DataTables --}}
        <section id="configuration">
          <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-header">
                        <button type="button" class="btn btn-success" data-toggle="modal" id="btn-add-credit">
                            <i class="fas fa-plus-circle"></i>
                            Tambah Data
                        </button>
                        <button id="btn-print" class=" float-right btn btn-secondary" data-toggle="modal" data-target="#modal-print-credit"><i class="fas fa-print"></i> Print</button>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl-credit" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Beli</th>
                                    <th>Saldo</th>
                                    <th>Harga</th>
                                    <th>Bayar</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Beli</th>
                                    <th>Saldo</th>
                                    <th>Harga</th>
                                    <th>Bayar</th>
                                    <th>Sisa</th>
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

        {{-- DataTables --}}
        <section id="configuration">
            <div class="row">
              <div class="col-12">
              <div class="card">
                  <div class="card-content collapse show">
                      <div class="card-header">
                          <h3 class="float-left">Histori Pembayaran</h3>
                          <button id="btn-print" class=" float-right btn btn-secondary" data-toggle="modal" data-target="#modal-print-credit-history"><i class="fas fa-print"></i> Print</button>
                      </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table id="tbl-credit-histori" class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama Barang</th>
                                      <th>Tanggal Bayar</th>
                                      <th>Saldo</th>
                                      <th>Bayar</th>
                                      <th>Keterangan</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama Barang</th>
                                      <th>Tanggal Bayar</th>
                                      <th>Saldo</th>
                                      <th>Bayar</th>
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


<div class="modal fade text-left" id="modal-add-credit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="modal-title"></h5>
                <button type="button btn-dismiss" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="form-add-credit" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama-barang" class="font-weight-bold">Nama Barang</label>
                                    <input type="hidden" name="id" id="id" class="form-control" value="">
                                    <input type="hidden" name="action" id="action" class="form-control">
                                    <input type="text" id="nama_item" class="form-control" name="nama_item" placeholder="Nama Barang">
                                    <span class="text-danger" id="nama_itemError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal-beli" class="font-weight-bold">Tanggal Beli</label>
                                    <input type="date" class="form-control" name="tanggal_beli" id="tanggal_beli">
                                    <span class="text-danger" id="tanggal_beliError"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="harga-barang" class="font-weight-bold">Harga</label>
                                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga Barang">
                                    <span class="text-danger" id="hargaError"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="bayar" class="font-weight-bold">Bayar</label>
                                    <input type="text" class="form-control" name="jumlah_bayar" id="jumlah_bayar" placeholder="Bayar">
                                    <span class="text-danger" id="jumlah_bayarError"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sisa-bayar" class="font-weight-bold">Sisa</label>
                                    <input type="text" class="form-control" name="sisa" id="sisa" placeholder="Sisa" readonly>
                                    <span class="text-danger" id="sisaError"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="saldo" class="font-weight-bold">Saldo</label>
                                    <select class="custom-select" name="saldo" id="saldo">
                                        <option value="">--Pilih Kondisi--</option>
                                        <option value="1">Saldo Kas Bank</option>
                                        <option value="2">Saldo Kas Besar</option>
                                        <option value="3">Saldo Kas Kecil</option>
                                    </select>
                                    <span class="text-danger error-text saldo_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="keterangan-bayar" class="font-weight-bold">Keterangan</label>
                                    <textarea class="form-control" name="ket_bayar" id="ket_bayar" placeholder="Keterangan"></textarea>
                                    <span class="text-danger" id="ket_bayarError"></span>
                                </div>
                            </div>
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

@include('extend.sisa_credit')

@include('extend.modal_print_history')

@include('extend.modal_print_credit')


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
        $("#harga, #jumlah_bayar").keyup(function() {
            var harga = $("#harga").val();
            var jum  = $("#jumlah_bayar").val();
            var total = parseInt(harga) - parseInt(jum);
            if (!isNaN(total)) {
                $("#sisa").val(total);
            }
        });
    });
</script>

<script>

    /* Datatables */
    $(document).ready(function () {
        $('#tbl-credit').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('credit.get') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
                {data: 'nama_item', name: 'nama_item'},
                {data: 'tanggal_beli', name: 'tanggal_beli'},
                {data: 'saldo', name: 'saldo'},
                {data: 'harga', name: 'harga'},
                {data: 'jumlah_bayar', name: 'jumlah_bayar'},
                {data: 'sisa', name: 'sisa'},
                {data: 'ket_bayar', name: 'ket_bayar'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    });

    $(document).ready(function () {
        $('#tbl-credit-histori').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('history.credit.get') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
                {data: 'nama_barang', name: 'nama_barang'},
                {data: 'tanggal_bayar', name: 'tanggal_bayar'},
                {data: 'saldo_histori', name: 'saldo_histori'},
                {data: 'sisa_bayar', name: 'sisa_bayar'},
                {data: 'keterangan_histori', name: 'keterangan_histori'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    });

    /* FUnction Tambah */
    $(document).on('click', '#btn-add-credit', function () {
        $('#modal-add-credit').modal('show');
        $('.modal-title').html('Tambah Data');
        $('.btn-action').html('Simpan');

        $('#id').val('');
        $('#nama_item').val('');
        $('#tanggal_beli').val('');
        $('#harga').val('');
        $('#jumlah_bayar').val('');
        $('#sisa').val('');
        $('#ket_bayar').val('');
        $('#action').val('tambah');
    });

    /* Function Edit */
    $(document).on('click', '.btn-edit', function () {
        let edit_id = $(this).data('id');

        $('.btn-action').html('Update');
        $('#add-produk').modal('show');
        $('.modal-title').html('Update Data Produk');
        $('#id').val('');
        $('#nama_produk').val('');
        document.getElementById("jumlah_produk").readOnly = true;

        $.ajax({
            url: "/product/getData/"+edit_id,
            dataType: "json",
            success: function (html) {
                $("#id").val(html.product.id);
                $("#nama_produk").val(html.product.nama_produk);
                $("#jumlah_produk").val(html.product.qty);
                $("#action").val('edit');
            }
        });
    });

    /* Function Sisa */
    $(document).on('click', '.btn-sisa', function () {
        let sisa_id = $(this).data('id');
        let sisa = $(this).data('sisa');
        // alert(sisa);
        // alert(sisa_id);

        $('#modal-add-sisa').modal('show');
        $('.modal-title').html('Bayar sisa credit');
        $('.btn-action').html('Bayar');

        $('#id_sisa').val('');
        $('#tanggal_bayar_sisa').val('');
        $('#jumlah_bayar_sisa').val('');
        $('#action').val('bayar');

        $.ajax({
            url: "/credit/GetCredit/"+sisa_id,
            dataType: "json",
            success: function (html) {
                $("#id_sisa").val(html.credit.id);
                $('#tanggal_bayar_sisa').val('');
                $('#jumlah_bayar_sisa').val('');
                $("#action").val('bayar');

                $('#sisaNamaItem').html(html.credit.nama_item);
                $('#sisaTanggalBeli').html(html.credit.tanggal_beli);
                $('#sisaHarga').html(html.credit.harga);
                $('#sisaSisa').html(html.credit.sisa);
                if (html.credit.saldo == 1) {
                    $('#sisaSaldo').html('Kas Bank');
                }
                else if(html.credit.saldo == 2)
                {
                    $('#sisaSaldo').html('Kas Besar');
                }
                else {
                    $('#sisaSaldo').html('Kas Kecil');
                }
                $('#sisaKetBayar').html(html.credit.ket_bayar);

            }
        });
    });

    $('#form-add-credit').on('submit', function (e) {
        event.preventDefault();

        /* Jika simpan */
        if ($('#action').val() == "tambah") {

            $.ajax({
                method: "POST",
                url: "{{ route('credit.add') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#tbl-credit').DataTable().ajax.reload();
                    $('#tbl-credit-histori').DataTable().ajax.reload();
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
                        $('#modal-add-credit').modal('hide');
                        $('#nama_itemError').val('');
                        $('#tanggal_beliError').val('');
                        $('#hargaError').val('');
                        $('#jumlah_bayarError').val('');
                        $('#sisaError').val('');
                        },
                        error: function (error) {
                            $('#nama_itemError').text(error.responseJSON.errors.nama_item);
                            $('#tanggal_beliError').text(error.responseJSON.errors.tanggal_beli);
                            $('#hargaError').text(error.responseJSON.errors.harga);
                            $('#jumlah_bayarError').text(error.responseJSON.errors.jumlah_bayar);
                            $('#sisaError').text(error.responseJSON.errors.sisa);
                        }
            });
        }
        if ($('#action').val() == "edit") {
            $.ajax({
                method: "POST",
                url: "{{ route('product.add.update') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#tbl-product').DataTable().ajax.reload();
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
                        $('#add-produk').modal('hide');
                        },
                        error : function (data) {
                            alert(data.error);
                        }
            });
        }
    });

    $('#form-sisa-credit').on('submit', function (e) {
        event.preventDefault();

        if ($('#action').val() == "bayar") {
            $.ajax({
                method: "POST",
                url: "{{ route('pay.credit') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#tbl-credit').DataTable().ajax.reload();
                    $('#tbl-credit-histori').DataTable().ajax.reload();
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
                        $('#modal-add-sisa').modal('hide');
                        },
                        error : function (data) {
                            alert(data.error);
                        }
            });
        }
    });

    $(document).on('click', '.btn-delete', function () {
        var table = $('#tbl-credit').DataTable();
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
                    url: "/credit/delete/"+id,
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response) {
                        table.ajax.reload();
                        if(response.success){
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
                                title: response.success
                            });
                        }
                        if(response.error){
                            Toast.fire({
                                icon: 'error',
                                title: response.error
                            });
                        }
                    },
                    error: function (err) {
                        alert('eror');
                     }
                });
            }
        })
    });

    $(document).on('click', '.btn-delete-histori', function () {
        var table = $('#tbl-credit-histori').DataTable();
        var table_credit = $('#tbl-credit').DataTable();
        let id = $(this).data('id');
        let sisa = $(this).data('sisa');
        let credit = $(this).data('credit');
        //let name = $(this).attr('data-name')
        // alert(id);
        // alert(sisa);
        // alert(credit);
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
                    url: "{{ route('delete.histori') }}",
                    data: {
                        "id": id,
                        "_token": token,
                        "sisa": sisa,
                        "credit": credit,
                    },
                    success: function (response) {
                        table.ajax.reload();
                        table_credit.ajax.reload();
                        if(response.success){
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
                                title: response.success
                            });
                        }
                        if(response.error){
                            Toast.fire({
                                icon: 'error',
                                title: response.error
                            });
                        }
                    },
                    error: function (err) {
                        alert('eror');
                     }
                });
            }
        })
    });

</script>

@endpush

@endsection
