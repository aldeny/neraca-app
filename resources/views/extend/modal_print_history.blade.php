<div class="modal fade text-left" id="modal-print-credit-history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="modal-print-kb">Print Data Histori Credit</h5>
                <button type="button btn-dismiss" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dari_tgl" class="font-weight-bold">Dari Tanggal</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="ke_tgl" class="font-weight-bold">Sampai Tanggal</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" required>
                </div>
                <a href="" onclick="this.href='/print/creditHistory/'+document.getElementById('from_date').value+'/'+document.getElementById('to_date').value" target="_blank" class="btn btn-sm btn-secondary btn-submit"><i class="fas fa-print"></i> Print</a>
        </div>
    </div>
</div>
</div>
