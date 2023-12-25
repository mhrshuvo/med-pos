<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ImageStore;

    public function index()
    {
        $data = [
            'contacts' => Contact::customer()->where('id','!=',1)->paginate(15)
        ];

        return view('contacts.index',$data);
    }

    public function suppliers()
    {
        $data = [
            'contacts' => Contact::supplier()->paginate(15)
        ];

        return view('contacts.index',$data);
    }

    public function create()
    {
        return view('contacts.form');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        try {
            $data = $request->all();
            $data['image'] = $this->saveImage('contacts-' . uniqid() . '.png', $request->image, 'uploads/image/', 'new', 200, 200);
            Contact::create($data);
            Toastr::success('Contact Added Successfully','success!');
            return back();
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function show(Contact $contact)
    {
        //
    }

    public function edit(Contact $contact)
    {
        return view('contacts.form',compact('contact'));
    }

    public function update(Request $request, Contact $contact): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        try {
            $data = $request->all();

            $data['image'] = $this->saveImage('contacts-' . uniqid() . '.png', $request->image, 'uploads/image/', $contact->image, 200, 200);

            $contact->update($data);

            Toastr::success('Contact Update Successfully','success!');
            return back();
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function destroy(Contact $contact): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->deleteImage($contact->image);

            $contact->delete();

            Toastr::success('Contact Deleted Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }
}
