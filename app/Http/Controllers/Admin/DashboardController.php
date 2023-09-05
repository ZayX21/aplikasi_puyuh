<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Setting;
use App\Models\Pembayaran;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $countPelanggan = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->select('users.*')
            ->where('role_user.role_id', '=', '1')
            ->count();

        $countUser = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->select('users.*')
            ->where('role_user.role_id', '=', '2')
            ->count();

        $monthlyIncome = Pesanan::selectRaw('SUM(total_harga) as total_income, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'Sudah Dikirim')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // $formattedIncome = $monthlyIncome->map(function ($income) {
        //     return rtrim(number_format($income, 2), '0');
        // });

        // // Jika bulan yang belum memiliki penghasilan diisi dengan 0
        // $monthlyIncome = $formattedIncome->merge(collect(range(1, 12))->map(function ($month) use ($formattedIncome) {
        //     return $formattedIncome->has($month) ? $formattedIncome[$month] : 0;
        // }));

        $jumlahTotal = [];
        $bulanChart = [];

        for ($i = 1; $i <= 12; $i++) {
            $jumlahTotal[$i - 1] = 0;
            $bulanChart[$i - 1] = date("F", mktime(0, 0, 0, $i, 1));
        }

        foreach ($monthlyIncome as $d) {
            $jumlahTotal[$d->month - 1] = $d->total_income;
        }

        $data = [
            'title' => 'Dashboard',
            'pesananHariIni' => Pesanan::whereDate('created_at', today())->take(20)->count(),
            'countPelanggan' =>  $countPelanggan,
            'countUser' => $countUser,
            'totalHariIni' =>  Pesanan::whereDate('created_at', today())->where('status', 'Sudah Dikirim')->sum('total_harga'),
            'totalKeseluruhan' => Pesanan::where('status', 'Sudah Dikirim')->sum('total_harga'),
            'jumlahTotal' => $jumlahTotal,
            'bulanChart' => $bulanChart,
            'setting' => Setting::first()
        ];
        return view('admin.dashboard', $data);
    }
}
