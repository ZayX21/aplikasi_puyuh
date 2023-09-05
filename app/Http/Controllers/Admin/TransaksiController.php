<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function pelanggan(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->select('users.*')
                ->where('role_user.role_id', '=', '1')
                ->get();

            return DataTables::of($data)->addIndexColumn()->make(true);
        }

        $data = [
            'title' => 'Pelanggan',
            'setting' => Setting::first()
        ];
        return view('admin.transaksi.pelanggan', $data);
    }

    public function pesan(Request $request)
    {
        if ($request->ajax()) {
            $data = Pesanan::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $detailButton = '
                    <button
                            type="button"
                            class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li><button class="dropdown-item" data-id="' . $row->id . '" id="detailData">Detail</button></li>
                    ';
                    if ($row->pembayaran->status == "Belum Dikonfirmasi") {
                        $detailButton .= '<li><button class="dropdown-item" data-id="' . $row->id . '" id="konfirmasiPembayaran">Konfirmasi Pembayaran</button></li>';
                    }

                    if ($row->pembayaran->status == "Terkonfirmasi") {
                        if ($row->status == "Belum Dikirim" || $row->status == "Batal Dikirim") {
                            $detailButton .= '<li><button class="dropdown-item" data-id="' . $row->id . '" id="kirimProduk" data-status="Sudah Dikirim" >Kirim Produk</button></li>';
                        } else {
                            $detailButton .= '<li><button class="dropdown-item" data-id="' . $row->id . '" id="batalKirim" data-status="Batal Dikirim" >Batal Kirim Produk</button></li>';
                        }
                    }
                    $detailButton .= ' </ul>';

                    return $detailButton;
                })
                ->addColumn('pelanggan', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('total', function ($row) {
                    return 'Rp. ' . number_format($row->total_harga);
                })
                ->addColumn('statusPesanan', function ($row) {
                    if ($row->status == "Belum Dikirim") {
                        $bgPesanan = "warning";
                    } elseif ($row->status == "Sudah Dikirim") {
                        $bgPesanan = "success";
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
                ->rawColumns(['action', 'pelanggan', 'total', 'statusPesanan', 'statusPembayaran'])
                ->make(true);
        }

        $data = [
            'title' => 'Pesanan',
            'setting' => Setting::first()
        ];
        return view('admin.transaksi.pesan', $data);
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

    public function konfirmasiPembayaran(Request $request, $pesan)
    {
        $getPembayaran = Pembayaran::where('pesanan_id', $pesan)->first();
        $data = [
            'pembayarans' => $getPembayaran
        ];
        return view('admin.transaksi.modal.konfirmasi-pembayaran', $data);
    }

    public function actKonfirmasiPembayaran(Request $request, $pesan)
    {
        $getPembayaran = Pembayaran::where('pesanan_id', $pesan)->first();

        $getPembayaran->status = "Terkonfirmasi";
        $getPembayaran->save();
        return response()->json(['success' => true]);
    }

    public function kirimProduk(Request $request, Pesanan $pesan)
    {
        $pesan->status = $request->status;
        $pesan->save();
        return response()->json(['success' => true]);
    }

    public function pembayaran(Request $request)
    {
        if ($request->ajax()) {
            $data = Pembayaran::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->status == "Terkonfirmasi") {
                        $iconBtn = "show-alt";
                        $bgBtn = "primary";
                    } else {
                        $iconBtn = "check-double";
                        $bgBtn = "success";
                    }
                    $imageButton = "<button class='btn btn-sm btn-" . $bgBtn . "' data-id='" . $row->id . "' id='konfirmasiPembayaran'><i class='bx bx-" . $iconBtn . "'></i></button>";
                    return $imageButton;
                })
                ->addColumn('kodeTransaksi', function ($row) {
                    return $row->pesanan->kode_transaksi;
                })
                ->addColumn('pelanggan', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('total', function ($row) {
                    return 'Rp. ' . number_format($row->pesanan->total_harga);
                })
                ->addColumn('statusPembayaran', function ($row) {
                    if ($row->status == "Belum Dikonfirmasi") {
                        $bgPesanan = "warning";
                    } elseif ($row->status == "Terkonfirmasi") {
                        $bgPesanan = "success";
                    } else {
                        $bgPesanan = "warning";
                    }
                    return '<span class="badge bg-' . $bgPesanan . '">' . $row->status . '</span>';
                })
                ->rawColumns(['action', 'pelanggan', 'total', 'statusPembayaran', 'kodeTransaksi'])
                ->make(true);
        }
        $data = [
            'title' => 'Pembayaran',
            'setting' => Setting::first()
        ];
        return view('admin.transaksi.pembayaran', $data);
    }

    public function showPembayaran(Request $request, Pembayaran $pembayaran)
    {
        $data = [
            'pembayarans' => $pembayaran
        ];
        return view('admin.transaksi.modal.pembayaran', $data);
    }

    public function actPembayaran(Request $request, Pembayaran $pembayaran)
    {
        $pembayaran->status = "Terkonfirmasi";
        $pembayaran->save();
        return response()->json(['success' => true]);
    }
}
