@extends('layouts.master')

@section('title', 'Jabatan')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Jabatan</h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-lg-8 col-md-12">
        {{-- DataTables --}}
        <section id="configuration">
          <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl_jabatan" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
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
      <div class="col-12 col-lg-4 col-md-12">
        <div class="card shadow-md card-add">
          <div class="card-content collapse show" aria-expanded="true">
            <div class="card-header bg-success white">
              <i class="la la-plus-circle"></i>
              Tambah Data Jabatan
            </div>
            <div class="card-body">
              <form class="form" id="form-jabatan" method="POST">
                @csrf
                <div class="form-body">
                  <div class="form-group">
                    <label for="nama_jabatan" class="font-weight-bold">Nama Jabatan</label>
                    <input type="hidden" name="id" id="id" class="form-control" value="">
                    <input type="hidden" name="action" id="action" class="form-control">
                    <input type="text" id="jabatan" class="form-control" name="jabatan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Jabatan" data-original-title="" title="" placeholder="Nama Jabatan">
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
      </div>
    </div>
  </div>
</section>


@push('js')
<!-- JS DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
{{-- <script src="{{ asset('jQuery-Mask-Plugin-1.14.16/dist/jquery.mask.min.js') }}"></script> --}}

<!-- Toastr -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

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
        $('#tbl_jabatan').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('getDataPosition') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
                {data: 'jabatan', name: 'jabatan'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    });

    /* Function Tambah */
    $(document).on('click', '.btn-edit', function () {
        let edit_id = $(this).data('id');
        $('.btn-action').html('Update');

        $('#id').val('');
        $('#jabatan').val('');

        $.ajax({
            url: "/position/getData/"+edit_id,
            dataType: "json",
            success: function (html) {
                $("#id").val(html.jabatan.id);
                $("#jabatan").val(html.jabatan.jabatan);
                $("#action").val('edit');
            }
        });
    });

    $('#form-jabatan').on('submit', function (e) {
        event.preventDefault();

        $('#action').val('edit');

        /* Jika simpan */
        if ($('#id').val() == "") {
            $('#action').val('tambah');//Pengalihan isu wkwkwk
                $.ajax({
                    method: "POST",
                    url: '{{ route('add.position') }}',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#tbl_jabatan').DataTable().ajax.reload();
                        //$('#count').load(' #count');
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
                            $('#jabatan').val('');
                            $('#action').val('');
                    },
                    // Validasi jika terjadi error
                    error: function (err) {
                        let err_log = err.responseJSON.errors;
                        //console.log(err.responseJSON.errors.jabatan[0]);
                        //console.log(err_log);
                        const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    width: '20rem',
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                        })

                        if (err.status == 422) {
                            // $('.card-add').find('[name="jabatan"]').prev().html('<br><span class="text-danger">'+err_log.jabatan[0]+'</span>')
                            Toast.fire({
                                    icon: 'error',
                                    title: err_log.jabatan[0]
                                });
                            //console.log(err_log.jabatan[0]);
                        }
                        // else{
                        //     $('.card-add').find('[name="jabatan"]').prev().html('""')
                        // }
                    }
                });
        }
        /* Jika Update */
        if ($('#action').val() == "edit") {

            $.ajax({
                method: "POST",
                url: '{{ route('update.position') }}',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#tbl_jabatan').DataTable().ajax.reload();
                    //$('#count').load(' #count');
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
                        $('#jabatan').val('');
                        $('#action').val('');
                        $('.btn-action').html('Simpan');

                },
                // Validasi jika terjadi error
                error: function (err) {
                    let err_log = err.responseJSON.errors;
                    //console.log(err.responseJSON.errors.jabatan[0]);
                    //console.log(err_log);
                    const Toast = Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000,
                                width: '20rem',
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                    })

                    if (err.status == 422) {
                        // $('.card-add').find('[name="jabatan"]').prev().html('<br><span class="text-danger">'+err_log.jabatan[0]+'</span>')
                        Toast.fire({
                                icon: 'error',
                                title: err_log.jabatan[0]
                            });
                        //console.log(err_log.jabatan[0]);
                    }
                    // else{
                    //     $('.card-add').find('[name="jabatan"]').prev().html('""')
                    // }
                }
            });
        }
    });

    /* Tombol Delete */
    $(document).on('click', '.btn-delete', function () {
        var table = $('#tbl_jabatan').DataTable();
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
                    url: "/position/delete/"+id,
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response) {
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
                                title: 'Data berhasil dihapus'
                            });
                        table.ajax.reload();
                        //refreshTable();
                    }
                });
            }
        })
    });

</script>

@endpush

@endsection
