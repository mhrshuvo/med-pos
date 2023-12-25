<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'types' => Type::latest()->paginate(15)
            ];
            return view('types.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error');
            return back();
        }
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $data = $request->all();

            Type::create($data);

            Toastr::success('Type Has been Made Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }


    public function edit(Type $type)
    {
        try {
            $data = [
                'types' => Type::latest()->paginate(15),
                'type' => $type
            ];
            return view('types.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error');
            return back();
        }
    }

    public function update(Request $request, Type $type): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:types,name,'.$type->id,
        ]);

        try {
            $data = $request->all();

            $type->update($data);

            Toastr::success('Type Has been Updated Successfully','success!');

            return redirect()->route('types.index');

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function destroy(Type $type): \Illuminate\Http\RedirectResponse
    {
        try {
            $type->delete();

            Toastr::success('Type Has been Deleted Successfully','success!');

            return redirect()->route('types.index');
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }
}
