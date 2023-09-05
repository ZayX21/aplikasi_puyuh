@csrf
<div class="modal-body">
    <img src="{{ Storage::url('public/pembayaran/') . $pembayarans->bukti_pembayaran }}" alt=""
    style="width: 100%;">
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Tutup
    </button>
    @if ($pembayarans->status == 'Belum Dikonfirmasi')
        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
    @endif
</div>
