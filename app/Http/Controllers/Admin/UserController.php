<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->select('users.*')
            ->where('role_user.role_id', '=','2')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->id != Auth::id()) {
                        // Update Button
                        $updateButton = "<button class='btn btn-sm btn-info updateData' data-id='" . $row->id . "'><i class='bx bx-edit'></i></button>";
                        // Delete Button
                        $deleteButton = "<button class='btn btn-sm btn-danger deleteData' data-id='" . $row->id . "'><i class='bx bx-trash'></i></button>";

                        return $updateButton . " " . $deleteButton;
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'title' => 'Pengguna',
            'role' => Role::latest()->get(),
            'setting' => Setting::first()
        ];
        return view('admin.user.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = RoleUser::create([
            'role_id' => 2,
            'user_id' => $user->id
        ]);

        return response()->json(['success' => true]);
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $data = [
            'name' => $user->name,
            'email' => $user->email,
        ];
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

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

    public function destroy(User $user)
    {
        $kategori =  RoleUser::where('user_id', $user->id)->delete();
        if ($user->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'user' => User::find(Auth::id()),
            'setting' => Setting::first()
        ];
        return view('admin.user.profile', $data);
    }

    public function profileAct(Request $request)
    {
        $user = User::find(Auth::id());
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'validasi',
                'errors' => $validator->errors()
            ]);
        }

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
