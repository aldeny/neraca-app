<div class="modal fade text-left" id="modal-add-sisa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="modal-title"></h5>
                <button type="button btn-dismiss" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tr>
                        <td class="w-25">Nama Barang</td>
                        <td style="width: 0">:</td>
                        <td id="sisaNamaItem" class="font-weight-bold"></td>
                    </tr>
                    <tr>
                        <td class="w-25">Tanggal Beli</td>
                        <td style="width: 0">:</td>
                        <td id="sisaTanggalBeli" class="font-weight-bold"></td>
                    </tr>
                    <tr>
                        <td class="w-25">Harga</td>
                        <td style="width: 0">:</td>
                        <td id="sisaHarga" class="font-weight-bold"></td>
                    </tr>
                    <tr>
                        <td class="w-25">Sisa</td>
                        <td style="width: 0">:</td>
                        <td id="sisaSisa" class="font-weight-bold"></td>
                    </tr>
                    <tr>
                        <td class="w-25">Keterangan Bayar</td>
                        <td style="width: 0">:</td>
                        <td id="sisaKetBayar" class="font-weight-bold"></td>
                    </tr>
                </table>

                <br>
                <h5>Bayar Sisa Credit</h5>
                <br>

                <form class="form" id="form-sisa-credit" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal-bayar" class="font-weight-bold">Tanggal Bayar</label>
                                    <input type="date" class="form-control" name="tanggal_bayar_sisa" id="tanggal_bayar_sisa">
                                    <input type="hidden" name="id_sisa" id="id_sisa" class="form-control" value="">
                                    <input type="hidden" name="action" id="action" class="form-control">
                                    <span class="text-danger" id="tanggal_bayarError"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bayar-sisa" class="font-weight-bold">Bayar Sisa</label>
                                    <input type="text" class="form-control" name="jumlah_bayar_sisa" id="jumlah_bayar_sisa" placeholder="Bayar Sisa">
                                    <span class="text-danger" id="jumlah_bayar_sisaError"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan-bayar" class="font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="ket_bayar_sisa" id="ket_bayar_sisa" placeholder="Keterangan"></textarea>
                            <span class="text-danger" id="ket_bayar_sisaError"></span>
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
