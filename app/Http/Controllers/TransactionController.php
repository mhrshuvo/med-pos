<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data = [
            'transactions' => Transaction::latest()->paginate(15)
        ];

        return view('transaction.index',$data);
    }

    public function expense()
    {
        $data = [
            'transactions' => Transaction::where('type',0)->latest()->paginate(15)
        ];

        return view('transaction.expense',$data);
    }

    public function income()
    {
        $data = [
            'transactions' => Transaction::where('type',1)->latest()->paginate(15)
        ];

        return view('transaction.income',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
        ]);

        try {
            $data = $request->all();

            Transaction::create($data);

            Toastr::success('Transaction Has been Made Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        $data = [
            'transactions' => Transaction::where('type',$transaction->type)->paginate(15),
            'edit' => $transaction,
        ];

        if ($transaction->type == 1) {
            $view = 'transaction.income';
        }
        else {
            $view = 'transaction.expense';
        }

        return view($view,$data);
    }

    public function update(Request $request, Transaction $transaction): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
        ]);

        try {
            $data = $request->all();

            $transaction->update($data);

            Toastr::success('Transaction Has been Updated Successfully','success!');

            if ($transaction->type == 1) {
                $route = 'income.index';
            }
            else {
                $route = 'expense.index';
            }

            return redirect()->route($route);

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }

    public function destroy(Transaction $transaction): \Illuminate\Http\RedirectResponse
    {
        try {

            $transaction->delete();

            Toastr::success('Transaction Has been Deleted Successfully','success!');

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong','error!');
            return back();
        }
    }
}
