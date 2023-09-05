<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\KategoriProduk;
use App\Models\FotoProduk;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Setting;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Produk::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kategori', function ($produk) {
                    $labels = '';

                    foreach ($produk->kategoriProduk as $kategori) {
                        $labels .= '<span class="badge bg-primary">' . $kategori->kategori->nama . '</span> ';
                    }

                    return $labels;
                })
                ->addColumn('action', function ($row) {
                    // Update Button
                    $imageButton = "<button class='btn btn-sm btn-warning imageData' data-id='" . $row->id . "'><i class='bx bx-image-add'></i></button>";

                    $updateButton = "<button class='btn btn-sm btn-info updateData' data-id='" . $row->id . "'><i class='bx bx-edit'></i></button>";

                    // Delete Button
                    $deleteButton = "<button class='btn btn-sm btn-danger deleteData' data-id='" . $row->id . "'><i class='bx bx-trash'></i></button>";

                    return  $imageButton . " " . $updateButton . " " . $deleteButton;
                })
                ->addColumn('hargaProduk', function ($row) {
                    return 'Rp. '.number_format($row->harga);
                })
                ->rawColumns(['action', 'kategori', 'hargaProduk'])
                ->make(true);
        }

        $data = [
            'title' => 'Produk',
            'kategori' => Kategori::latest()->get(),
            'setting' => Setting::first()
        ];
        return view('admin.produk.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'harga' => 'required',
            'stok' => 'required',
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategoris,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $cleanValue = preg_replace("/[^0-9]/", "", $request->harga);

        $newHarga = (int)$cleanValue;

        $produk = new Produk();
        $produk->nama_produk = $request->name;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $newHarga;
        $produk->stok = $request->stok;
        $produk->save();

        $kategoriProduk = $request->kategori;
        $produk->kategori()->attach($kategoriProduk);

        return response()->json(['success' => true]);
    }

    public function show(Produk $produk)
    {
        //
    }

    public function edit(Produk $produk)
    {
        $data = [
            'nama_produk' => $produk->nama_produk,
            'deskripsi' => $produk->deskripsi,
            'harga' => number_format($produk->harga, 0, '.', ''),
            'stok' => $produk->stok,
            'kategori' => $produk->kategoriProduk
        ];
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'harga' => 'required',
            'stok' => 'required',
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategoris,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $cleanValue = preg_replace("/[^0-9]/", "", $request->harga);

        $newHarga = (int)$cleanValue;

        $produk->nama_produk = $request->name;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $newHarga;
        $produk->stok = $request->stok;

        $kategoriProduk = $request->kategori;
        $produk->kategori()->sync($kategoriProduk);

        if ($produk->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy(Produk $produk)
    {
        $kategori =  KategoriProduk::where('produk_id', $produk->id)->delete();
        if ($produk->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function image(Request $request, $id)
    {
        $produk = Produk::find($id);
        $data = [
            'produk' => $produk,
            'idProduk' => $id 
        ];
        return view('admin.produk.image-html', $data);
    }

    public function imageAct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $image = $request->file('foto');
        $image->storeAs('public/produk', $image->hashName());

        FotoProduk::create([
            'produk_id' => $request->id,
            'foto'     => $image->hashName(),
        ]);

        return response()->json(['success' => true]);
    }

    public function imageDel($id, $produk)
    {
        $foto = FotoProduk::findOrFail($id);

        Storage::disk('local')->delete('public/produk/'.$foto->foto);

        $foto->delete();
        // FotoProduk::where('id', $id)->where('produk_id', $produk)->delete();
        return response()->json(['success' => true]);
    }
}
