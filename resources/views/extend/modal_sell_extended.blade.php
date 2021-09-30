<div class="modal fade text-left" id="modal-ext" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="modal-title"></h5>
                <button type="button btn-dismiss" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" action="{{ route('update.asset') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_barang" class="font-weight-bold">Nama Barang</label>
                        <input type="hidden" name="id" id="id" class="form-control" value="">
                        <input type="hidden" name="action" id="action" class="form-control">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang/Aset">
                        <span class="text-danger error-text nama_barang_error"></span>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="jumlah_barang" class="font-weight-bold">Jumlah Barang</label>
                                <input type="number" class="form-control" id="jumlah_barang_edit" name="jumlah_barang_edit"
                                    data-placement="top" data-title="Jumlah Barang" placeholder="Jumlah">
                                <span class="text-danger error-text jumlah_barang_edit_error"></span>
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
                                <input type="number" class="form-control" id="harga_edit" name="harga_edit" data-placement="top"
                                    data-title="Harga" placeholder="Harga Barang/Aset">
                                <span class="text-danger error-text harga_edit_error"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="projectinput1" class="font-weight-bold">Total</label>
                                    <input type="number" class="form-control" placeholder="Total"
                                        aria-label="Amount (to the nearest dollar)" id="total_edit" name="total_edit" readonly>
                                    <span class="text-danger error-text total_edit_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="upload" class="font-weight-bold">Upload Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar_update" name="gambar_update">
                            <label class="custom-file-label" for="upload-file">Pilih Gambar</label>
                            <span class="text-danger error-text gambar_update_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ket" class="font-weight-bold">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                    </div>
                        <div class="img-holder-update" id="img-hold"></div>
                        <button type="submit" class="btn btn-primary btn-action">Simpan</button>
                </form>
        </div>
    </div>
</div>
