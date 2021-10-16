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
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Tambah Data Aset Baru</h3>
                        </div>
                        <div class="card-body">
                            <form id="form-add" action="{{ route('save.asset') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="tanggal" class="font-weight-bold">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_aset" name="tanggal_aset">
                                    <span class="text-danger error-text tanggal_aset_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang" class="font-weight-bold">Nama Barang</label>
                                    <input type="hidden" name="id" id="id" class="form-control" value="">
                                    <input type="hidden" name="action" id="action" class="form-control">
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang/Aset">
                                    <span class="text-danger error-text nama_barang_error"></span>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="jumlah_barang" class="font-weight-bold">Jumlah Barang</label>
                                            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
                                                data-placement="top" data-title="Jumlah Barang" placeholder="Jumlah">
                                            <span class="text-danger error-text jumlah_barang_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="kondisi" class="font-weight-bold">Kondisi</label>
                                            <select class="custom-select" name="kondisi" id="kondisi">
                                                <option value="">Pilih Kondisi</option>
                                                <option value="1">Baik</option>
                                                <option value="2">Rusak</option>
                                            </select>
                                            <span class="text-danger error-text kondisi_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
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
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="harga" class="font-weight-bold">Harga</label>
                                            <input type="number" class="form-control" id="harga" name="harga" data-placement="top"
                                                data-title="Harga" placeholder="Harga Barang/Aset">
                                            <span class="text-danger error-text harga_error"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="projectinput1" class="font-weight-bold">Total</label>
                                                <input type="number" class="form-control" placeholder="Total"
                                                    aria-label="Amount (to the nearest dollar)" id="total" name="total" readonly>
                                                <span class="text-danger error-text total_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="upload" class="font-weight-bold">Upload Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                        <label class="custom-file-label" for="upload-file">Pilih Gambar</label>
                                        <span class="text-danger error-text gambar_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ket" class="font-weight-bold">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                </div>
                                    <button type="submit" class="btn btn-primary btn-action">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Preview Gambar Aset</h3>
                        </div>
                        <div class="card-body">
                            <div class="img-holder" id="img-hold"></div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <div class="card-text">
                                    <div class="row">
                                        <div class="col">
                                            <h4>Data Aset</h4>
                                        </div>
                                        <div class="col">
                                            <button id="btn-print" class=" float-right btn btn-secondary" data-toggle="modal" data-target="#modal-print-aset"><i class="fas fa-print"></i> Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <p class="card-text"></p>
                                    <div class="table-responsive">
                                        <table id="tbl_asset" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Gambar</th>
                                                    <th>Nama Barang</th>
                                                    <th>Tanggal</th>
                                                    <th>Saldo</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Kondisi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
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

    @include('extend.modal_print_aset')

    @include('extend.modal_aset_edit')



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

    <!-- Toastr -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

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

        $(document).ready(function() {
            $("#jumlah_barang_edit, #harga_edit").keyup(function() {
                var harga = $("#harga_edit").val();
                var jumlah = $("#jumlah_barang_edit").val();

                var total = parseInt(harga) * parseInt(jumlah);
                if (!isNaN(total)) {
                    $("#total_edit").val(total);
                }
            });
        });
    </script>

    <script>
        $(function () {
            $('#form-add').on('submit', function (e) {
                e.preventDefault();

                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData:false,
                    dataType: 'json',
                    contentType:false,
                    beforeSend: function () {
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function (prefix, val) {
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $(form)[0].reset();
                            $('#tbl_asset').DataTable().ajax.reload();
                            //toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            Toast.fire({
                                icon: 'success',
                                title: data.pesan,
                            })
                        }
                    }
                });
            });

            //reset input file
            $('input[type="file"][name="gambar"]').val('');
            //image preview
            $('input[type="file"][name="gambar"]').on('change', function () {
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

                if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                    if (typeof(FileReader) != 'undefined') {
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('<img/>', {'src': e.target.result, 'class':'img-fluid center','style':'max-width:100%;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        $(img_holder).html('Maaf browser anda tidak support FileReader');
                    }
                }else{
                    $(img_holder).html('Maaf file yang anda masukkan tidak mendukung');
                }
            })

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
                            data: 'gambar',
                            name: 'gambar'
                        },
                        {
                            data: 'nama_barang',
                            name: 'nama_barang'
                        },
                        {
                            data: 'saldo',
                            name: 'saldo'
                        },
                        {
                            data: 'tanggal_aset',
                            name: 'tanggal_aset'
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
            });

            //edit aset
            $(document).on('click', '#btn-edit', function () {
                var id_aset = $(this).data('id');
                var url = '{{ route('edit.aset') }}';

                $.get(url,{id_aset:id_aset}, function (data) {
                    //alert(data.result.nama_barang);
                    var modal_edit = $('#modal-edit');
                    $(modal_edit).modal('show');
                    $(modal_edit).find('form').find('input[name="id"]').val(data.result.id);
                    $(modal_edit).find('form').find('input[name="nama_barang"]').val(data.result.nama_barang);
                    $(modal_edit).find('form').find('input[name="tanggal_aset_edit"]').val(data.result.tanggal_beli_aset);
                    $(modal_edit).find('form').find('[name="saldo_edit"] option[value="'+data.result.saldo+'"]').prop('selected', true)
                    $(modal_edit).find('form').find('input[name="jumlah_barang_edit"]').val(data.result.jumlah);
                    $(modal_edit).find('form').find('input[name="harga_edit"]').val(data.result.harga);
                    $(modal_edit).find('form').find('input[name="total_edit"]').val(data.result.total);
                    $(modal_edit).find('form').find('[name="keterangan"]').val(data.result.keterangan);
                    $(modal_edit).find('form').find('[name="kondisi"] option[value="'+data.result.kondisi+'"]').prop('selected', true)
                    $(modal_edit).find('form').find('.img-holder-update').html('<img src="/storage/img-assets/'+data.result.gambar+'" class="img-fluid" style="max-width:100px;margin-bottom:10px;">');
                    $(modal_edit).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/img-assets/'+data.result.gambar+'" class="img-fluid" style="max-width:100px;margin-bottom:10px;">');
                    $(modal_edit).find('form').find('input[type="file"]').val('');
                    $(modal_edit).find('form').find('span.error-text').val('');
                },'json');
            });

            $('input[type="file"][name="gambar_update"]').on('change', function () {
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder-update');
                var currentImgPath = $(this).data('value');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

                if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                    if (typeof(FileReader) != 'undefined') {
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('<img/>', {'src': e.target.result, 'class':'img-fluid center','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        $(img_holder).html('Maaf browser anda tidak support FileReader');
                    }
                }else{
                    $(img_holder).html(currentImgPath);
                }
            });

            // Update aset
            $('#form-edit').on('submit', function (e) {
                e.preventDefault();

                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function () {
                        $(form).find('span.error-text').text('');
                    },
                    success:function (data){
                        if (data.code == 0) {
                            $.each(data.error, function (prefix, val) {
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $('#tbl_asset').DataTable().ajax.reload();
                            //toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
                            var modal_edit = $('#modal-edit');
                            $(modal_edit).modal('hide');
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            Toast.fire({
                                icon: 'success',
                                title: data.pesan,
                            })
                        }
                    }
                });
            });

            //delete aset
            $(document).on('click', '#btn-delete', function () {
                var aset_id = $(this).data('id');
                var url = '{{ route("delete.aset") }}';
                var table = $('#tbl_asset').DataTable();

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
                        $.ajax({
                            method: 'post',
                            url: url,
                            data: {
                                "aset_id": aset_id,
                                "_token": token,
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.code == 1) {
                                    var Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    Toast.fire({
                                        icon: 'success',
                                        title: data.pesan,
                                    })
                                    table.ajax.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Terjadi kesalahan',
                                    })
                                }
                            }
                        });
                    }
                })
            })
        })
    </script>

    <script>
        $(document).ready( function () {
        bsCustomFileInput.init();
        });
    </script>

    @endpush

@endsection
