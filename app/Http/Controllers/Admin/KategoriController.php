<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Update Button
                    $updateButton = "<button class='btn btn-sm btn-info updateData' data-id='" . $row->id . "'><i class='bx bx-edit'></i></button>";

                    // Delete Button
                    $deleteButton = "<button class='btn btn-sm btn-danger deleteData' data-id='" . $row->id . "'><i class='bx bx-trash'></i></button>";

                    return $updateButton . " " . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'title' => 'Kategori',
            'setting' => Setting::first()
        ];
        confirmDelete('Konfirmasi Hapus', 'Apakah Anda yakin untuk hapus data ini?');
        return view('admin.kategori.index', $data);
    }

    public function getData(Request $request)
    {
        $data = Kategori::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $proses = Kategori::create([
            'nama' => $request->name,
        ]);

        if ($proses) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function show(Kategori $kategori)
    {
        //
    }

    public function edit(Kategori $kategori)
    {
        $data = [
            'nama' => $kategori->nama,
        ];
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }
        
        $kategori->nama = $request->name;

        if ($kategori->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
