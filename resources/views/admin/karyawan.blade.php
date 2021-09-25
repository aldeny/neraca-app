@extends('layouts.master')

@section('title', 'Karyawan')

@section('konten')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Karyawan</h1>
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
                      <h3 class="card-title">Tambah Data Karyawan</h3>
                    </div>
                    <div class="card-body">
                        <form id="form-employee-add" action="{{ route('save.asset') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_karyawan" class="font-weight-bold">Nama Barang</label>
                                <input type="hidden" name="id" id="id" class="form-control" value="">
                                <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Nama Karyawan">
                                <span class="text-danger error-text nama_karyawan_error"></span>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jabatan" class="font-weight-bold">Jabatan</label>
                                        <select class="custom-select" name="jabatan" id="jabatan">
                                            <option value="">Pilih Kondisi</option>
                                            <option value="1">Baik</option>
                                            <option value="2">Rusak</option>
                                        </select>
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
                                        <span class="text-danger error-text kondisi_error"></span>
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
        </div>

        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="card-text">
                                <h4>Data Aset</h4>
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
@endsection
