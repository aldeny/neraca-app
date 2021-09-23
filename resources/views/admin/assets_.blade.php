@extends('layouts.master')

@section('title', 'Aset')

@section('konten')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Aset</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
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
                                        <table id="tbl_asset" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Kondisi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Kondisi</th>
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

    {{-- Modal Add Masuk --}}
    <div class="modal fade text-left" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="modal-title"></h5>
                    <button type="button btn-dismiss" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form-add" action="/asset/Addassets" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="nama_barang" class="font-weight-bold">Nama Barang</label>
                                <input type="hidden" name="id" id="id" class="form-control" value="">
                                <input type="hidden" name="action" id="action" class="form-control">
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jumlah_barang" class="font-weight-bold">Jumlah Barang</label>
                                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
                                            data-placement="top" data-title="Jumlah Barang">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kondisi" class="font-weight-bold">Kondisi</label>
                                        <select class="custom-select" name="kondisi" id="kondisi">
                                            <option value="">Pilih Kondisi</option>
                                            <option value="1">Baik</option>
                                            <option value="2">Rusak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="harga" class="font-weight-bold">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" data-placement="top"
                                    data-title="Harga">
                            </div>
                            <div class="form-group">
                                <label for="projectinput1" class="font-weight-bold">Total</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Total"
                                        aria-label="Amount (to the nearest dollar)" id="total" name="total" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upload" class="font-weight-bold">Upload Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="upload-file">Pilih Gambar</label>
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
    {{-- End Modal Masuk --}}

    {{-- Modal Add Detail --}}
    <div class="modal fade text-left" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="modal-title-detail"></h5>
                    <button type="button btn-dismiss" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Nama Barang</td>
                            <td class="pr-3">:</td>
                            <td id="nm_barang" class="text-bold"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Barang</td>
                            <td class="pr-3">:</td>
                            <td id="jmlh_barang" class="text-bold"></td>
                        </tr>
                        <tr>
                            <td>Kondisi</td>
                            <td class="pr-3">:</td>
                            <td id="kondisi_barang" class="text-bold"></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td class="pr-3">:</td>
                            <td id="harga_barang" class="text-bold"></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td class="pr-3">:</td>
                            <td id="total_barang" class="text-bold"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Detail --}}

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
                $("#jumlah_barang, #harga").keyup(function() {
                    var harga = $("#harga").val();
                    var jumlah = $("#jumlah_barang").val();

                    var total = parseInt(harga) * parseInt(jumlah);
                    if (!isNaN(total)) {
                        $("#total").val(total);
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
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
            $(document).ready(function() {
                $('#tbl_asset').DataTable({
                    lengthChange: true,
                    autoWidth: false,
                    serverside: true,
                    responsive: true,
                    language: {
                        url: '{{ asset('json/bhsTable.json') }}'
                    },
                    ajax: {
                        url: '{{ route('GetDataAssets') }}'
                    },
                    columns: [{
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                        },
                        {
                            data: 'nama_barang',
                            name: 'nama_barang'
                        },
                        {
                            data: 'jumlah_barang',
                            name: 'jumlah_barang'
                        },
                        {
                            data: 'harga',
                            name: 'harga'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'kondisi',
                            name: 'kondisi'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        },
                    ]
                });
            })

            /* FUnction Tambah */
            $(document).on('click', '#btn-add', function() {
                $('#modal-add').modal('show');
                $('#modal-title').html('Tambah Data Aset');
                $('.btn-action').html('Simpan');

                $('#id').val('');
                $('#nama_barang').val('');
                $('#jumlah_barang').val('');
                $('#harga').val('');
                $('#total').val('');
                $('#konsisi').val('');
                $('#gambar').val('');
                $('#action').val('tambah');
            });

            /* Jika klik edit */
            $(document).on('click', '.btn-edit', function () {
                var edit_id = $(this).data('id');
                $("#id").val("");

                $.ajax({
                    url: '/asset/Editassets/'+ edit_id,
                    dataType: "json",
                    success: function (html) {
                        $('#modal-add').modal('show');
                        $('#modal-title').html('Update Data Aset');
                        $('.btn-action').html('Update');
                        $("#id").val(html.update.id);
                        $("#nama_barang").val(html.update.nama_barang);
                        $("#jumlah_barang").val(html.update.jumlah);
                        $("#harga").val(html.update.harga);
                        $("#total").val(html.update.total);
                        $('[name="kondisi"] option[value="'+html.update.kondisi+'"]').prop('selected', true);
                        $("#action").val("edit");
                    }
                })
            });

            $(document).on('click', '.btn-detail', function () {
                var edit_id = $(this).data('id');
                $("#id").val("");

                $.ajax({
                    url: '/asset/Editassets/'+ edit_id,
                    dataType: "json",
                    success: function (html) {
                        $('#modal-detail').modal('show');
                        $('#modal-title-detail').html('Detail Data Aset');
                        $("#nm_barang").html(html.update.nama_barang);
                        $("#jmlh_barang").html(html.update.jumlah);
                        $("#harga_barang").html('Rp '+html.update.harga);
                        $("#total_barang").html('Rp '+html.update.total);
                        if (html.update.kondisi == 1) {
                            $("#kondisi_barang").html('<small class="badge badge-success">Baik</small>');
                        } else {
                            $("#kondisi_barang").html('<small class="badge badge-danger">Rusak</small>');
                        }
                    }
                })
            });

            $('#form-add').on('submit', function(e) {
                event.preventDefault();

                /* Jika simpan */
                if ($('#action').val() == "tambah") {
                    $.ajax({
                        method: "POST",
                        url: '/asset/Addassets',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $('#tbl_asset').DataTable().ajax.reload();
                            if (data.success) {
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
                            if (data.error) {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                });
                            }

                            //$("#action").val("");
                            $("#id").val("");
                            $('#modal-add').modal('hide');
                        }
                    });
                }
                if ($('#action').val() == "edit") {
                    $.ajax({
                        method: "POST",
                        url: '/asset/Updateassets',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $('#tbl_asset').DataTable().ajax.reload();
                            if (data.success) {
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
                            if (data.error) {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                });
                            }

                            //$("#action").val("");
                            $("#id").val("");
                            $('#modal-add').modal('hide');
                            $('[name="kondisi"] option[value=""]').prop('selected', true);
                        }
                    });
                }
            });

            $(document).on('click', '.btn-delete', function() {
                var table = $('#tbl_asset').DataTable();
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
                            url: "/asset/delete/" + id,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function(response) {
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

    <script>
        $(document).ready( function () {
        bsCustomFileInput.init();
        });
    </script>
    @endpush

@endsection
