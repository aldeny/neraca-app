@extends('layouts.master')

@section('title', 'Karyawan')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Karyawan</h1>
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
                                <table id="tbl_employee" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>Gaji</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>Gaji</th>
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

<!-- Table Riwayat Gaji -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Riwayat Gaji Karyawan</h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container-fluid">
      <section id="configuration">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <div class="card-header bg-info">
                        <button id="btn-print" class=" float-right btn btn-secondary" data-toggle="modal" data-target="#modal-print-employee"><i class="fas fa-print"></i> Print</button>
                    </div>
                      <div class="card-content collapse show">
                          <div class="card-body card-dashboard">
                          <p class="card-text"></p>
                              <div class="table-responsive">
                              <table id="tbl_riwayat" class="table table-striped">
                                  <thead>
                                  <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Gaji</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                  </tr>
                                  </thead>
                                  <tfoot>
                                  <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Gaji</th>
                                        <th>Tanggal</th>
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
                            <input type="date" class="form-control" name="tanggal_kar" id="tanggal_kar">
                            <span class="text-danger" id="tanggal_karError"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama-karyawan" class="font-weight-bold">Nama</label>
                            <input type="hidden" name="id" id="id" class="form-control" value="">
                            <input type="hidden" name="action" id="action" class="form-control">
                            <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                            <span class="text-danger" id="namaError"></span>
                        </div>
                        <div class="form-group">
                            <label for="jbtn" class="font-weight-bold">Jabatan</label>
                            <select class="form-control" id="jabatan" name="jabatan">
                              <option value="">--Pilih Jabatan--</option>
                                 @foreach ($position as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->jabatan }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="jabatanError"></span>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jk" class="font-weight-bold">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                      <option value="">--Pilih Jenis Kelamin--</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">perempuan</option>
                                    </select>
                                    <span class="text-danger" id="jenis_kelaminError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sts" class="font-weight-bold">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">--Pilih Status--</option>
                                        <option value="1">K/...</option>
                                        <option value="2">TK/0</option>
                                        <option value="3">TK/1</option>
                                    </select>
                                    <span class="text-danger" id="statusError"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="upah-gaji" class="font-weight-bold">Gaji Pokok</label>
                            <input type="text" class="form-control" name="gaji" id="gaji" type-currency="IDR" placeholder="Gaji">
                            <span class="text-danger" id="gajiError"></span>
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

@include('extend.modal_print_employee')

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
    /* Select2 */
    $(document).ready(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });

    /* Curency */
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

    /* Datatables Employee */
    $(document).ready(function () {
        $('#tbl_employee').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('get.data.employee') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
                {data: 'nama', name: 'nama'},
                {data: 'jabatan', name: 'jabatan'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'status', name: 'status'},
                {data: 'gaji', name: 'gaji'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    })

    /* Datatables Riwayat */
    $(document).ready(function () {
        $('#tbl_riwayat').DataTable({
            lengthChange: true,
            autoWidth: false,
            serverside: true,
            responsive: true,
            language: {
                url: '{{ asset('json/bhsTable.json') }}'
            },
            ajax: {
                url: '{{ route('report.payment') }}'
            },
            columns: [{
                "data" : null, "sortable" : false,
                render: function(data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                },
            },
                {data: 'nama', name: 'nama'},
                {data: 'gaji', name: 'gaji'},
                {data: 'created_at', name: 'created_at'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    })

    /* FUnction Tambah */
    $(document).on('click', '#btn-add', function () {
        $('#modal-add').modal('show');
        $('#modal-title').html('Tambah Karyawan');
        $('.btn-action').html('Simpan');

        $('#id').val('');
        $('#nama_lengkap').val('');
        $('#tanggal_kar').val('');
        $('#jabatan').val('');
        $('#jenis_kelamin').val('');
        $('#status').val('');
        $('#gaji').val('');
        $('#action').val('tambah');
    });

    /* Function Gaji */
    $(document).on('click', '.btn-gaji', function () {
        let gaji_id = $(this).data('id');

        $('#modal-add').modal('show');
        $('.modal-title').html('Bayar gaji karyawan');
        $('.btn-action').html('Bayar');

        $('#id').val('');
        $('#tanggal_kar').val('');
        document.getElementById("nama_lengkap").readOnly = true;
        document.getElementById("jabatan").readOnly = true;
        document.getElementById("jenis_kelamin").disabled = true;
        document.getElementById("status").disabled = true;
        document.getElementById("gaji").readOnly = true;
        $('#action').val('bayar');

        $.ajax({
            url: "/employee/GetEmployee/"+gaji_id,
            dataType: "json",
            success: function (html) {
                $("#id").val(html.emplo.id);
                $("#tanggal_kar").val(html.emplo.tanggal);
                $('#nama_lengkap').val(html.emplo.nama);
                $('[name="jenis_kelamin"] option[value="'+html.emplo.jenis_kelamin+'"]').prop('selected', true);
                $('[name="status"] option[value="'+html.emplo.status+'"]').prop('selected', true);
                $("#e2 option:selected").text();
                $('[name="jabatan"] option[value="'+html.emplo.position_id+'"]').prop('selected', true);
                $('#gaji').val(html.emplo.gaji);
                $("#action").val('bayar');
            }
        });
    });

     /* Function Gaji */
     $(document).on('click', '.btn-edit', function () {
        let gaji_id = $(this).data('id');

        $('#modal-add').modal('show');
        $('.modal-title').html('Edit Data karyawan');
        $('.btn-action').html('Update');

        $('#id').val('');
        $('#nama_lengkap').val('');
        $('#tanggal_kar').val('');
        $('#jabatan').val('');
        $('#jenis_kelamin').val('');
        $('#status').val('');
        $('#gaji').val('');
        $('#action').val('edit');

        $.ajax({
            url: "/employee/GetEmployee/"+gaji_id,
            dataType: "json",
            success: function (html) {
                $("#id").val(html.emplo.id);
                $('#nama_lengkap').val(html.emplo.nama);
                $('#tanggal_kar').val(html.emplo.tanggal);
                $('[name="jenis_kelamin"] option[value="'+html.emplo.jenis_kelamin+'"]').prop('selected', true);
                $('[name="status"] option[value="'+html.emplo.status+'"]').prop('selected', true);
                $("#e2 option:selected").text();
                $('[name="jabatan"] option[value="'+html.emplo.position_id+'"]').prop('selected', true);
                $('#gaji').val(html.emplo.gaji);
                $("#action").val('edit');
            }
        });
    });

    $('#form-add').on('submit', function (e) {
        event.preventDefault();

        /* Jika simpan */
        if ($('#action').val() == "tambah") {

            $.ajax({
                method: "POST",
                url: "{{ route('save.employee') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data){
                    $('#tbl_employee').DataTable().ajax.reload();
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
                    $('#namaError').text('');
                    $('#tanggal_karError').text('');
                    $('#jabatanError').text('');
                    $('#jenis_kelaminError').text('');
                    $('#statusError').text('');
                    $('#gajiError').text('');
                },
                error: function (error) {
                    $('#namaError').text(error.responseJSON.errors.nama);
                    $('#tanggal_karError').text(error.responseJSON.errors.tanggal);
                    $('#jabatanError').text(error.responseJSON.errors.jabatan);
                    $('#jenis_kelaminError').text(error.responseJSON.errors.jenis_kelamin);
                    $('#statusError').text(error.responseJSON.errors.status);
                    $('#gajiError').text(error.responseJSON.errors.gaji);
                }
            });
        }

        if ($('#action').val() == "bayar") {
            $.ajax({
                method: "POST",
                url: "{{ route('pay.employee') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data){
                    $('#tbl_riwayat').DataTable().ajax.reload();
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
                    $('#namaError').text('');
                    $('#tanggal_karError').text('');
                    $('#jabatanError').text('');
                    $('#jenis_kelaminError').text('');
                    $('#statusError').text('');
                    $('#gajiError').text('');
                },
                error: function (error) {
                    $('#namaError').text(error.responseJSON.errors.nama);
                    $('#tanggal_karError').text(error.responseJSON.errors.tanggal);
                    $('#jabatanError').text(error.responseJSON.errors.jabatan);
                    $('#jenis_kelaminError').text(error.responseJSON.errors.jenis_kelamin);
                    $('#statusError').text(error.responseJSON.errors.status);
                    $('#gajiError').text(error.responseJSON.errors.gaji);
                }
            });
        }

        if ($('#action').val() == "edit") {
            $.ajax({
                method: "POST",
                url: "{{ route('update.employee') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data){
                    $('#tbl_employee').DataTable().ajax.reload();
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
                    $('#namaError').text('');
                    $('#jabatanError').text('');
                    $('#jenis_kelaminError').text('');
                    $('#statusError').text('');
                    $('#gajiError').text('');
                },
                error: function (error) {
                    $('#namaError').text(error.responseJSON.errors.nama);
                    $('#jabatanError').text(error.responseJSON.errors.jabatan);
                    $('#jenis_kelaminError').text(error.responseJSON.errors.jenis_kelamin);
                    $('#statusError').text(error.responseJSON.errors.status);
                    $('#gajiError').text(error.responseJSON.errors.gaji);
                }
            });
        }
    });

    $(document).on('click', '.btn-delete', function () {
        var table = $('#tbl_employee').DataTable();
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
                    url: "/employee/EmployeeDel/"+id,
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
                        // $('#count').load(' #count');
                        //refreshTable();
                    }
                });
            }
        })
    });

    $(document).on('click', '.btn-delete-riwayat', function () {
        var table = $('#tbl_riwayat').DataTable();
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
                    url: "/employee/PaymentDel/"+id,
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response) {
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
