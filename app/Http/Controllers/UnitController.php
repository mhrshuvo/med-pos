<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'units' => Unit::latest()->paginate(15)
            ];
            return view('units.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error');
            return back();
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $data = $request->all();

            Unit::create($data);

            Toastr::success('Unit Has been Made Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }


    public function edit(Unit $unit)
    {
        try {
            $data = [
                'units' => Unit::latest()->paginate(15),
                'unit' => $unit
            ];
            return view('units.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error');
            return back();
        }
    }

    public function update(Request $request, Unit $unit): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$unit->id,
        ]);

        try {
            $data = $request->all();

            $unit->update($data);

            Toastr::success('Unit Has been Updated Successfully','success!');

            return redirect()->route('units.index');

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function destroy(Unit $unit): \Illuminate\Http\RedirectResponse
    {
        try {
            $unit->delete();

            Toastr::success('Unit Has been Deleted Successfully','success!');
            return redirect()->route('units.index');
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }
}
