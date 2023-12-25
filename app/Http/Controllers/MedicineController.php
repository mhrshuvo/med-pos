<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Medicine;
use App\Models\Type;
use App\Models\Unit;
use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    use ImageStore;

    public function index()
    {
        try {
            $data = [
                'medicines' => Medicine::with('category','unit','type')->latest()->paginate(15),
            ];
            return view('medicine.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error');
            return back();
        }
    }

    public function create()
    {
        $data = [
            'categories' => Category::active()->latest()->get(),
            'types' => Type::active()->latest()->get(),
            'units' => Unit::active()->latest()->get(),
            'suppliers' => Contact::active()->supplier()->latest()->get(),
        ];
        return view('medicine.form',$data);
    }

    public function store(MedicineRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->all();

            $data['image'] = $this->saveImage('contacts-' . uniqid() . '.png', $request->image, 'uploads/image/', 'new', 200, 200);

            Medicine::create($data);

            Toastr::success('Medicine Added Successfully','success!');

            return redirect()->route('medicines.index');

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back()->withInput();
        }
    }

    public function show(Medicine $medicine)
    {
        //
    }

    public function edit(Medicine $medicine)
    {
        try {
            $data = [
                'categories' => Category::active()->latest()->get(),
                'types' => Type::active()->latest()->get(),
                'units' => Unit::active()->latest()->get(),
                'suppliers' => Contact::active()->supplier()->latest()->get(),
                'medicine' => $medicine,
                'medicines' => Medicine::with('category','unit','type')->latest()->paginate(15),
            ];
            return view('medicine.form', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error');
            return back();
        }
    }

    public function update(MedicineRequest $request, Medicine $medicine): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->all();

            $data['image'] = $this->saveImage('medicine-' . uniqid() . '.png', $request->image, 'uploads/image/', $medicine->image, 200, 200);

            $medicine->update($data);

            Toastr::success('Medicine Update Successfully','success!');

            return redirect()->route('medicines.index');

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function destroy(Medicine $medicine): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->deleteImage($medicine->image);

            $medicine->delete();

            Toastr::success('Medicine Deleted Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }
}
