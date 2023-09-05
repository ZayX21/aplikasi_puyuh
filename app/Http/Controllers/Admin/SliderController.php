<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Setting;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('fotoImg', function ($row) {
                    $labels = '<img src="'.Storage::url('public/slider/') . $row->foto.'"
                    alt="" width="100%">';

                    return $labels;
                })
                ->addColumn('action', function ($row) {

                    $updateButton = "<button class='btn btn-sm btn-info updateData' data-id='" . $row->id . "'><i class='bx bx-edit'></i></button>";

                    // Delete Button
                    $deleteButton = "<button class='btn btn-sm btn-danger deleteData' data-id='" . $row->id . "'><i class='bx bx-trash'></i></button>";

                    return  $updateButton . " " . $deleteButton;
                })
                ->rawColumns(['action', 'fotoImg'])
                ->make(true);
        }

        $data = [
            'title' => 'Pengaturan Website',
            'setting' => Setting::first()
        ];
        return view('admin.slider.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $image = $request->file('foto');
        $image->storeAs('public/slider', $image->hashName());

        Slider::create([
            'judul' => $request->name,
            'deskripsi' => $request->deskripsi,
            'foto'     => $image->hashName(),
        ]);

        return response()->json(['success' => true]);
    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit(Slider $slider)
    {
        $data = [
            'name' => $slider->judul,
            'deskripsi' => $slider->deskripsi,
            'foto' => Storage::url('public/slider/') . $slider->foto
        ];
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $slider->judul = $request->name;
        $slider->deskripsi = $request->deskripsi;

        if($request->file('foto')){
            $image = $request->file('foto');
            $image->storeAs('public/slider', $image->hashName());
            Storage::disk('local')->delete('public/slider/'.$slider->foto);
            $slider->foto = $image->hashName();
        }
        $slider->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Slider $slider)
    {

        Storage::disk('local')->delete('public/slider/'.$slider->foto);

        $slider->delete();
        // FotoProduk::where('id', $id)->where('produk_id', $produk)->delete();
        return response()->json(['success' => true]);
    }
}
