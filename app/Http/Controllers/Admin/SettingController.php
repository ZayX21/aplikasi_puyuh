<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Website',
            'setting' => Setting::first()
        ];
        return view('admin.setting', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $setting = Setting::first();

        $setting->name = $request->name;
        $setting->description = $request->description;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;

        $sosmedLink = [
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ];

        $setting->social_media = json_encode($sosmedLink);

        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $logo->storeAs('public', $logo->hashName());
            $setting->logo = $logo->hashName();
        }

        if ($request->file('favicon')) {
            $favicon = $request->file('favicon');
            $favicon->storeAs('public', $favicon->hashName());
            $setting->favicon = $favicon->hashName();
        }

        $setting->save();

        return redirect()->route('admin.setting')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
