<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'categories' => Category::latest()->paginate(15)
            ];
            return view('categories.index', $data);
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

            Category::create($data);

            Toastr::success('Category Has been Made Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        try {
            $data = [
                'categories' => Category::latest()->paginate(15),
                'category' => $category
            ];
            return view('categories.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error');
            return back();
        }
    }

    public function update(Request $request, Category $category): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
        ]);

        try {
            $data = $request->all();

            $category->update($data);

            Toastr::success('Category Has been Updated Successfully','success!');

            return redirect()->route('categories.index');

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function destroy(Category $category): \Illuminate\Http\RedirectResponse
    {
        try {

            $category->delete();

            Toastr::success('Category Has been Deleted Successfully','success!');
            return redirect()->route('categories.index');

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }
}
