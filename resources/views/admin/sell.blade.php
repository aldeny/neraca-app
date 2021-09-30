@extends('layouts.master')

@section('title', 'Penjualan')

@section('konten')
<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Penjualan</h1>

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
                                <table id="tbl_sell" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
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
                                        <th>Tanggal</th>
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
                        <div class="form-row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="nama-barang" class="font-weight-bold">Nama Barang</label>
                                    <input type="hidden" name="id" id="id" class="form-control" value="">
                                    <input type="hidden" name="action" id="action" class="form-control">
                                    <select id="nama_barang" name="nama_barang" class="form-control" onchange="autoLoad()">
                                        <option value="">--Pilih Barang--</option>
                                        @foreach ($product as $prdct)
                                            <option value="{{ $prdct->id }}">{{ $prdct->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="stok" class="font-weight-bold">Stok</label>
                                <input type="text" id="stok" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="jumlah_barang" class="font-weight-bold">Jumlah Barang Dijual</label>
                                    <input type="number" class="form-control" id="jumlah_item" name="jumlah_item" data-placement="top" data-title="Jumlah Barang">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="harga" class="font-weight-bold">Harga</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" data-placement="top" data-title="Harga">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="projectinput1" class="font-weight-bold">Total</label>
                            <div class="input-group">
                                <input type="number" class="form-control"  placeholder="Total" aria-label="Amount (to the nearest dollar)" id="total" name="total">
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
        $("#jumlah_item, #harga_jual").keyup(function() {
            var harga  = $("#harga_jual").val();
            var jumlah = $("#jumlah_item").val();

            var total = parseInt(harga) * parseInt(jumlah);
            if (!isNaN(total)) {
                $("#total").val(total);
            }
        });
    });

    function autoLoad()
    {
        var nm_barang = $("#nama_barang").val();
        $("#stok").val('');
        $.ajax({
            url: "/sell/autoLoad/"+nm_barang,
            success: function (response) {
                if (nm_barang != '' && nm_barang != null) {
                    $("#stok").val(response.qty);
                //console.log(response.qty);
                }
            }
        });
    }
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
				$('#tbl_sell').DataTable({
						lengthChange: true,
						autoWidth: false,
						serverside: true,
						responsive: true,
						language: {
								url: '{{ asset('json/bhsTable.json') }}'
						},
						ajax: {
								url: '{{ route('getDataSell') }}'
						},
						columns: [{
								"data" : null, "sortable" : false,
								render: function(data, type, row, meta){
										return meta.row + meta.settings._iDisplayStart + 1
								},
						},
								{data: 'nama_barang', name: 'nama_barang'},
								{data: 'jumlah_item', name: 'jumlah_item'},
								{data: 'harga_jual', name: 'harga_jual'},
								{data: 'total', name: 'total'},
								{data: 'tanggal', name: 'tanggal'},
								{data: 'keterangan', name: 'keterangan'},
								{data: 'aksi', name: 'aksi'},
						]
				});
		})

		/* FUnction Tambah */
		$(document).on('click', '#btn-add', function () {
				$('#modal-add').modal('show');
				$('#modal-title').html('Tambah Data Aset');
				$('.btn-action').html('Simpan');

				$('#id').val('');
				$('#nama_barang').val('');
				$('#jumlah_item').val('');
				$('#harga_beli').val('');
				$('#total').val('');
				$('#keterangan').val('');
				$('#stok').val('');
				$('#action').val('tambah');
		});

		$('#form-add').on('submit', function (e) {
				event.preventDefault();

				/* Jika simpan */
				if ($('#action').val() == "tambah") {
						$.ajax({
								method: "POST",
								url: "{{ route('sell.add.data') }}",
								data: new FormData(this),
								dataType: 'json',
								contentType: false,
								cache: false,
								processData: false,
								success: function (data) {
										$('#tbl_sell').DataTable().ajax.reload();
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
												}
						});
				}
		});

		// $(document).on('click', '.btn-delete', function () {
		// 		var table = $('#tbl_sell').DataTable();
		// 		let id = $(this).data('id');
		// 		//let name = $(this).attr('data-name')
		// 		alert(id);
		// 		var token = $("meta[name='csrf-token']").attr("content");
		// 		//alert(token);

		// 		Swal.fire({
		// 		title: 'Kamu yakin?',
		// 		text: "Data akan dihapus secara permanen loh...",
		// 		icon: 'warning',
		// 		showCancelButton: true,
		// 		confirmButtonColor: '#3085d6',
		// 		cancelButtonColor: '#d33',
		// 		confirmButtonText: 'Ya, hapus!'
		// 		}).then((result) => {
		// 				if (result.isConfirmed) {
		// 						// window.location = "/super/delete/"+id+""

		// 						$.ajax({
		// 								type: "post",
		// 								url: "/asset/delete/"+id,
		// 								data: {
		// 										"id": id,
		// 										"_token": token,
		// 								},
		// 								success: function (response) {
		// 										Swal.fire(
		// 										'Terhapus!',
		// 										'Data berhasil dihapus.',
		// 										'success'
		// 										)
		// 										table.ajax.reload();
		// 										$('#count').load(' #count');
		// 										//refreshTable();
		// 								}
		// 						});
		// 				}
		// 		})
		// });

</script>

@endpush

@endsection
