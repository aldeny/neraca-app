@extends('layouts.master')

@section('title', 'Inventori')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Inventori</h1>
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
                        <button type="button" class="btn btn-success" data-toggle="modal" id="btn-add-produk">
                            Tambah Produk
                        </button>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl-product" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
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
    </div>
  </div>
</section>

<div class="modal fade" id="add-produk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form" id="form-produk" method="POST">
                @csrf
                <div class="form-body">
                    <div class="form-group">
                    <label for="nama-produk" class="font-weight-bold">Nama Produk</label>
                    <input type="hidden" name="id" id="id" class="form-control" value="">
                    <input type="hidden" name="action" id="action" class="form-control">
                    <span class="text-danger">@error('nama_produk') {{ $message }} @enderror</span>
                    <input type="text" id="nama_produk" class="form-control" name="nama_produk" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Produk" data-original-title="" title="" placeholder="Nama Produk">
                    </div>
                    <div class="form-group">
                        <label for="jumlah-produk" class="font-weight-bold">Jumlah Produk</label>
                        <span class="text-danger">@error('nama_produk') {{ $message }} @enderror</span>
                        <input type="text" id="jumlah_produk" class="form-control" name="jumlah_produk" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Jumlah Produk" data-original-title="" title="" placeholder="Jumlah Produk">
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-action btn-sm">Simpan</button>
                </div>
            </form>
      </div>
    </div>
</div>

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

    /* Datatables */
    $(document).ready(function () {
        $('#tbl-product').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('product.GetData') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'qty', name: 'qty'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    });

    /* FUnction Tambah */
    $(document).on('click', '#btn-add-produk', function () {
        $('#add-produk').modal('show');
        $('.modal-title').html('Tambah Data Produk');
        $('.btn-action').html('Simpan');

        $('#id').val('');
        $('#nama_produk').val('');
        document.getElementById("jumlah_produk").disabled = true;
        $('#action').val('tambah');
    });

    /* Function Tambah */
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

    $('#form-produk').on('submit', function (e) {
        event.preventDefault();

        /* Jika simpan */
        if ($('#action').val() == "tambah") {

            $.ajax({
                method: "POST",
                url: "{{ route('product.add') }}",
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

    $(document).on('click', '.btn-delete', function () {
        var table = $('#tbl-product').DataTable();
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
                    url: "/product/delete/"+id,
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

</script>

@endpush

@endsection
