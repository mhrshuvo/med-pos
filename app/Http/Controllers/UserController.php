<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ImageStore;

    public function index()
    {
        $data = [
            'users' => User::where('role_id',2)->paginate(15)
        ];

        return view('users.index',$data);
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $data = $request->except('_token');
            $data['image'] = $this->saveImage('users-' . uniqid() . '.png', $request->image, 'uploads/image/', 'new', 200, 200);
            $data['password'] = bcrypt($request->password);
            User::create($data);
            Toastr::success('Pharmacist Added Successfully','success!');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function edit(User $user)
    {
        return view('users.form',compact('user'));
    }

    public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users,phone,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'username' => 'required|unique:users,username,'.$user->id,
        ]);

        try {
            $data = $request->all();

            $data['image'] = $this->saveImage('contacts-' . uniqid() . '.png', $request->image, 'uploads/image/', $user->image, 200, 200);
            $data['password'] = $request->password ? bcrypt($request->password) : $user->password;

            $user->update($data);

            Toastr::success('User Update Successfully','success!');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->deleteImage($user->image);

            $user->delete();

            Toastr::success('User Deleted Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }
}
