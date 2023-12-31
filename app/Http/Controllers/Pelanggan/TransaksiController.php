<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pesan(Request $request)
    {
        if ($request->ajax()) {
            $data = Pesanan::latest()->where('user_id', Auth::user()->id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $detailButton = '
                    <button class="btn btn-sm btn-primary detailData" data-id="' . $row->id . '" id="detailData"><i class="bx bx-show"></i>Test</button>
                    ';

                    if ($row->status == "Sudah Dikirim") {
                        $detailButton .= '<button class="btn btn-sm btn-secondary detailData" data-id="' . $row->id . '" id="konfirmasiPesanan" data-status="Pesanan Diterima" >Konfirmasi Penerimaan Barang</button>';
                    }

                    return $detailButton;
                    // return $detailBtn;
                })
                ->addColumn('total', function ($row) {
                    return 'Rp. ' . number_format($row->total_harga);
                })
                ->addColumn('statusPesanan', function ($row) {
                    if ($row->status == "Belum Dikirim") {
                        $bgPesanan = "warning";
                    } elseif ($row->status == "Sudah Dikirim") {
                        $bgPesanan = "success";
                    } elseif ($row->status == "Pesanan Diterima") {
                        $bgPesanan = "info";
                    } else {
                        $bgPesanan = "danger";
                    }
                    return '<span class="badge bg-' . $bgPesanan . '">' . $row->status . '</span>';
                })
                ->addColumn('statusPembayaran', function ($row) {
                    if ($row->pembayaran->status == "Belum Dikonfirmasi") {
                        $bgPesanan = "warning";
                    } elseif ($row->pembayaran->status == "Terkonfirmasi") {
                        $bgPesanan = "success";
                    } else {
                        $bgPesanan = "warning";
                    }
                    return '<span class="badge bg-' . $bgPesanan . '">' . $row->pembayaran->status . '</span>';
                })
                ->rawColumns(['action', 'total', 'statusPesanan', 'statusPembayaran'])
                ->make(true);
        }

        $data = [
            'title' => 'Pesanan',
            'setting' => Setting::first()
        ];
        return view('pelanggan.pesan', $data);
    }

    public function pesanDetail(Request $request, Pesanan $pesan)
    {
        $data = [
            'pesan' => $pesan,
        ];
        return view('admin.transaksi.modal.detail-pesanan', $data);
    }

    public function pesanDetailProduk(Request $request, Pesanan $pesan)
    {
        return DataTables::of($pesan->detailPesanan())
            ->addIndexColumn()
            ->addColumn('produk', function ($row) {
                return $row->produk->nama_produk;
            })
            ->addColumn('hargaProduk', function ($row) {
                return "Rp. " . number_format($row->harga_produk);
            })
            ->addColumn('totalHarga', function ($row) {
                return "Rp. " . number_format($row->total_harga);
            })
            ->rawColumns(['produk', 'totalHarga', 'hargaProduk'])
            ->make(true);
    }

    public function konfirmasiPenerimaanBarang(Request $request, Pesanan $pesan)
    {
        $pesan->status = $request->status;
        $pesan->save();
        return response()->json(['success' => true]);
    }
}
