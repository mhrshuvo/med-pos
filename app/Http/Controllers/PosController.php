<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Medicine;
use App\Models\Pos;
use App\Models\Purchase;
use App\Models\Stock;
use App\Traits\InvoiceItemStore;
use App\Traits\InvoicePaymentStore;
use App\Traits\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    use InvoiceItemStore, InvoicePaymentStore, Transaction;

    public function index()
    {
        try {
            $data = [
                'pos_list' => Pos::with('contact', 'payment')->paginate(15)
            ];
            return view('pos.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function draftList()
    {
        try {
            $data = [
                'pos_list' => Pos::with('contact', 'payment')->NonPaid()->paginate(15)
            ];
            return view('pos.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function create()
    {
        try {
            $data = [
                'contacts' => Contact::customer()->active()->get(),
                'medicines' => Medicine::active()->stock()->get(),
            ];
            return view('pos.form', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'medicine_ids' => 'required'
            ]);
            DB::beginTransaction();
            $data = $request->all();
            $data['date'] = Carbon::now();
            $latest_pos = Pos::latest()->first();
            $id = $latest_pos ? $latest_pos->id : 1;
            $data['invoice_no'] = 'INV - 00000'.$id;
            $data['total_quantity'] = array_sum($request->quantities);

            if ($data['paid_amount'] == $data['total_amount'] || !$request->draft) {
                $data['is_paid'] = 1;
            }
            $pos = Pos::create($data);

            $this->storeProducts($data, $pos);

            if ($data['paid_amount'] > 0 || !$request->draft) {
                $data['paid_amount'] = $data['total_amount'];
                $this->storeAmount($data, $pos);
            }

            DB::commit();
            Toastr::success('Invoice Created Successfully');
            return redirect()->route('pos.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function show($id)
    {
        $data = [
            'purchase' => Pos::find($id)
        ];
        return view('pos.view',$data);
    }

    public function edit($id)
    {
        try {
            $data = [
                'contacts' => Contact::customer()->active()->get(),
                'medicines' => Medicine::active()->stock()->get(),
                'pos' => Pos::find($id),
            ];
            return view('pos.form', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'medicine_ids' => 'required'
            ]);
            DB::beginTransaction();
            $data = $request->all();
            $data['total_quantity'] = array_sum($request->quantities);

            if ($data['paid_amount'] == $data['total_amount'] || !$request->draft) {
                $data['is_paid'] = 1;
            }
            $pos = Pos::find($id);
            $pos->update($data);

            $this->storeProducts($data, $pos);

            if ($data['paid_amount'] > 0 || !$request->draft) {
                $data['paid_amount'] = $data['total_amount'];
                $this->storeAmount($data, $pos);
            }

            DB::commit();
            Toastr::success('Invoice Updated Successfully');
            return redirect()->route('pos.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $pos = Pos::find($id);
            DB::beginTransaction();

            $pos->delete();

            $pos->items()->delete();

            $pos->payment()->delete();

            DB::commit();
            Toastr::success('Invoice Deleted Successfully', 'success!');

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong', 'error!');
            return back();
        }
    }

    //ajax req for select medicine
    public function selectMedicine(Request $request)
    {
        try {
            $medicine = Medicine::find($request->id);
            $stocks = $medicine->stocks()->stock()->get();
            $data = [
                'medicine' => $medicine,
                'stocks' => $stocks,
                'stock' => $stocks->sum('quantity'),
            ];
            return view('pos.new_row', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => 1]);
        }
    }

    //ajax req for search medicine
    public function searchMedicine(Request $request)
    {
        try {
            $medicines = Medicine::where('name','LIKE','%'.$request->name.'%')->active()->stock()->get();

            $data = [
                'medicines' => $medicines,
            ];
            return view('pos.search_row', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => 1]);
        }
    }

    public function approve($id)
    {
        DB::beginTransaction();
        try {
            $pos = Pos::find($id);

            $pos->update([
                'status' => 1
            ]);

            foreach ($pos->items as $item)
            {
                $stock = Stock::where('medicine_id',$item->medicine_id)->Stock()->first();
                if ($stock && $stock->quantity > $item->quantity) {
                    $stock->update([
                        'quantity' => $stock->quantity - $item->quantity,
                    ]);
                }
                else {
                    DB::commit();
                    DB::rollBack();
                    Toastr::error(trans('Oops...You Have Running Out of Stock'));
                    return back();
                }
            }

            if ($pos->payment) {
                $this->makeTransaction([
                    'title' => 'Purchase Medicines',
                    'amount' => @$pos->payment->amount,
                    'description' => 'Transaction Has Been Made for Invoice',
                    'type' => 0,
                ],$pos);
            }

            DB::commit();

            Toastr::success('Invoice Approved Successfully', 'success!');

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong', 'error!');
            return back();
        }
    }
}
