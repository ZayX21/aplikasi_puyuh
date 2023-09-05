<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Models\Setting;

class RekeningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Rekening::latest()->get();

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
            'title' => 'Rekening',
            'setting' => Setting::first()
        ];
        confirmDelete('Konfirmasi Hapus', 'Apakah Anda yakin untuk hapus data ini?');
        return view('admin.rekening.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'bank' => 'required|max:255',
            'norek' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

        $proses = Rekening::create([
            'bank' => $request->bank,
            'atas_nama' => $request->name,
            'norek' => $request->norek,
        ]);

        if ($proses) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function show(Rekening $rekening)
    {
        //
    }

    public function edit(Rekening $rekening)
    {
        $data = [
            'bank' => $rekening->bank,
            'atas_nama' => $rekening->atas_nama,
            'norek' => $rekening->norek,
        ];
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, Rekening $rekening)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'bank' => 'required|max:255',
            'norek' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }
        
        $rekening->bank = $request->bank;
        $rekening->atas_nama = $request->name;
        $rekening->norek = $request->norek;

        if ($rekening->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy(Rekening $rekening)
    {
        if ($rekening->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
