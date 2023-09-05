<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Setting;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pesanan::latest()->where('user_id', Auth::user()->id)->take(5)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Update Button
                    $detailBtn = "<button class='btn btn-sm btn-info detailData' id='detailData' data-id='" . $row->id . "'><i class='bx bx-show'></i></button>";

                    return $detailBtn;
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
                ->rawColumns(['action', 'total', 'statusPesanan', 'statusPembayaran'])
                ->make(true);
        }

        $data = [
            'title' => 'Dashboard',
            'setting' => Setting::first(),
            'keranjang' => Keranjang::where('user_id', Auth::user()->id)->count(),
            'pesanan' => Pesanan::where('user_id', Auth::user()->id)->count()
        ];
        return view('pelanggan.dashboard', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'user' => User::find(Auth::id()),
            'setting' => Setting::first()
        ];
        return view('pelanggan.profile', $data);
    }

    public function profileAct(Request $request)
    {
        $user = User::find(Auth::id());
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'nohp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $pelanggan = Pelanggan::where('user_id', $user->id)->first();
        $pelanggan->no_hp = $request->nohp;
        $pelanggan->alamat = '-';
        $pelanggan->save();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->password != null){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return response()->json(['success' => true]);
    }

}
