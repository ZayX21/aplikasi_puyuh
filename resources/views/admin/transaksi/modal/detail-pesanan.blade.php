<div class="row">
    <div class="col-md-12">
        <p><b>Detail Pelanggan</b></p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td width='30%'>Nama Pelanggan</td>
                    <td width="1%">:</td>
                    <td>{{ $pesan->user->name }}</td>
                </tr>
                <tr>
                    <td width='30%'>Email</td>
                    <td width="1%">:</td>
                    <td>{{ $pesan->user->email }}</td>
                </tr>
                <tr>
                    <td width='30%'>No Telp</td>
                    <td width="1%">:</td>
                    <td>{{ $pesan->user->pelanggan->no_hp }}</td>
                </tr>
            </table>
        </div>
        <hr>
        <p><b>Detail Pesanan</b></p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td width='30%'>Kode Transaksi</td>
                    <td width="1%">:</td>
                    <td>{{ $pesan->kode_transaksi }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pemesanan</td>
                    <td width="1%">:</td>
                    <td>{{ date('d-m-Y', strtotime($pesan->tanggal)) }}</td>
                </tr>
                <tr>
                    <td>Status Pemesanan</td>
                    <td width="1%">:</td>
                    <td>
                        @php
                            if ($pesan->status == 'Belum Dikirim') {
                                $bgPesanan = 'warning';
                            } elseif ($pesan->status == 'Sudah Dikirim') {
                                $bgPesanan = 'success';
                            } else {
                                $bgPesanan = 'warning';
                            }
                            echo '<span class="badge bg-' . $bgPesanan . '">' . $pesan->status . '</span>';
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td>Alamat Pengiriman</td>
                    <td width="1%">:</td>
                    <td>{{ $pesan->alamat_pengiriman }}</td>
                </tr>
            </table>
        </div>
        <hr>
        <p><b>Detail Pembayaran</b></p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td width='30%'>Status Pembayaran</td>
                    <td width="1%">:</td>
                    <td>
                        @php
                            if ($pesan->pembayaran->status == 'Belum Dikonfirmasi') {
                                $bgPesanan = 'warning';
                            } elseif ($pesan->pembayaran->status == 'Terkonfirmasi') {
                                $bgPesanan = 'success';
                            } else {
                                $bgPesanan = 'warning';
                            }
                            echo '<span class="badge bg-' . $bgPesanan . '">' . $pesan->pembayaran->status . '</span>';
                        @endphp
                    </td>
                </tr>

                <tr>
                    <td>Total Pembayaran</td>
                    <td width="1%">:</td>
                    <td><b>{{ 'Rp. ' . number_format($pesan->total_harga) }}</b></td>
                </tr>

            </table>
        </div>
    </div>

    <div class="col-md-12">
        <hr>
        <p><b>Detail Produk Dipesan</b></p>
        <div class="table-responsive">
            <table id="detail-table" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga Produk</th>
                        <th>Qty</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
