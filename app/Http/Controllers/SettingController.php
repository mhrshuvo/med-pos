<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageStore;

    public function index()
    {
        $data = [
            'setting' => Setting::first()
        ];
        return view('setting',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pharmacy_name' => 'required',
            'site_tile' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data = $request->all();

        $setting = Setting::first();

        $data['logo'] = $this->saveImage('logo-' . uniqid() . '.png', $request->logo, 'uploads/image/', $setting->logo, 200, 200);
        $data['favicon'] = $this->saveImage('favicon-' . uniqid() . '.png', $request->favicon, 'uploads/image/', $setting->favicon, 200, 200);

        $setting->update($data);

        Toastr::success('Setting Updated Successfully');

        return back();
    }
}
