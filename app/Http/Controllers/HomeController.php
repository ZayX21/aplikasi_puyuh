<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Rekening;
use Exception;
use App\Models\Setting;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $this->middleware('auth');
            $user = Auth::user();

            if ($user->hasRole('Admin')) {
                return redirect()->route('admin');
            } elseif ($user->hasRole('Pelanggan')) {
                return redirect()->route('pelanggan');
            }
        } else {
            return redirect()->route('halamanDepan');
        }
    }

    public function halamanDepan()
    {
        if (Auth::check()) {
            $countCart = Keranjang::where('user_id', Auth::user()->id)->count();
        } else {
            $countCart = 0;
        }

        $data = [
            'title' => 'Home',
            'countCart' => $countCart,
            'kategoris' => Kategori::inRandomOrder()->take(10)->get(),
            'setting' => Setting::first(),
            'sliders' => Slider::latest()->get()
        ];
        return view('welcome', $data);
    }

    public function produkData(Request $request)
    {
        $perPage = 15; // Jumlah data per halaman
        $page = $request->page;
        $offset = ($page - 1) * $perPage;

        $keyword = $request->keyword;
        $filter = $request->filter;
        $kategori = $request->kategori;

        $produk = Produk::where('nama_produk', 'like', "%$keyword%");

        if (!empty($filter)) {
            if ($filter == "Termurah") {
                $produk->orderByDesc(function ($query) {
                    $query->select(DB::raw('SUM(jumlah_dipesanan)'))
                        ->from('detail_pesanans')
                        ->whereColumn('detail_pesanans.produk_id', 'produks.id')
                        ->orderByDesc(DB::raw('SUM(jumlah_dipesanan)'))
                        ->limit(1);
                });
            } elseif ($filter == "Terlaris") {
                $produk->orderBy('harga');
            }
        }

        if (!empty($kategori)) {
            if($kategori != "semua"){
                $produk->whereHas('kategoriProduk', function ($query) use ($kategori) {
                    $query->where('kategori_id', $kategori);
                });
            }
        }

        $newProduk = $produk->offset($offset)->limit($perPage)->get();

        $data = [
            'produks' => $newProduk,
            'setting' => Setting::first()
        ];

        return view('produk-home', $data);
    }

    public function produk(Request $request)
    {
        if (Auth::check()) {
            $countCart = Keranjang::where('user_id', Auth::user()->id)->count();
        } else {
            $countCart = 0;
        }  

        if($request->input('kategori')){
            $kategoriUrl = $request->input('kategori');
        }else{
            $kategoriUrl = '';
        }

        $data = [
            'title' => 'Produk',
            'countCart' => $countCart,
            'kategoris' => Kategori::inRandomOrder()->take(10)->get(),
            'setting' => Setting::first(),
            'kategoriUrl' => $kategoriUrl
        ];
        return view('produk', $data);
    }

    public function produkDetail(Produk $produk)
    {
        if (Auth::check()) {
            $countCart = Keranjang::where('user_id', Auth::user()->id)->count();
        } else {
            $countCart = 0;
        }

        $data = [
            'title' => 'Produk',
            'details' => $produk,
            'countCart' => $countCart,
            'setting' => Setting::first(),
            'produks' => Produk::inRandomOrder()->take(5)->get(),
            'kategoris' => Kategori::inRandomOrder()->take(10)->get()
        ];
        return view('produk-detail', $data);
    }

    public function keranjang()
    {
        if (Auth::check()) {
            $data = [
                'title' => 'Keranjang',
                'countCart' => Keranjang::where('user_id', Auth::user()->id)->count(),
                'keranjangs' => Keranjang::where('user_id', Auth::user()->id)->get(),
                'kategoris' => Kategori::inRandomOrder()->take(10)->get(),
                'setting' => Setting::first()
            ];
            return view('keranjang', $data);
        } else {
            return redirect()->route('login');
        }
    }

    public function tambahKeranjang(Request $request)
    {
        if (Auth::check()) {
            $itemId = $request->produk_id;
            $qty = $request->qty;

            $keranjang = Keranjang::where('user_id', Auth::user()->id)
                ->where('produk_id', $itemId)
                ->first();

            if ($keranjang) {
                $keranjang->qty += $qty;
                $keranjang->save();
            } else {
                $keranjang = new Keranjang();
                $keranjang->user_id = Auth::user()->id;
                $keranjang->produk_id = $itemId;
                $keranjang->qty = $qty;
                $keranjang->save();
            }
            $totalKeranjang = Keranjang::where('user_id', Auth::user()->id)->count();

            return response()->json(['success' => true, 'total_keranjang' => $totalKeranjang]);
        } else {
            return response()->json(['success' => false, 'message' => 'Anda harus login terlebih dahulu.']);
        }
    }

    public function updateKeranjang(Request $request, Keranjang $keranjang)
    {
        $qty = $request->qty;
        $keranjang->qty = $qty;
        $keranjang->save();

        $totalKeranjang = Keranjang::where('user_id', Auth::user()->id)->count();

        return response()->json(['success' => true, 'total_keranjang' => $totalKeranjang]);
    }

    public function deleteKeranjang(Request $request, Keranjang $keranjang)
    {
        $keranjang->delete();
        $totalKeranjang = Keranjang::where('user_id', Auth::user()->id)->count();

        return response()->json(['success' => true, 'total_keranjang' => $totalKeranjang]);
    }

    public function checkout()
    {
        if (Auth::check()) {
            $countCart = Keranjang::where('user_id', Auth::user()->id)->count();
            if ($countCart != 0) {
                $timestamp = now()->format('ymdHis');
                $randomNumber = mt_rand(1000, 9999);
                $kodeTransaksi = 'TRX-' . $timestamp . '-' . $randomNumber;

                $data = [
                    'title' => 'Keranjang',
                    'kodeTransaksi' => $kodeTransaksi,
                    'countCart' => Keranjang::where('user_id', Auth::user()->id)->count(),
                    'keranjangs' => Keranjang::where('user_id', Auth::user()->id)->get(),
                    'kategoris' => Kategori::inRandomOrder()->take(10)->get(),
                    'setting' => Setting::first(),
                    'rekenings' => Rekening::latest()->get()
                ];
                return view('checkout', $data);
            } else {
                return redirect()->route('produk');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function actCheckout(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'buktiPembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'alamatPengiriman' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => 'validasi',
                    'errors' => $validator->errors()
                ]);
            }

            $pesanan = Pesanan::create([
                'kode_transaksi' => $request->kodeTransaksi,
                'user_id' => Auth::user()->id,
                'tanggal' => date('Y-m-d'),
                'alamat_pengiriman' => $request->alamatPengiriman,
                'total_harga' => $request->total_harga,
                'status' => 'Belum Dikirim'
            ]);

            $subTotal = 0;
            $dataKeranjang =  Keranjang::where('user_id', Auth::user()->id)->get();
            foreach ($dataKeranjang as $keranjang) {
                $totalPerproduk = $keranjang->produk->harga * $keranjang->qty;
                $subTotal += $totalPerproduk;

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $keranjang->produk_id,
                    'harga_produk' => $keranjang->produk->harga,
                    'jumlah_dipesanan' => $keranjang->qty,
                    'total_harga' => $totalPerproduk
                ]);

                $newProduk = Produk::find($keranjang->produk_id);
                $newProduk->stok = $newProduk->stok - $keranjang->qty;
                $newProduk->save();
            }

            $image = $request->file('buktiPembayaran');
            $image->storeAs('public/pembayaran', $image->hashName());

            Pembayaran::create([
                'user_id' => Auth::user()->id,
                'pesanan_id' => $pesanan->id,
                'bukti_pembayaran' => $image->hashName(),
                'status' => 'Belum Dikonfirmasi'
            ]);

            Keranjang::where('user_id', Auth::user()->id)->delete();

            DB::commit();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['success' => false]);
        }
    }
}
