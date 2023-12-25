<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Medicine;
use App\Models\Pos;
use App\Models\Purchase;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        if (auth()->user()) {
            $data = [
                'pharmacists' => User::where('role_id', 2)->count(),
                'purchases' => Purchase::active()->get(),
                'invoices' => Pos::active()->get(),
                'medicines' => Medicine::active()->count(),
                'suppliers' => Contact::supplier()->active()->count(),
                'customers' => Contact::where('id', '!=', 1)->customer()->active()->count(),
                'income' => Transaction::where('type', 1)->sum('amount'),
                'expense' => Transaction::where('type', 0)->sum('amount'),
            ];
            return view('backend.home',$data);
        }
        return redirect()->route('login');
    }

    public function index()
    {
        $data = [
            'pharmacists' => User::where('role_id', 2)->count(),
            'purchases' => Purchase::active()->get(),
            'invoices' => Pos::active()->get(),
            'medicines' => Medicine::active()->count(),
            'suppliers' => Contact::supplier()->active()->count(),
            'customers' => Contact::where('id', '!=', 1)->customer()->active()->count(),
            'income' => Transaction::where('type', 1)->sum('amount'),
            'expense' => Transaction::where('type', 0)->sum('amount'),
        ];
        return view('backend.home', $data);
    }

    public function statusChange(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::table($request->table)->where('id', $request->id)->update(['status' => $request->status]);
            $success = 'Status Changed Successfully';
            return response()->json(['success' => $success], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something Went Wrong'], 503);
        }
    }
}
